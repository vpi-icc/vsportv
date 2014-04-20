<?
class HTMLRadioGroup extends HTMLFormElement
{		
	public $datagrid = NULL; // 'value' => 'title';
	public $orientation = 'vertical'; // as opposed to horizontal
	
	public function __construct()
	{
		
	}
	
	public function validate()
	{
		if ( !parent::validate() )
		{
			$this->errorDescription = '���� &laquo;' . $this->title . '&raquo; ������ ����� ���� �� ���� ������������';				
			return false;	
		}
		if ( !in_array($this->data, array_keys($this->datagrid)) )
		{
			$this->isValid = false;
			$this->errorDescription = '���� &laquo;' . $this->title . '&raquo; ������ ����� ���� �� ���� ������������';
			return false;	
		}
		$this->isValid = true;
		return true;
	}
	
	public function __toString()
	{
		if ( !$this->name ) return '<div class="error">���� ������ ����� ���</div>';
		$element = '';
		$br = '';
		if ( $this->orientation == 'vertical' ) $br = '<br />';
		foreach ( $this->datagrid as $value => $title )
		{
			$checked = ( $value === $this->defaultValue ) ? 'checked ' : '';
			$element .= '<input type="radio" name="' . $this->name . '" value="' . $value . '" ' . $checked . ' />' . $title . $br;
		}
		if ( !$this->isValid ) $element = '<div class="error">' . $element . '</div>';
		return $element;
	}
}
?>