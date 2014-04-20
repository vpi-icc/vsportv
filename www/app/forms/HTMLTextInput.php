<?
class HTMLTextInput extends HTMLFormElement
{
	public $maxLength = NULL;
	public $defaultValue = NULL;
	public $multiple = false;
	
	public $htmlAttrs = array(
		'type' => 'text');
					
	public $format = NULL;
	public $formatDescription = NULL;
	
	public function __construct()
	{
		
	}
	
	public function validate()
	{							
		if ( !parent::validate() ) return false;
		if ( empty($this->data) && !$this->required ) return true;
		
		if ( $this->maxLength )
		{
			if ( strlen($this->data) > $this->maxLength )
			{
				$this->isValid = false;
				$this->errorDescription = '���� &laquo;' . $this->title . '&raquo; ��&nbsp;������ ��������� ' . $this->maxLength . ' �������� �&nbsp;�����';
				return false;
			}
		}
		if ( $this->format )
		{
			if ( !preg_match($this->format, $this->data) )
			{
				$this->isValid = false;
				$this->errorDescription = '���� &laquo;' . $this->title . '&raquo; ������ ��������������� ������� &laquo;' . $this->formatDescription . '&raquo;';
				return false;	
			}
		}							
		$this->isValid = true;
		$this->errorDescription = NULL;
		return true;
	}
	
	public function __toString()
	{
		if ( empty($this->name) ) return '<div class="error">���� ������ ����� ���</div>';
		$this->htmlAttrs['name'] = $this->name;
		if ( $this->multiple ) $this->htmlAttrs['name'] .= '[]';
		if ( !empty($this->data) ) $this->htmlAttrs['value'] = $this->data;
		else if ( !empty($this->defaultValue) ) $this->htmlAttrs['value'] = $this->defaultValue;
		$element = '<input ';
		foreach ( $this->htmlAttrs as $attr => $value )
		{
			$element .= $attr . '="' . $value . '" ';
		}
		$element .= '/>';
		if ( !$this->isValid ) $element = '<div class="error">' . $element . '</div>';
		return $element;
	}
}	
?>
