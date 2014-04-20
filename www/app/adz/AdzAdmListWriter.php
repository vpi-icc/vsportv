<?
class AdzAdmListWriter extends GenericWriter
{
	protected $templateFile = NULL;
	
	public function write(IManageable $adzList)
	{
		$query = "
			SELECT
				id, title, place,
				DATE(date_start) AS date_start,
				DATE_FORMAT(date_start, '%H:%i') AS time_start,
				DATE(date_finish) AS date_finish,
				type, flags, files
			FROM
				kdm2_adz
			ORDER BY
				id DESC";				
		
		$adz = $adzList->fetch($query);
				
		foreach ( $adz as $ad )
		{	
			$entry = file_get_contents($this->templateFile);
			$search = array('id', 'title', 'place', 'date_start', 'date_finish', 'type', 'topflag', 'hiddenflag');
			self::wrap($search, '{', '}');
			
			$image_src = '/_images/adz/' . $ad['id'] . '/' . $ad['id'] . '_small.jpg';
			
			$hiddenflag = '';
			$topflag = '';			
			switch ( $ad['flags'] )
			{
				case 'TOP':
					$topflag = 'greenblock';
					break;
				
				case 'HIDDEN':
					$hiddenflag = 'grey';
					break;
			}
			
			$map = array(
				'ADVERTISEMENT' => '&mdash;',
				'EVENT' => '<span class="green">Ì</span>',
				'CONTEST' => 'Ê');
				
			$ad['type'] = '<strong>' . $map[$ad['type']] . '</strong>';
					
			if ( empty($ad['date_start']) )
				$ad['date_start'] = '&mdash;';
			else
			{
				if ( $ad['time_start'] != '00:00' )
					$ad['date_start'] = '<acronym title="â ' . $ad['time_start'] . '">' . $ad['date_start'] . '</acronym>';
				$ad['date_start'] = '<nobr>' . $ad['date_start'] . '</nobr>';
			}
							
			if ( empty($ad['date_finish']) )
				$ad['date_finish'] = '&mdash;';
			else
				$ad['date_finish'] = '<nobr>' . $ad['date_finish'] . '</nobr>';
				
			if ( empty($ad['place']) )
				$ad['place'] = '&mdash;';
			
			$replace = array(
				$ad['id'],
				$ad['title'],
				$ad['place'],
				$ad['date_start'],
				$ad['date_finish'],
				$ad['type'],
				$topflag,
				$hiddenflag);
					
			echo str_replace($search, $replace, $entry);
		}
	}
}
?>
