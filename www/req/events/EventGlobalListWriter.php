 <?
class EventGlobalListWriter extends GenericWriter
{
	protected $templateFile = NULL;
		
	public function write(IManageable $eventsList)
	{
		/*
		global $selectedEvents;
		$selectedEvents = implode(',', $selectedEvents);
		*/
		// AND id NOT IN (" . $selectedEvents . ")
		
		
		$page = 0;
		$ipp = 7; // items per page
		if ( !empty($_GET['p']) )		
		{
			$page = (int)$_GET['p'] - 1;	
		}
		$offset = $page * $ipp;
		
		$query = "
			SELECT
				id, id_cover, title, summary
			FROM
				kfkis_events
			WHERE
				( flags != 'HIDDEN' OR flags IS NULL ) 				
			ORDER BY id DESC
			LIMIT " . $ipp . " OFFSET " . $offset;
		
		$events = $eventsList->fetch($query);
		
		foreach ( $events as $event )
		{	
			$entry = file_get_contents($this->templateFile);
			$search = array('id', 'title', 'summary', 'image');
	
			foreach ( $search as &$label )
			{
				$label = '{' . $label . '}';
			}
			
			$replace = array($event['id'], $event['title'], $event['summary']);
			
			if ( $event['id_cover'] )
				$image_src = '/_images/events/' . $event['id'] . '/' . $event['id_cover'] . '_small.jpg';
			else
				$image_src = '/_images/_layout/no_image_150.gif';
			
			$replace[] = $image_src;			
			
			echo str_replace($search, $replace, $entry);
		}
		
		$query = "
			SELECT COUNT(*)
			FROM kfkis_events";
		
		
		list( $total_items ) = DB::getInstance()->dbh->query($query)->fetch(PDO::FETCH_NUM);
		
		if ( $total_items > $ipp )
		{
			$ppanel = '<div class="pagination_panel">';
			$n = ceil($total_items / $ipp);
			if ( $n > 10 ) $n = 10; // limit total amount of pages
			for ( $i = 0; $i < $n; $i++ )			
			{				
				if ( $i != $page )
					$ppanel .= '<a href="/events/?p=' . ($i+1) . '">' . ($i+1) . '</a>';
				else
					$ppanel .= '<span>' . ($i+1) . '</span>';
			}
			$ppanel .= '</div>';
			echo $ppanel;
		}
		
	}
}
?>
