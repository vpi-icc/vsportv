<?
class EventAdmListWriter extends GenericWriter
{
	protected $templateFile = NULL;
	
	public function write(IManageable $eventsList)
	{
		$query = "
			SELECT
				id, id_cover, title, summary, flags
			FROM
				kfkis_events
			ORDER BY
				id DESC";				
		
		$events = $eventsList->fetch($query);
				
		foreach ( $events as $event )
		{	
			$entry = file_get_contents($this->templateFile);
			$search = array('id', 'title', 'summary', 'image', 'topflag', 'hiddenflag');	
	
			foreach ( $search as &$label )
			{
				$label = '{' . $label . '}';
			}
			
			$replace = array($event['id'], $event['title'], $event['summary']);
			
			if ( $event['id_cover'] )
				$image_src = '/_images/events/' . $event['id'] . '/' . $event['id_cover'] . '_mini.jpg';
			else
				$image_src = '/_images/_layout/no_image_75.gif';
			
			$replace[] = $image_src;
			
			$hiddenflag = '';
			$topflag = '';			
			switch ( $event['flags'] )
			{
				case 'TOP':
					$topflag = 'greenblock';
					break;
				
				case 'HIDDEN':
					$hiddenflag = 'grey';
					break;
			}
			
			$replace[] = $topflag;
			$replace[] = $hiddenflag;
			
			echo str_replace($search, $replace, $entry);
		}
	}
}
?>
