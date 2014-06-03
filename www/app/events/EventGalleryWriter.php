<?
class EventGalleryWriter extends GenericWriter
{
	protected $templateFile = NULL;
	protected $photosCount, $photosOnLine, $linesCount;
	
	public function setPhotosCount($photosCnt, $onLineCnt)
	{
		if ( (int)$photosCnt <= 0 )
		{
			$this->status = 'Неверное количество фотографий';
			$this->showError($this->status);
			return false;
		}
		
		if ( (int)$onLineCnt <= 0 )
		{
			$this->status = 'Неверное количество фотографий в строке';
			$this->showError($this->status);
			return false;
		}
		
		$this->photosCount = $photosCnt;
		$this->photosOnLine = $onLineCnt;
		$this->linesCount = ceil($this->photosCount/$this->photosOnLine);
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
				id_cover != '0' AND ( flags != 'HIDDEN' OR flags IS NULL ) ORDER BY id DESC limit 0,".$this->photosCount." ";
		
		$photoList = $galleryList->fetch($query);
		$item = '';
		foreach ( $photoList as $photo )
		{
			$item = '<td><a href="?section=press&id=' . $photo['id'] . '"><img class="photo" src="/_images/photos/' . $photo['id'] . '/' . $photo['id_cover'] . '_small.jpg" alt="' . $photo['title'] . '" title="' . $photo['title'] . '" /></a></td>';
			$photos[] = $item;
		}
		
		if ( empty($photos) )
		{
			$this->status = 'Фотографии не&nbsp;выбраны';
			$this->showError($this->status);
			return false;
		}
		// разбить на 3 строки по 4 фото в каждой
		$k = -1;
		$row = array();
		for ( $i = 0; $i < $this->photosCount; $i++ )
		{
			if ( $i % $this->photosOnLine === 0 )
			{
				$k++;
				$row[] = '';
			}
			$row[$k] .= $photos[$i];
			//echo $k.'<br/>';
		}
		$photosTable = '';
		foreach ($row as $line)
		{
			$photosTable.='<tr>'.$line.'</tr>';
		}
				
		$photosTable = '<table>'.$photosTable.'</table>';
		
		echo $photosTable;
		
	}
}
?>