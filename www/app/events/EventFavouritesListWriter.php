<?
class EventFavouritesListWriter extends GenericWriter
{
	protected $templateFile = NULL;
		
	public function write(IManageable $eventsList)
	{
		/*
		global $selectedEvents;
		$selectedEvents = implode(',', $selectedEvents);
		*/
		// AND id NOT IN (" . $selectedEvents . ")
		
		$query = "
			SELECT
				id, id_cover, title
			FROM
				kfkis_events
			WHERE
				flags = 'FAVOURITE'
			ORDER BY id DESC
			LIMIT 6";
		
		$events = $eventsList->fetch($query);
		
		foreach ( $events as $event )
		{	
			$entry = file_get_contents($this->templateFile);
			$search = array('id', 'title', 'cover');
	
			foreach ( $search as &$label )
			{
				$label = '{' . $label . '}';
			}
			
			$replace = array($event['id'], $event['title'], $event['id_cover']);

            /*
			if ( $event['id_cover'] )
				$image_src = '/_images/events/' . $event['id'] . '/' . $event['id_cover'] . '_mini.jpg';
			else
				$image_src = '/_images/_layout/no_image_75.gif';
			
			$replace[] = $image_src;			
			*/

			echo str_replace($search, $replace, $entry);
		}
	}
}
?>
