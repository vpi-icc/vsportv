<?
class AdAddForm extends XForm
{
	public function __construct()
	{
		parent::__construct();
		
		$elem = $this->addElement('HTMLTextInput', 'title', 'Заголовок', true);
		
		$elem = $this->addElement('HTMLTextInput', 'place', 'Место проведения', false, 'г. Волжский');
		
		$elem = $this->addElement('HTMLSelectArray', 'type', 'Тип анонса', true, 'ADVERTISEMENT');
		$elem->datagrid = self::$adTypes;
		
		$elem = $this->addElement('HTMLCheckBox', 'topflag', 'Важное', true);		

		$elem = $this->addElement('HTMLTextInput', 'date_start', 'Дата начала', false, date('Y-m-d'));
		$elem->format = '/^\d{4}-\d{2}-\d{2}$/i';
		$elem->formatDescription = 'ГГГГ-ММ-ДД';
		
		$elem = $this->addElement('HTMLTextInput', 'time_start', 'Время начала', false, '00:00');
		$elem->format = '/^\d{2}:\d{2}$/i';
		$elem->formatDescription = 'ЧЧ:ММ';
				
		$elem = $this->addElement('HTMLTextInput', 'date_finish', 'Дата завершения', false);
		$elem->format = '/^\d{4}-\d{2}-\d{2}$/i';
		$elem->formatDescription = 'ГГГГ-ММ-ДД';
		
		$elem = $this->addElement('HTMLTextInput', 'time_finish', 'Время завершения', false);
		$elem->format = '/^\d{2}:\d{2}$/i';
		$elem->formatDescription = 'ЧЧ:ММ';
				
		$elem = $this->addElement('HTMLTextArea', 'description', 'Описание', true);
		$elem->maxLength = 10240;
				
		$elem = $this->addElement('HTMLFileInput', 'cover_image', 'Обложка мероприятия', true);
		$elem->format[] = 'image/pjpeg';
		$elem->format[] = 'image/jpeg';
		$elem->format[] = 'image/jpg';
		$elem->format[] = 'image/gif';

		$elem = $this->addElement('HTMLFileInput', 'attachments', 'Прикрепляемые файлы', false);
		$elem->multiple = true;
		
		$elem = $this->addElement('HTMLTextInput', 'filetitles', 'Название файла', false);
		$elem->multiple = true;
	}
}
?>