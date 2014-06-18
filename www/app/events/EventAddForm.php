<?
class EventAddForm extends XForm
{
	public function __construct()
	{
		parent::__construct();
		
		$elem = $this->addElement('HTMLTextInput', 'title', 'Заголовок', true);
	
		$elem = $this->addElement('HTMLTextArea', 'summary', 'Бриф', true);
		$elem->maxLength = 1024;
		
		$elem = $this->addElement('HTMLTextArea', 'description', 'Описание', true);
		
		$elem = $this->addElement('HTMLFileInput', 'imagepack', 'zip-архив с фотографиями', false);
		$elem->format[] = 'application/octet-stream';
		$elem->format[] = 'application/x-zip-compressed';
		$elem->format[] = 'image/jpeg';
		$elem->format[] = 'image/jpg';
		$elem->format[] = 'image/gif';
		//$elem->format[] = 'application/zip';
		$elem->formatDescription = 'Допускается загрузка следующих типов файлов:';
		foreach ( $elem->format as $format )
		{
			$elem->formatDescription .= '<br />' . $format;
		}
	}
}
?>