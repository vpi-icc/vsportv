<?
class AnnounceList extends Object implements IManageable
{
	protected $status = NULL;
	protected $dbh = NULL;
	
	public function __construct()
	{
		$this->dbh = &DB::getInstance()->dbh;
	}
	
	public function add(array $keyValueData)
	{
		$wrapFields = array('title', 'summary', 'dateAnn', 'details');
		
		foreach ( $wrapFields as $field )
		{
			$keyValueData[$field] = '"' . $keyValueData[$field] . '"';	
		}

		$query = "
			INSERT INTO kfkis_adz
				(title, lead, place, date_start)
			VALUES
				(" . implode(',', array(
					$keyValueData['title'],
					$keyValueData['summary'],
					$keyValueData['details'],
					$keyValueData['dateAnn'])) . ")";
					
		if ( $this->dbh->exec($query) == 0 )
		{
			$this->status = 'Ошибка при добавлении мероприятия в базу:<br />';
			$this->status .= $query;
			return false;
		}

		$this->status = 'Мероприятие успешно добавлено в базу<br />';		
		return true;
	}
	
	public function modify(array $keyValueData)
	{
		$wrapFields = array('id', 'title', 'details', 'dateAnn', 'lead');
		
		foreach ( $wrapFields as $field )
		{
			$keyValueData[$field] = "'" . $keyValueData[$field] . "'";	
		}
		
		$query = "
			UPDATE kfkis_adz
				SET title=". $keyValueData['title'] .", place=". $keyValueData['details'] .", lead=". $keyValueData['lead'] .", date_start=". $keyValueData['dateAnn'] ."
			WHERE id=". $keyValueData['id'];
							
		if ( $this->dbh->exec($query) == 0 )
		{
			$this->status = 'Ошибка при добавлении анонса в базу:<br />';
			$this->status .= $query;
			return false;
		}
		
		$this->status = 'Мероприятие успешно изменено<br />';		
		return true;			
	}
	
	public function delete($id)
	{
		
	}
	
	public function fetch($query)
	{
		$announces = array();
		
		foreach ( $this->dbh->query($query) as $announce )
		{
			$announces[] = $announce;
		}
		return $announces;
	}
	
	public function getStatusString()
	{
		return $this->status;
	}


	public function write(IGenericWriter $announceWriter)
	{
		$announceWriter->write($this);	
	}
}
?>