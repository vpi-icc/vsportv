<?

class PhotoGallery
{
	public $path_www;						// web path (from site root)
	public $path_local;						// local path
	public $alt = "Alternative Text";		// alternative text for images
	private $list = array();				// array of image file names	
	
	private function Error($err_msg, $err_descr)
	{
		echo '<p class="err_msg">A system error has occured: &quot;' . $err_msg . '&quot;</p>';
		echo '<span class="err_descr">' . $err_descr . '</span>';
		echo '<br />';
	}
	
	public function __construct($path_local_to_photos_from_site_root, $alternative_text)
	{
		$this->path_www = $path_local_to_photos_from_site_root;
		$this->path_local = $_SERVER['DOCUMENT_ROOT'] . $this->path_www;
		$this->alt = $alternative_text;
	
		if ( is_dir($this->path_local) ) 
		{
			if ( $dh = opendir($this->path_local) ) 
			{
				while ( ($file = readdir($dh)) !== false )
				{
					if ( $file != '.' && $file != '..' && filetype($this->path_local . $file) != 'dir' )
					{
						$this->list[] = $file;
					}
				}
				closedir($dh);
			}
			//$this->exhibit();
		}
		else
		{
			$this->Error("Отсутствует директория", $this->path_www);
		}		
	}		

	public function exhibit( $limit = -1 )
	{
		$sid = rand(); // random group number to split photos into separate grpoups (lightbox feature)
		$counter = 0; //counter output images
		foreach ( $this->list as $photo ) 
		{		
			if (!strpos($photo, 'large'))
			{
				/*
					$im1 = @imagecreatefromjpeg($this->path_local . str_replace(".jpg","",$photo) . "_large.jpg");
					$x = imagesx($im1);
					$y = imagesy($im1);
					$x += 20; $y += 20;
					imagedestroy($im1);
				*/
			/*
			echo "<div id='img_gallery'><a href='#' onclick='openw(\"" . $this->path_www . str_replace(".jpg","",$photo) . "_large.jpg" . "\",\"drow\"," . $x . "," . $y . "); return false;' ><img src='" . $this->path_www . $photo . "' border='0' alt='" . $this->alt . "' title='" . $this->alt . "'/></a></div>";	
			*/		
				echo "<a href='" . $this->path_www . str_replace(".jpg","", $photo) . "_large.jpg' rel='lightbox[" . $sid . "]' title='" . $this->alt . "'><img src='" . $this->path_www . $photo . "' alt='" . $this->alt . "' title='" . $this->alt . "' class='photo' /></a> ";	
				/*echo "<img src='" . $this->path_www . $photo . "' alt='" . $this->alt . "' title='" . $this->alt . "' class='photo' />";*/	
				$counter++;
				if ( $limit > 0 && $counter > $limit ) return;
			}
		}

	}
}