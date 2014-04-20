<?
class HTMLCheckBoxArray extends HTMLFormElement
{
	public $datagrid = NULL; // 'value' => 'title';
	public $orientation = 'horizontal'; // as opposed to vertical
	
	public function __construct($_name = '', $_data = '', $title = '')
	{
		parent::__construct($_name, $_data, $title);
	}
	
	public function validate()
	{
		if ( !parent::validate() )
		{
			$this->errorDescription = 'ƒолжен быть выбран хот€ бы один вариант в&nbsp;поле &laquo;' . $this->title . '&raquo;';
			return false;
		}
		
		$original_fields = array_keys($this->datagrid);
		foreach ( $this->data as $key => $value )
		{									
			if ( !in_array($value, $original_fields) )
			{
				unset($this->data[$key]);
			}
		}
		if ( !parent::validate() )
		{
			$this->errorDescription = 'ƒолжен быть выбран хот€ бы один вариант в&nbsp;поле &laquo;' . $this->title . '&raquo;';
			return false;
		}
		$this->isValid = true;
		return true;
	}
	
	public function __toString()
	{
		if ( empty($this->name) ) return '<div class="error">ѕоле должно иметь им€</div>';
		$element = '';
		$br = '';
		if ( $this->orientation == 'vertical' ) $br = '<br />';
		foreach ( $this->datagrid as $value => $title )
		{				
			$checked = in_array($value, $this->defaultValue) ? 'checked ' : '';				
			$element .= '<input type="checkbox" name="' . $this->name . '[]" value="' . $value . '" ' . $checked . '/>' . $title . $br;
		}
		if ( !$this->isValid ) $element = '<div class="error">' . $element . '</div>';
		return $element;
	}
}
?>