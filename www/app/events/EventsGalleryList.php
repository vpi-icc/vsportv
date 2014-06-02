<?
class EventsGalleryList extends Object implements IManageable
{
	protected $status = NULL;
	protected $dbh = NULL;
	
	public function __construct()
	{
		$this->dbh = &DB::getInstance()->dbh;
	}
	
	public function add(array $keyValueData)
	{
		
	}
	
	public function modify(array $keyValueData)
	{
			
	}
	
	public function delete($id)
	{
		
	}
	
	public function addPhoto($src_file, $targetDir, $eventId)
	{
		
	}	
	
	public function fetch($query)
	{
		$photos = array();
		
		foreach ( $this->dbh->query($query) as $photo )
		{
			$photos[] = $photo;
		}
		return $photos;
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