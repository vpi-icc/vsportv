<?
class AnnounceAddForm extends XForm
{
	public function __construct()
	{
		parent::__construct();
		$elem = $this->addElement('HTMLTextInput', 'title', 'Заголовок', true);
		
		$elem = $this->addElement('HTMLTextInput', 'dateAnn', 'Дата', true, date('Y-m-d'));
		$elem->format = '/^\d{4}-\d{2}-\d{2}$/i';
		$elem->formatDescription = 'ГГГГ-ММ-ДД';
		
		$elem = $this->addElement('HTMLTextInput', 'details', 'Детали', false, 'г. Волжский');
		$elem->maxLength = 100;
			
		$elem = $this->addElement('HTMLTextArea', 'summary', 'Краткое описание', true);
		$elem->maxLength = 1024;
	}
}
?>