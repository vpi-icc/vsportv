<?
class AdzPlacardWriter extends GenericWriter
{
	protected $templateFile = NULL;
	
	public function write(IManageable $adzList)
	{
		$maxCells = 5;
		$current_datetime = date('Y-m-d H:i:s');
		$current_date = date('Y-m-d');
		
		// events held today
		$query = "
			SELECT
				id, title, DATE_FORMAT(date_start, '%k:%i') AS ad_time, DATE(date_start) AS ad_date_start
			FROM
				kdm2_adz
			WHERE
				(flags != 'HIDDEN' OR flags IS NULL)
				AND type = 'EVENT'
				AND (
					DATE(date_start) = CURDATE()
					OR
					CURDATE() BETWEEN date_start AND date_finish )
			ORDER BY
				date_start ASC
			LIMIT " . ($maxCells + 1);
		
		$adzToday = $adzList->fetch($query);
		
		$nToday = count($adzToday);
		if ( $nToday == $maxCells + 1 ) unset($adzToday[$maxCells]);
				
		foreach ( $adzToday as $ad )
		{	
			$entry = file_get_contents($this->templateFile);
			$search = array('id', 'visible', 'hover');
	
			foreach ( $search as &$label )
			{
				$label = '{' . $label . '}';
			}
			
			$at = 'сегодн€';
			if ( $ad['ad_date_start'] == $current_date && $ad['ad_time'] != '00:00' )
				$at .= '<br />в ' . $ad['ad_time'];
			
			$replace = array($ad['id'], $at, $ad['title']);
						
			echo str_replace($search, $replace, $entry);
		}
		
		if ( $nToday )
		{
			if ( $nToday >= $maxCells )
			{
				echo '<div><a href="/adz/"><img src="/_images/_layout/placard_next.gif" alt="≈щЄ" title="≈щЄ" /></a></div>';
				return true;
			}
			else echo '<div id="delimiter"><img src="/_images/_layout/placard_delimiter.gif" /></div>';
		}
		
		
		// events held after today
		
		$delta = $maxCells - $nToday;
		
		$query = "
			SELECT
				id, title, DATE(date_start) AS ad_date_start, DATE_FORMAT(date_start, '%k:%i') AS ad_time
			FROM
				kdm2_adz
			WHERE
				( flags != 'HIDDEN' OR flags IS NULL )
				AND type = 'EVENT'
				AND DATE(date_start) > '" . $current_date . "'
			ORDER BY
				date_start ASC
			LIMIT " . ($delta + 1);
		
		$adzAfter = $adzList->fetch($query);
		
		$nAfter = count($adzAfter);		
		if ( $nAfter == $delta + 1 ) unset($adzAfter[$delta]);		
		
				
		foreach ( $adzAfter as $ad )
		{	
			$entry = file_get_contents($this->templateFile);
			$search = array('id', 'visible', 'hover');
	
			foreach ( $search as &$label )
			{
				$label = '{' . $label . '}';
			}
			
			$date_start = '';
			if ( $ad['ad_date_start'] == date('Y-m-d', time() + (3600 * 24)) )
			{
				$date_start = 'завтра';
				if ( !empty($ad['ad_time']) && $ad['ad_time'] != '00:00' ) $date_start .= '<br />в ' . $ad['ad_time'];
			}
			else if ( $ad['ad_date_start'] == date('Y-m-d', time() + (3600 * 24 * 2)) )
			{
				$date_start = 'послезавтра';
				if ( !empty($ad['ad_time']) && $ad['ad_time'] != '00:00' ) $date_start .= '<br />в ' . $ad['ad_time'];
			}
			else
				$date_start = self::formatDateRussian($ad['ad_date_start']);
			
			$replace = array($ad['id'], $date_start, $ad['title']);	
						
			echo str_replace($search, $replace, $entry);
		}
		
		if ( $nAfter )
		{
			if ( $nAfter >= $delta )
			{
				echo '<div><a href="/adz/"><img src="/_images/_layout/placard_next.gif" alt="≈щЄ" title="≈щЄ" /></a></div>';
				return true;
			}
			else echo '<div id="delimiter"><img src="/_images/_layout/placard_delimiter.gif" /></div>';
		}
		
		// contests
		
		$delta -= $nAfter;
		
		$query = "
			SELECT
				id, title, DATE(date_start) AS ad_date_start, DATE(date_finish) AS ad_date_finish
			FROM
				kdm2_adz
			WHERE
				( flags != 'HIDDEN' OR flags IS NULL )
				AND type = 'CONTEST'
				AND (
					date_finish >= CURDATE()
					OR
					date_finish IS NULL )
			ORDER BY
				id DESC
			LIMIT " . ($delta + 1);
		
		$adz = $adzList->fetch($query);
		
		$nAdz = count($adz);		
		if ( $nAdz == $delta + 1 ) unset($adz[$delta]);
						
		foreach ( $adz as $ad )
		{	
			$entry = file_get_contents($this->templateFile);
			$search = array('id', 'visible', 'hover');
	
			foreach ( $search as &$label )
			{
				$label = '{' . $label . '}';
			}
			
			$date = '';
			if ( !empty($ad['ad_date_start']) && strtotime($ad['ad_date_start']) > time() )
				$date .= 'c ' . self::formatDateRussian($ad['ad_date_start']) . '<br />';
			if ( !empty($ad['ad_date_finish']) )
				$date .= 'по ' . self::formatDateRussian($ad['ad_date_finish']);
			if ( empty($date) )
				$date = $ad['title'];
			
			$replace = array($ad['id'], $ad['title'], $date);
						
			echo str_replace($search, $replace, $entry);
		}
		
		if ( $nAdz )
		{
			if ( $nAdz >= $delta )
			{				
				echo '<div><a href="/adz/"><img src="/_images/_layout/placard_next.gif" alt="≈щЄ" title="≈щЄ" /></a></div>';
				return true;
			}
			else echo '<div id="delimiter"><img src="/_images/_layout/placard_delimiter.gif" /></div>';
		}
		
		// adz
		
		$delta -= $nAdz;
		
		$query = "
			SELECT
				id, title
			FROM
				kdm2_adz
			WHERE
				flags != 'HIDDEN'
				AND type = 'ADVERTISEMENT'
				AND (
					(
						date_finish >= CURDATE()
						AND
						date_start IS NULL
					)
					OR
					(
						date_start IS NULL
						AND
						date_finish IS NULL
					)
					OR
					(
						date_finish IS NULL
						AND
						date_start >= CURDATE()
					)
				)
			ORDER BY
				id DESC
			LIMIT " . ($delta + 1);
		
		$adz = $adzList->fetch($query);
		
		$nAdz = count($adz);		
		if ( $nAdz == $delta + 1 ) unset($adz[$delta]);
						
		foreach ( $adz as $ad )
		{	
			$entry = file_get_contents($this->templateFile);
			$search = array('id', 'visible', 'hover');
	
			foreach ( $search as &$label )
			{
				$label = '{' . $label . '}';
			}
			
			$replace = array($ad['id'], $ad['title'], $ad['title']);
						
			echo str_replace($search, $replace, $entry);
		}
		
		if ( $nAdz )
		{
			if ( $nAdz >= $delta )
			{
				echo '<div><a href="/adz/"><img src="/_images/_layout/placard_next.gif" alt="≈щЄ" title="≈щЄ" /></a></div>';
				return true;
			}
		}
		
		// empty cells	
		/*	
		$delta -= $nAdz;
		
		for ( $i = 0; $i < $delta; $i++ )
		{
			echo '<div class="placard"><div>&nbsp;</div></div>';	
		}
		*/
				
		return true;
	}
}
?>
