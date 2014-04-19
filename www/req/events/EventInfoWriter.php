<?
class EventInfoWriter extends GenericWriter
{
	protected $templateFile = NULL;
	protected $eventId;
	
	public function setEventId($id)
	{
		if ( (int)$id <= 0 )
		{
			$this->status = 'Неверный номер мероприятия';
			$this->showError($this->status);
			return false;
		}
		$this->eventId = $id;
		return true;
	}
		
	public function write(IManageable $eventsList)
	{
		$query = "
			SELECT
				participants, place, type, category, importance
			FROM
				kdm2_events
			WHERE
				id = " . $this->eventId . " AND ( flags != 'HIDDEN' OR flags IS NULL )";
		$events = $eventsList->fetch($query);
		
		if ( empty($events) )
		{
			$this->status = 'Выбранное мероприятие не&nbsp;существует';
			$this->showError($this->status);
			return false;
		}
		
		$event = $events[0];
		
		$entry = file_get_contents($this->templateFile);
		$search = array('participants', 'place', 'type', 'category', 'importance');

		foreach ( $search as &$label )
		{
			$label = '{' . $label . '}';
		}

		
		$type = self::$eventTypes[$event['type']];
		$category = self::$eventCategories[$event['category']];
		$importance = self::$eventImportance[$event['importance']];
		$replace = array($event['participants'], $event['place'], $type, $category, $importance);
		echo str_replace($search, $replace, $entry);
	}
}
?>
