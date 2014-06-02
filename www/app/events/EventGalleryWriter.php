<?
class EventGalleryWriter extends GenericWriter
{
	protected $templateFile = NULL;
	protected $photosCount;
	
	public function setPhotosCount($cnt)
	{
		if ( (int)$cnt <= 0 )
		{
			$this->status = 'Неверное количество фотографий';
			$this->showError($this->status);
			return false;
		}
		$this->photosCount = $cnt;
		return true;
	}
		
	public function write(IManageable $galleryList)
	{
		$query = "
			SELECT
				id, id_cover, title
			FROM
				kfkis_events
			WHERE
				id_cover != '0' AND ( flags != 'HIDDEN' OR flags IS NULL ) limit 0,".$this->photosCount." ";
		
		$photoList = $galleryList->fetch($query);
		$item = '';
		foreach ( $photoList as $photo )
		{
			$item = '<td><a href="?section=press&id=' . $photo['id'] . '"><img class="photo" src="/_images/photos/' . $photo['id'] . '/' . $photo['id_cover'] . '_small.jpg" alt="cover" title="' . $photo['title'] . '" /></a></td>';
			$photos[] = $item;
		}
		
		if ( empty($photos) )
		{
			$this->status = 'Фотографии не&nbsp;выбраны';
			$this->showError($this->status);
			return false;
		}
		// разбить на 3 строки по 4 фото в каждой
		
		//$photosTable = '<table><tr>'.$photosLine[0].'</tr></table>';
		
		//return $photosTable;
		
	}
}
?>