<?
class AnnounceEditForm extends AnnounceAddForm
{
	public function __construct()
	{
		parent::__construct();
	
		$elem = $this->addElement('HTMLNumericInput', 'id', '������������� �����������', true);
		$elem->htmlAttrs['type'] = 'hidden';
		$elem->lowerLimit = 1;
	}
}
?>