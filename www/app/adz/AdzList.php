<?
	class AdzList extends Object implements IManageable
	{
		protected $status = NULL;
		protected $dbh = NULL;
		
		public function __construct()
		{
			$this->dbh = &DB::getInstance()->dbh;
		}
		
		public function add(array $keyValueData)
		{
			$keyValueData['topflag'] = !empty($keyValueData['topflag']) ? "'TOP'" : "NULL";
			if ( empty($keyValueData['date_start']) )
				$keyValueData['date_start'] = 'NULL';
			else
			{
				if ( !empty($keyValueData['time_start']) ) $keyValueData['date_start'] .= ' ' . $keyValueData['time_start'];
				$keyValueData['date_start'] = "'" . $keyValueData['date_start'] . "'";
			}
			
			if ( empty($keyValueData['date_finish']) )
				$keyValueData['date_finish'] = 'NULL';
			else
			{
				if ( !empty($keyValueData['time_finish']) ) $keyValueData['date_finish'] .= ' ' . $keyValueData['time_finish'];
				$keyValueData['date_finish'] = "'" . $keyValueData['date_finish'] . "'";
			}
			
			$wrapFields = array('title', 'type', 'place');
			
			foreach ( $wrapFields as $field )
			{
				$keyValueData[$field] = '"' . $keyValueData[$field] . '"';	
			}
			
			$query = "
				INSERT INTO kdm2_adz
					(title, place, date_start, date_finish, flags, type)
				VALUES
					(" . implode(',', array(
						$keyValueData['title'],
						$keyValueData['place'],
						$keyValueData['date_start'],
						$keyValueData['date_finish'],
						$keyValueData['topflag'],
						$keyValueData['type'])) . ")";
						
			if ( $this->dbh->exec($query) == 0 )
			{
				$this->status = 'Ошибка при добавлении объявления в базу:<br />';
				$this->status .= $query;
				return false;
			}
			
			$adId = $this->dbh->lastInsertId();
			
			// upload attachments
			$nFiles = 0;
			$storage = new FileStorage;
			$n = count($_FILES['attachments']['name']);
			for ( $i = 0; $i < $n; $i++ )
			{
				$tmp_name = $_FILES['attachments']['tmp_name'][$i];
				$name = $_FILES['attachments']['name'][$i];
				$url = '/adz/?id=' . $adId;
				$title = $keyValueData['filetitles'][$i];
				if ( $storage->upload($tmp_name, $name, $title, 'ADZ', $url) )
					$nFiles++;				
			}
			
			if ( $nFiles )
			{
				$query = "
					UPDATE
						kdm2_adz
					SET
						files = " . $nFiles . "
					WHERE
						id = " . $adId;
						
				if ( !$this->dbh->exec($query) )
				{
					$this->status = 'Не удалось записать количество вложений для анонса';
					return false;
				}
			}
			
			// handle description write to file
			$descriptionDir = $_SERVER['DOCUMENT_ROOT'] . '/adz/descriptions';
			if ( !file_exists($descriptionDir) && !mkdir($descriptionDir, 0777) )
			{
				$this->status = 'Не удалось создать директорию для хранения анонса';	
				return false;
			}
	
			$descriptionFile = $descriptionDir . '/' . $adId . '.php';
			if ( !file_put_contents($descriptionFile, $keyValueData['description']) )
			{
				$this->status = 'Не удалось записать анонс в&nbsp;файл';
				return false;
			}
			
			// load cover
			$file = $keyValueData['cover_image'];			
			$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/_images/adz/' . $adId;
			if ( !$this->addPhoto($file['tmp_name'], $targetDir, $adId) ) return false;

			$this->status = 'Анонс успешно добавлен в базу<br />';
			return true;
		}
		
		public function fetch($query)
		{
			$adz = array();
			foreach ( $this->dbh->query($query) as $ad )
			{
				$adz[] = $ad;
			}
			return $adz;
		}
		
		public function getStatusString()
		{
			return $this->status;
		}
		
		public function addPhoto($src_file, $targetDir, $adId)
		{
			$this->prepareDirectoryMD5($targetDir, $src_file);
			$ext = '.jpg';		
			$original_file = $targetDir . '/' . $adId . $ext;	

			if ( !$this->resizeImage($src_file, $original_file, 300) ) return false;
			unlink($src_file);
			
			$small_file = $targetDir . '/' . $adId . '_small' . $ext;
			
			if ( !$this->resizeImage($original_file, $small_file, 150) ) return false;
			
			return true;
		}	
		
		public function delete($idAd) {}
		public function modify(array $keyValueData) {}
		
		public function write(IGenericWriter $adWriter)
		{
			$adWriter->write($this);	
		}
	}
?>