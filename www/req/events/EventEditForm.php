<?
class EventEditForm extends EventAddForm
{
	public function __construct()
	{
		parent::__construct();
	
		$elem = $this->addElement('HTMLNumericInput', 'id', 'Идентификатор мероприятия', true);
		$elem->htmlAttrs['type'] = 'hidden';
		$elem->lowerLimit = 1;
	}
}
?>