<?
class EventSwitcherWriter extends GenericWriter
{
	protected $templateFile = NULL;
		
	public function write(IManageable $eventsList)
	{
		/*
		$query = "
			SELECT
				id, id_cover, title, summary
			FROM
				kfkis_events
			WHERE
				flags = 'TOP' AND id_cover != 0
			ORDER BY id DESC
			LIMIT 3";
		
		$events = $eventsList->fetch($query);
		$n = count($events);

		if ( $n < 3 )
		{
			$query = "
				SELECT
					id, id_cover, title, summary
				FROM
					kfkis_events
				WHERE
					( flags != 'TOP' OR flags IS NULL )
					AND id_cover != 0
				ORDER BY
					id DESC
				LIMIT " . (3 - $n);
			
			$events = array_merge($events, $eventsList->fetch($query));	
		}
				
		if ( count($events) < 3 )
		{
			$this->status = 'В базе недостаточно мероприятий для отображения данного элемента';
			$this->showError($this->status);
			return false;
		}
		*/
		
		$query = "
			SELECT
				id, id_cover, title, summary
			FROM
				kfkis_events
			WHERE
				id_cover != 0 AND (flags IS NULL OR flags IN ('FAVOURITE', 'TOP'))
			ORDER BY id DESC
			LIMIT 3";
		
		$events = $eventsList->fetch($query);
		$n = count($events);
		
		global $selectedEvents;
		$replace = array();
		foreach ( $events as $event )
		{
            $event['title'] = iconv('Windows-1251', 'UTF-8', $event['title']);
			$selectedEvents[] = $event['id'];
			$replace = array_merge($replace, array($event['id'], $event['title'], $event['summary']));
			$image_src = '/_images/events/' . $event['id'] . '/' . $event['id_cover'] . '_large.jpg';			
			$replace[] = $image_src;			
		}
		$entry = file_get_contents($this->templateFile);
		$search = array('id1', 'title1', 'summary1', 'image1', 'id2', 'title2', 'summary2', 'image2', 'id3', 'title3', 'summary3', 'image3');
		foreach ( $search as &$label )
		{
			$label = '{' . $label . '}';
		}
		echo str_replace($search, $replace, $entry);		
	}
}
?>
