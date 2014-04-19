<?
class AdzMainListWriter extends GenericWriter
{
	protected $templateFile = NULL;
	
	public function write(IManageable $adzList)
	{
		$search = array('id', 'title', 'cover', 'details');
		self::wrap($search, '{', '}');
		
		echo '<h1>Афиша</h1>';
		
		// events
		
		$query = "
			SELECT
				id, title, place, type, (flags = 'TOP') AS is_top,
				DATE(date_start) AS date_start,
				DATE(date_finish) AS date_finish,
				DATE_FORMAT(date_start, '%H:%i') AS time_start
			FROM
				kdm2_adz
			WHERE
				( flags != 'HIDDEN' OR flags IS NULL )
				AND type = 'EVENT'
				AND (
					( DATE(date_start) >= CURDATE() AND date_finish IS NULL )
					OR
					CURDATE() BETWEEN date_start AND date_finish )
			ORDER BY
				flags DESC, date_start ASC";
		
		$events = $adzList->fetch($query);
				
		if ( !empty($events) )
			echo '<h3 class="rght underline grey">Грядущие мероприятия</h3>';
				
		foreach ( $events as $event )
		{	
			$entry = file_get_contents($this->templateFile);

			$image_src = '/_images/adz/' . $event['id'] . '/' . $event['id'] . '_small.jpg';

			$details = '';
			if ( !empty($event['place']) )
				$details .= '<p class="address">' . $event['place'] . '</p>';
			
			$details .= '<p class="date">' . self::formatDateRussian($event['date_start']);
			if ( !empty($event['date_finish']) ) $details .= ' по&nbsp;' . $event['date_finish'];
			$details .= '</p>';

			$replace = array($event['id'], $event['title'], $image_src, $details);
			
			echo str_replace($search, $replace, $entry);
		}
		
		// contests
		
		$query = "
			SELECT
				id, title, place, type, (flags = 'TOP') AS is_top,
				DATE(date_start) AS date_start,
				DATE(date_finish) AS date_finish,
				DATE_FORMAT(date_start, '%H:%i') AS time_start
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
				flags DESC, date_start ASC";
			
		$contests = $adzList->fetch($query);
				
		if ( !empty($contests) )
			echo '<h3 class="rght underline grey">Действующие конкурсы</h3>';
					
		foreach ( $contests as $contest )
		{	
			$entry = file_get_contents($this->templateFile);
	
			$details = '';
			if ( !empty($contest['place']) )
				$details .= '<p class="address">' . $contest['place'] . '</p>';
			
			$details .= '<p class="date">Проводится ';
			if ( !empty($contest['date_start']) && !empty($contest['date_finish']) )
			{
				$date_start = 'c&nbsp;' . self::formatDateRussian($contest['date_start']);
				$date_finish = 'по&nbsp;' . self::formatDateRussian($contest['date_finish']);
				if ( strtotime($contest['date_start']) < time() )
						$details .= '<acronym title="' . $date_start . '">' . $date_finish . '</acronym>';
				else
					$details .= $date_start . ' ' . $date_finish;
			}
			elseif ( !empty($contest['date_start']) )
					$details .= 'с&nbsp;' . self::formatDateRussian($contest['date_start']);
					
			elseif ( !empty($contest['date_finish']) )
					$details .= 'по&nbsp;' . self::formatDateRussian($contest['date_finish']);
	
			$details .= '</p>';
			
			$image_src = '/_images/adz/' . $contest['id'] . '/' . $contest['id'] . '_small.jpg';

			$replace = array($contest['id'], $contest['title'], $image_src, $details);
			
			echo str_replace($search, $replace, $entry);
		}
		
		// advertisements
		
		$query = "
			SELECT
				id, title, place, type, (flags = 'TOP') AS is_top,
				DATE(date_start) AS date_start,
				DATE(date_finish) AS date_finish,
				DATE_FORMAT(date_start, '%H:%i') AS time_start
			FROM
				kdm2_adz
			WHERE
				(flags != 'HIDDEN' OR flags IS NULL)
				AND type = 'ADVERTISEMENT'
				AND (
					date_finish >= CURDATE()
					OR
					date_finish IS NULL )
			ORDER BY
				flags DESC, id DESC";
			
		$adz = $adzList->fetch($query);
				
		if ( !empty($adz) )
			echo '<h3 class="rght underline grey">Актуальные объявления</h3>';
					
		foreach ( $adz as $ad )
		{	
			$entry = file_get_contents($this->templateFile);
			$ad_date = '';
			
			/*
			if ( !empty($ad['date_start']) )
				$ad_date = 'c ' . $this->formatDateRussian($ad['date_start']);
			
			if ( !empty($ad['date_finish']) )
				$ad_date = 'по ' . $this->formatDateRussian($ad['date_finish']);
			*/
			
			$image_src = '/_images/adz/' . $ad['id'] . '/' . $ad['id'] . '_small.jpg';

			$replace = array($ad['id'], $ad['title'], $image_src, '');
			
			echo str_replace($search, $replace, $entry);
		}
	}
}
?>
