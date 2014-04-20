<?
class HTMLCheckBox extends HTMLFormElement
{		
	public $defaultValue = false;
	public $htmlAttrs = array();
	public $data = false;
		
	public function __construct()
	{

	}
	
	public function validate()
	{
		$this->data = !empty($this->data) ? true : false;
		$this->isValid = true;
		return true;	
	}
	
	public function __toString()
	{
		if ( empty($this->name) ) return '<div class="error">Поле должно иметь имя</div>';
		$this->htmlAttrs['name'] = $this->name;
		$element = '<input type="checkbox" ';
		foreach ( $this->htmlAttrs as $attr => $value )
		{
			$element .= $attr . '="' . $value . '" ';	
		}
		if ( $this->defaultValue ) $element .= 'checked';
		$element .= '/>';
		if ( !$this->isValid ) $element = '<div class="error">' . $element . '</div>';
		return $element;
	}		
}
?>