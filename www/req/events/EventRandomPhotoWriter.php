<?
class EventRandomPhotoWriter extends GenericWriter
{
	protected $templateFile = NULL;
		
	public function write(IManageable $eventsList)
	{
		$query = "
			SELECT
				p.id AS photoId, e.id AS eventId
			FROM
				kdm2_photos AS p
			INNER JOIN
				kdm2_events AS e
			ON
				p.id_event = e.id
			WHERE
				e.flags != 'HIDDEN' OR e.flags IS NULL
			ORDER BY RAND()
			LIMIT 1";
		
		$events = $eventsList->fetch($query);
			
		$event = $events[0];
				
		$search = array('image', 'eventId');

		foreach ( $search as &$label )
		{
			$label = '{' . $label . '}';
		}
		
		$image_src = '/_images/events/' . $event['eventId'] . '/' . $event['photoId'] . '_large.jpg';
		
		$replace = array($image_src, $event['eventId']);
		
		$entry = file_get_contents($this->templateFile);
						
		echo str_replace($search, $replace, $entry);
	}
}
?>
