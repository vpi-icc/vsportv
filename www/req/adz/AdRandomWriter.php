<?
class AdRandomWriter extends GenericWriter
{
	protected $templateFile = NULL;
	protected $selectedAdId = 0;
	protected $displayMode = 'TOP';
	
	public function setSelectedAdId($id)
	{
		$id = (int)$id;
		if ( $id <= 0 )
		{
			$this->status = 'Указан неверный номер анонса';
			return false;	
		}
		$this->selectedAdId = $id;
		return true;
	}
	
	public function setDisplayMode($mode)
	{
		if ( in_array($mode, array('TOP', 'ADVERTISEMENT')) )
			$this->displayMode = $mode;
	}
	
	public function write(IManageable $adzList)
	{		
		switch ( $this->displayMode )
		{
			case 'TOP':
				$query = "
					SELECT
						id, title
					FROM
						kdm2_adz
					WHERE
						id != " . $this->selectedAdId . " 
						AND flags = 'TOP'
						AND (date_start >= CURDATE() OR date_finish >= CURDATE())
					ORDER BY RAND()
					LIMIT 1";
				break;
			
			case 'ADVERTISEMENT':
		
				$query = "
					SELECT
						id, title
					FROM
						kdm2_adz
					WHERE
						id != " . $this->selectedAdId . " 
						AND type = 'ADVERTISEMENT'
						AND flags != 'TOP'						
					ORDER BY RAND()
					LIMIT 1";
				break;
				
			default:
				return false;
		}
		$adz = $adzList->fetch($query);
		if ( empty($adz) )
		{
			$this->status = 'Не найдено ни одного анонса для показа';
			return false;	
		}
		
		$ad = $adz[0];
		
		$search = array('id', 'title');

		foreach ( $search as &$label )
		{
			$label = '{' . $label . '}';
		}
		
		$replace = array($ad['id'], $ad['title']);
		
		$entry = file_get_contents($this->templateFile);
		
		echo str_replace($search, $replace, $entry);
		
		return true;
	}
}
?>
