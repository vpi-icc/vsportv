<?
class EventAnnWriter extends GenericWriter
{
	protected $templateFile = NULL;
		
	public function write(IManageable $eventsList)
	{
		$query = "
			SELECT
				title, lead, place, date_start
			FROM
				kfkis_adz
			WHERE
				type = 'ADVERTISEMENT' and date_start>=CURDATE() AND ( flags != 'HIDDEN' OR flags IS NULL ) order by id asc";
		$events = $eventsList->fetch($query);
		
		if ( empty($events) )
		{
			//$this->status = 'Выбранное объявление не&nbsp;существует';
			//$this->showError($this->status);
			return false;
		}
		
		echo "<h2 style='margin-bottom:3px;'>Ближайшие события</h2>";
		foreach ($events as $event)
		{
			$event['date_start'] = explode('-', substr($event['date_start'],0,10));
			$month = $event['date_start'][1];
			$day = $event['date_start'][2];
			$entry = file_get_contents($this->templateFile);
			$search = array('title', 'lead', 'place', 'day', 'month');
	
			foreach ( $search as &$label )
			{
				$label = '{' . $label . '}';
			}
			
			$replace = array($event['title'], $event['lead'], $event['place'], $day, $month);
			echo str_replace($search, $replace, $entry);
		}
	}
}
?>
