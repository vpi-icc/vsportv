<?
class EventWriter extends GenericWriter
{
	protected $templateFile = NULL;
	protected $eventId;
	
	public function setEventId($id)
	{
		if ( (int)$id <= 0 )
		{
			$this->status = 'Ќеверный номер меропри€ти€';
			$this->showError($this->status);
			return false;
		}
		$this->eventId = $id;
		return true;
	}
		
	public function write(IManageable $eventsList)
	{
		$query = "
			SELECT
				id_cover, title, summary
			FROM
				kfkis_events
			WHERE
				id = " . $this->eventId . " AND ( flags != 'HIDDEN' OR flags IS NULL )";
		
		$events = $eventsList->fetch($query);
		
		if ( empty($events) )
		{
			$this->status = '¬ыбранное меропри€тие не&nbsp;существует';
			$this->showError($this->status);
			return false;
		}
		
		$event = $events[0];
		
		$entry = file_get_contents($this->templateFile);
		$search = array('title', 'summary', 'cover', 'image_src', 'text', 'gallery', 'title_utf8', 'summary_utf8');

		foreach ( $search as &$label )
		{
			$label = '{' . $label . '}';
		}
		
		$replace = array($event['title'], $event['summary']);
		
		$image_src = 'http://' . $_SERVER['HTTP_HOST'] . '/_images';
		
		if ( $event['id_cover'] )
		{
			$cover = '<a href="/_images/events/' . $this->eventId . '/' . $event['id_cover'] . '.jpg" data-lightbox="gallery" title="' . $event['title'] . '"><img class="photo" src="/_images/events/' . $this->eventId . '/' . $event['id_cover'] . '_large.jpg" alt="cover" title="' . $event['title'] . '" /></a>';
			$image_src .= '/events/' . $this->eventId . '/' . $event['id_cover'] . '_small.jpg';
		}
		else
		{
			$cover = '<img class="photo" src="/_images/_layout/no_image_150.gif" alt="cover" title="' . $event['title'] . '" />';
			$image_src .= '/_layout/no_image_150.gif';
		}
		
		$replace[] = $cover;		
		$replace[] = $image_src;		
		
		$descriptionFile = $_SERVER['DOCUMENT_ROOT'] . '/events/descriptions/' . $this->eventId . '.php';
		if ( !file_exists($descriptionFile) )
		{			
			$this->status = '‘айл описани€ дл€ данного меропри€ти€ не&nbsp;найден';
			$replace[] = '<div class="error">' . $this->status . '</div>';
		}
		else		
		{
			$contents = file_get_contents($descriptionFile);
			
			$query = "
				SELECT id, orientation
				FROM kfkis_photos
				WHERE id_event = " . $this->eventId . " AND id != " . $event['id_cover'] . "
				ORDER BY `order`";
			
			$photosList = $eventsList->fetch($query);
			
			/*
			if ( empty($photosList) )
			{
				$this->status = 'Ќет фотографий с&nbsp;данного меропри€ти€';
				$replace[] = '<div class="notice">' . $this->status . '</div>';
			}
			*/
			//			$gallery = "";
			
			
			$marker = "+фото";
			$articleChunks = explode($marker, $contents);
			$nChunks = count($articleChunks);
			$i = 1;
			foreach ( $photosList as $photo )
			{
				if ( $i >= $nChunks ) break; // stop inserting images if there's no more markers
				$img = '<img class="photo" src="/_images/events/' . $this->eventId . '/' . $photo['id'] . '.jpg" alt="photo" />';
				$articleChunks[$i - 1] .= "\n" . $img;
				$i++;
			}
			$contents = implode('', $articleChunks);
			$replace[] = $contents;
			
			/*
			$delta = strlen($marker);
			$pos = 0;
			$contents_converted = '';
			foreach ( $photosList as $photo )
			{
				$img = '<img class="photo" src="/_images/events/' . $this->eventId . '/' . $photo['id'] . '.jpg" alt="photo" />';
				$pos = strpos($contents, $marker, $pos);
				if ( $pos === FALSE ) break; // если больше нет маркеров, выйти из цикла; оставшиес€ фотки остаютс€ скрытыми				
				$contents_converted .= substr_replace($contents, $img, $pos);
				$pos += $delta - 2;
			}
			//if ( $pos !== FALSE ) $contents_converted .= substr_replace($marker, '', $pos, strlen($contents)); // wipe out exceeding markers if no more photos exist in DB
			$replace[] = $contents_converted;
			*/
		}
		
		$replace[] = html_entity_decode($event['title']);
		$replace[] = html_entity_decode($event['summary']);
				
		echo str_replace($search, $replace, $entry);
	}
}
?>