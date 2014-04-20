<?
class EventAddForm extends XForm
{
	public function __construct()
	{
		parent::__construct();
		
		$elem = $this->addElement('HTMLRadioGroup', 'type', 'T��', true, 'INDOOR');
		$elem->datagrid = self::$eventTypes;
	
		$elem = $this->addElement('HTMLSelectArray', 'category', '���������', true, 'GENERIC');
		$elem->datagrid = self::$eventCategories;

		$elem = $this->addElement('HTMLSelectArray', 'importance', '��������', true, 'MUNICIPAL');
		$elem->datagrid = self::$eventImportance;

		$elem = $this->addElement('HTMLCheckBox', 'topflag', '������', false);

		$elem = $this->addElement('HTMLTextInput', 'title', '���������', true);

		$elem = $this->addElement('HTMLNumericInput', 'participants', '���������� ����������', false, 0);
		$elem->lowerLimit = 0;
		
		$elem = $this->addElement('HTMLTextInput', 'eventdate', '����', true, date('Y-m-d'));
		$elem->format = '/^\d{4}-\d{2}-\d{2}$/i';
		$elem->formatDescription = '����-��-��';
		
		$elem = $this->addElement('HTMLTextInput', 'place', '����� ����������', false, '�. ��������');
		$elem->maxLength = 100;
			
		$elem = $this->addElement('HTMLTextArea', 'summary', '������� ��������', true);
		$elem->maxLength = 1024;
		
		$elem = $this->addElement('HTMLTextArea', 'description', '�����������', true);
		
		$elem = $this->addElement('HTMLFileInput', 'imagepack', 'zip-����� � ������������', false);
		$elem->format[] = 'application/octet-stream';
		$elem->format[] = 'application/x-zip-compressed';
		$elem->format[] = 'image/jpeg';
		$elem->format[] = 'image/jpg';
		$elem->format[] = 'image/gif';
		//$elem->format[] = 'application/zip';
		$elem->formatDescription = '����������� �������� ��������� ����� ������:';
		foreach ( $elem->format as $format )
		{
			$elem->formatDescription .= '<br />' . $format;
		}
	}
}
?>