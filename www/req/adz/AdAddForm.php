<?
class AdAddForm extends XForm
{
	public function __construct()
	{
		parent::__construct();
		
		$elem = $this->addElement('HTMLTextInput', 'title', '���������', true);
		
		$elem = $this->addElement('HTMLTextInput', 'place', '����� ����������', false, '�. ��������');
		
		$elem = $this->addElement('HTMLSelectArray', 'type', '��� ������', true, 'ADVERTISEMENT');
		$elem->datagrid = self::$adTypes;
		
		$elem = $this->addElement('HTMLCheckBox', 'topflag', '������', true);		

		$elem = $this->addElement('HTMLTextInput', 'date_start', '���� ������', false, date('Y-m-d'));
		$elem->format = '/^\d{4}-\d{2}-\d{2}$/i';
		$elem->formatDescription = '����-��-��';
		
		$elem = $this->addElement('HTMLTextInput', 'time_start', '����� ������', false, '00:00');
		$elem->format = '/^\d{2}:\d{2}$/i';
		$elem->formatDescription = '��:��';
				
		$elem = $this->addElement('HTMLTextInput', 'date_finish', '���� ����������', false);
		$elem->format = '/^\d{4}-\d{2}-\d{2}$/i';
		$elem->formatDescription = '����-��-��';
		
		$elem = $this->addElement('HTMLTextInput', 'time_finish', '����� ����������', false);
		$elem->format = '/^\d{2}:\d{2}$/i';
		$elem->formatDescription = '��:��';
				
		$elem = $this->addElement('HTMLTextArea', 'description', '��������', true);
		$elem->maxLength = 10240;
				
		$elem = $this->addElement('HTMLFileInput', 'cover_image', '������� �����������', true);
		$elem->format[] = 'image/pjpeg';
		$elem->format[] = 'image/jpeg';
		$elem->format[] = 'image/jpg';
		$elem->format[] = 'image/gif';

		$elem = $this->addElement('HTMLFileInput', 'attachments', '������������� �����', false);
		$elem->multiple = true;
		
		$elem = $this->addElement('HTMLTextInput', 'filetitles', '�������� �����', false);
		$elem->multiple = true;
	}
}
?>