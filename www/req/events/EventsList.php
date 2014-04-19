<?
class EventsList extends Object implements IManageable
{
	protected $status = NULL;
	protected $dbh = NULL;
	
	public function __construct()
	{
		$this->dbh = &DB::getInstance()->dbh;
	}
	
	public function add(array $keyValueData)
	{
		$topflag = $keyValueData['topflag'] ? "'TOP'" : 'NULL';
		
		$wrapFields = array('title', 'summary', 'eventdate', 'place', 'type', 'category', 'importance');
		
		foreach ( $wrapFields as $field )
		{
			$keyValueData[$field] = '"' . $keyValueData[$field] . '"';	
		}

		$query = "
			INSERT INTO kfkis_events
				(title, summary, date_occured, place, participants, type, category, importance, flags)
			VALUES
				(" . implode(',', array(
					$keyValueData['title'],
					$keyValueData['summary'],
					$keyValueData['eventdate'],
					$keyValueData['place'],
					$keyValueData['participants'],
					$keyValueData['type'],
					$keyValueData['category'],
					$keyValueData['importance'],
					$topflag)) . ")";
					
		if ( $this->dbh->exec($query) == 0 )
		{
			$this->status = 'Ошибка при добавлении мероприятия в базу:<br />';
			$this->status .= $query;
			return false;
		}
		
		$eventId = $this->dbh->lastInsertId();
		
		// handle description write to file
		$descriptionDir = $_SERVER['DOCUMENT_ROOT'] . '/events/descriptions';
		if ( !file_exists($descriptionDir) && !mkdir($descriptionDir, 0777) )
		{
			$this->status = 'Не удалось создать директорию для хранения описания события';	
			return false;
		}

		$descriptionFile = $descriptionDir . '/' . $eventId . '.php';
		if ( !file_put_contents($descriptionFile, $keyValueData['description']) )
		{
			$this->status = 'Не удалось записать описание события в&nbsp;файл';
			return false;
		}
		
		// load images
		if ( !empty($keyValueData['imagepack']['size']) )
		{		
			$file = $keyValueData['imagepack'];			
			$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/_images/events/' . $eventId;

			if ( in_array($file['type'], array('application/x-zip-compressed', 'application/octet-stream')) )
			{
				$extractTo = $_SERVER['DOCUMENT_ROOT'] . '/_images/_extractedFiles';
				$extractedFiles = $this->extractZipArchive($file['tmp_name'], $extractTo);
				if ( !$extractedFiles ) return false;
				$errorLog = array();
				foreach ( $extractedFiles as $file )
				{					
					$src_file = $extractTo . '/' . $file;
					if ( !$this->addPhoto($src_file, $targetDir, $eventId) )					
						$this->errorLog[] = $this->status;					
				}
				if ( !empty($this->errorLog) )
				{
					$this->status = 'Изображения успешно добавлены, однако, в&nbsp;процессе выполнения запроса произошли следующие ошибки:' . implode('<br />', $errorLog);
				}
				rmdir($extractTo);				
			}
			else
			{
				if ( !$this->addPhoto($file['tmp_name'], $targetDir, $eventId) )
					return false;
			}
			$query = '
				UPDATE kfkis_events
				SET id_cover = ' . $this->dbh->lastInsertId() . '
				WHERE id = ' . $eventId;
				
			if ( !$this->dbh->exec($query) )
			{
				$this->status = 'Не удалось установить обложку мероприятия';
				return false;
			}
		}

		$this->status = 'Мероприятие успешно добавлено в базу<br />';		
		return true;
	}
	
	public function modify(array $keyValueData)
	{
			
	}
	
	public function delete($id)
	{
		
	}
	
	public function addPhoto($src_file, $targetDir, $eventId)
	{
		$basename = $this->prepareDirectoryMD5($targetDir, $src_file);
		if ( !$basename ) return false;
		$ext = '.jpg';		
		$original_file = $targetDir . '/' . $basename . $ext;	
		
		if ( !$this->resizeImage($src_file, $original_file, 640) ) return false;
		unlink($src_file);

		$imagesize = getimagesize($original_file);	
		if ( $imagesize === false )
		{
			$this->status = 'Не удалось получить размеры изображения:<br />';
			$this->status .= $original_file;
			return false;
		}
		
		$orientation = ( $imagesize[0] > $imagesize[1] ) ? 'LANDSCAPE' : 'PORTRAIT';
		
		$query = '
			INSERT INTO
				kfkis_photos (id_event, orientation)
			VALUES
				(' . $eventId . ', "' . $orientation . '")';
				
		if ( $this->dbh->exec($query) == 0 )
		{
			$this->status = 'Ошибка при добавлении изображения в&nbsp;базу:<br />';
			$this->status .= $query . '<br />';
			$db_errormsg = $this->dbh->errorInfo();						
			$this->status .= $db_errormsg[2];
			return false;
		}
		
		$basename = $this->dbh->lastInsertId();
		$dst_file_base = $targetDir . '/' . $basename;
		rename($original_file, $dst_file_base . $ext);
		$original_file = $dst_file_base . $ext;
		$large_file = $dst_file_base . '_large' . $ext;
		$small_file = $dst_file_base . '_small' . $ext;
		$mini_file = $dst_file_base . '_mini' . $ext;
		
		if ( !$this->resizeImage($original_file, $large_file, 300) ) return false;
		if ( !$this->resizeImage($large_file, $small_file, 150) ) return false;
		if ( !$this->resizeImage($small_file, $mini_file, 75) ) return false;
		
		return true;
	}	
	
	public function fetch($query)
	{
		$events = array();
		
		foreach ( $this->dbh->query($query) as $event )
		{
			$events[] = $event;
		}
		return $events;
	}
	
	public function getStatusString()
	{
		return $this->status;
	}


	public function write(IGenericWriter $eventWriter)
	{
		$eventWriter->write($this);	
	}
}
?>