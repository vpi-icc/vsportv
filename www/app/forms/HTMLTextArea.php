<?
class HTMLTextArea extends HTMLTextInput
{
	public $htmlAttrs = array(
		'class' => 'form-control',
		'cols' => 60,
		'rows' => 10);
	
	public function __construct()
	{
		
	}
	
	public function __toString()
	{
		if ( empty($this->name) ) return '<div class="error">Поле должно иметь имя</div>';
		$this->htmlAttrs['name'] = $this->name;			
		$text = '';
		if ( !empty($this->data) ) $text = $this->data;
		else if ( !empty($this->defaultValue) ) $text = $this->defaultValue;
		$element = '<textarea ';
		foreach ( $this->htmlAttrs as $attr => $value )
		{
			$element .= $attr . '="' . $value . '" ';
		}
		$element .= '>' . $text . '</textarea>';
		if ( !$this->isValid ) $element .= '<span class="glyphicon glyphicon-remove form-control-feedback"></span>';
		//if ( !$this->isValid ) $element = '<div class="error">' . $element . '</div>';
		return $element;
	}
}
?>