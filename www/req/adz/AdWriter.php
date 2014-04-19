<?
class AdWriter extends GenericWriter
{
	protected $templateFile = NULL;
	protected $adId = NULL;
	
	public function setAdId($id)
	{
		$id = (int)$id;
		if ( $id <= 0 )
		{
			$this->status = 'Указан неверный номер анонса';
			return false;	
		}
		$this->adId = $id;
		return true;
	}
	
	public function write(IManageable $adzList)
	{
		if ( !$this->adId )
		{
			$this->status = 'Не указан идентификатор анонса';
			return false;	
		}
		
		$query = "
			SELECT
				title
			FROM
				kdm2_adz
			WHERE
				id = " . $this->adId . " AND (flags != 'HIDDEN' OR flags IS NULL)";				
		
		$adz = $adzList->fetch($query);
		if ( empty($adz) )
		{
			$this->status = 'Указанный анонс не существует';
			return false;	
		}
		
		$ad = $adz[0];
			
			
		$entry = file_get_contents($this->templateFile);
		$search = array('id', 'title', 'text', 'files', 'title_utf8');	

		foreach ( $search as &$label )
		{
			$label = '{' . $label . '}';
		}
		
		$replace = array();
		$replace[] = $this->adId;
		$replace[] = $ad['title'];
		
		$description_file = $_SERVER['DOCUMENT_ROOT'] . '/adz/descriptions/' . $this->adId . '.php';
		if ( !file_exists($description_file) )
			$text = '<div class="error">Файл описания для данного анонса не&nbsp;найден</div>';
		else
			$text = file_get_contents($description_file);
					
		$replace[] = $text;
		
		$storage = new FileStorage;
		$storage->load();
		$replace[] = $storage;
		$replace[] = html_entity_decode($ad['title']);

		echo str_replace($search, $replace, $entry);
		
		return false;
	}
}
?>
