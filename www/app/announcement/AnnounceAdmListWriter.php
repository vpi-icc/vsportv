<?
class AnnounceAdmListWriter extends GenericWriter
{
	protected $templateFile = NULL;
	
	public function write(IManageable $announcesList)
	{
		$query = "
			SELECT
				id, title, lead, place, date_start, flags
			FROM
				kfkis_adz
			ORDER BY
				id DESC";				
		
		$announces = $announcesList->fetch($query);
				
		foreach ( $announces as $announce )
		{	
			$entry = file_get_contents($this->templateFile);
			$search = array('id', 'title', 'lead', 'date_start');	
	
			foreach ( $search as &$label )
			{
				$label = '{' . $label . '}';
			}

			$replace = array($announce['id'], $announce['title'], $announce['lead'], substr($announce['date_start'],0,10));
			
			/*if ( $event['id_cover'] )
				$image_src = '/_images/events/' . $event['id'] . '/' . $event['id_cover'] . '_mini.jpg';
			else
				$image_src = '/_images/_layout/no_image_75.gif';
			
			$replace[] = $image_src;*/
			
			$hiddenflag = '';
			$topflag = '';			
			switch ( $announce['flags'] )
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
