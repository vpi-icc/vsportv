<?
class AnnounceModifyForm extends XForm
{
	public function __construct($data)
	{
		parent::__construct();
		
		$elem = $this->addElement('HTMLTextInput', 'title', 'Заголовок', true);
		$elem->data = $data['title'];
		
		$elem = $this->addElement('HTMLTextInput', 'dateAnn', 'Дата', true);
		$elem->data = $data['date_start'];
		
		$elem = $this->addElement('HTMLTextInput', 'details', 'Детали', true);
		$elem->maxLength = 1024;
		$elem->data = $data['place'];
		
		$elem = $this->addElement('HTMLTextArea', 'lead', 'Описание', true);
		$elem->data = $data['lead'];
		
		$elem = $this->addElement('HTMLTextInput', 'id', '', true);
		$elem->htmlAttrs['type'] = 'hidden';
		$elem->data = $data['id'];
	}
}
?>