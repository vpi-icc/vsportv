<?
class EventAddForm extends XForm
{
	public function __construct()
	{
		parent::__construct();
		
		$elem = $this->addElement('HTMLRadioGroup', 'type', 'Tип', true, 'INDOOR');
		$elem->datagrid = self::$eventTypes;
	
		$elem = $this->addElement('HTMLSelectArray', 'category', 'Категория', true, 'GENERIC');
		$elem->datagrid = self::$eventCategories;

		$elem = $this->addElement('HTMLSelectArray', 'importance', 'Значение', true, 'MUNICIPAL');
		$elem->datagrid = self::$eventImportance;

		$elem = $this->addElement('HTMLCheckBox', 'topflag', 'Важное', false);

		$elem = $this->addElement('HTMLTextInput', 'title', 'Заголовок', true);

		$elem = $this->addElement('HTMLNumericInput', 'participants', 'Количество участников', false, 0);
		$elem->lowerLimit = 0;
		
		$elem = $this->addElement('HTMLTextInput', 'eventdate', 'Дата', true, date('Y-m-d'));
		$elem->format = '/^\d{4}-\d{2}-\d{2}$/i';
		$elem->formatDescription = 'ГГГГ-ММ-ДД';
		
		$elem = $this->addElement('HTMLTextInput', 'place', 'Место проведения', false, 'г. Волжский');
		$elem->maxLength = 100;
			
		$elem = $this->addElement('HTMLTextArea', 'summary', 'Краткое описание', true);
		$elem->maxLength = 1024;
		
		$elem = $this->addElement('HTMLTextArea', 'description', 'Подробности', true);
		
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