<?
class File extends Object
{
	public $id;
	public $href;
	public $isHidden;
	public $title;
	public $size;
	public $type;
	
	public function __construct($id, $url, $filename, $title, $flags, $size, $type)
	{
		$this->id = $id;
		$this->href = '/_files' . substr($url, 0, strrpos($url, '/')) . '/' . $filename;
		if ( $flags == 'HIDDEN' ) $this->isHidden = true;
		$this->title = $title;
		$this->size = $size;
		$this->type = $type;
	}
	
	public function __toString()
	{
		if ( $this->isHidden )
			echo '<span class="grey">' . $this->title . '</span>';
		else
			echo '<a href="' . $this->href . '">' . $this->title . '</a>';
	}
}
?>