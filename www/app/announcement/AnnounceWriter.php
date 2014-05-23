<?
class AnnounceWriter extends GenericWriter
{
	protected $templateFile = NULL;
		
	public function write(IManageable $announcesList)
	{
		$query = "
			SELECT
				title, lead, place, date_start
			FROM
				kfkis_adz
			WHERE
				type = 'ADVERTISEMENT' and date_start>=CURDATE() AND ( flags != 'HIDDEN' OR flags IS NULL ) order by date_start asc";
		$announces = $announcesList->fetch($query);
		
		if ( empty($announces) )
		{
			//$this->status = 'Выбранное объявление не&nbsp;существует';
			//$this->showError($this->status);
			return false;
		}
		
		echo "<h2 style='margin-bottom:3px;'>Ближайшие события</h2>";
		foreach ($announces as $announce)
		{
			$announce['date_start'] = explode('-', substr($announce['date_start'],0,10));
			$month = $announce['date_start'][1];
			$day = $announce['date_start'][2];
			$entry = file_get_contents($this->templateFile);
			$search = array('title', 'lead', 'place', 'day', 'month');
	
			foreach ( $search as &$label )
			{
				$label = '{' . $label . '}';
			}
			
			$replace = array($announce['title'], $announce['lead'], $announce['place'], $day, $month);
			echo str_replace($search, $replace, $entry);
		}
	}
}
?>
