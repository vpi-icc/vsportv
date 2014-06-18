<?
class HTMLSelectArray extends HTMLFormElement
{
	public $multiple = false;
	public $datagrid = NULL; // 'value' => 'title';
	public $htmlAttrs = array('class' => 'form-control');
	public function __construct()
	{
		
	}
	
	public function validate()
	{
		if ( !parent::validate() )
		{
			$this->errorDescription = 'Должен быть выбран хотя бы один вариант в&nbsp;поле &laquo;' . $this->title . '&raquo;';
			return false;
		}
		if ( !$this->multiple && is_array($this->data) )
		{
			$this->isValid = false;
			$this->errorDescription = 'Поле &laquo;' . $this->title . '&raquo; может иметь только одно значение';
			return false;	
		}			
		$original_values = array_keys($this->datagrid);
		if ( $this->multiple )
		{
			foreach ( $this->data as &$value )
			{					
				if ( !in_array($value, $original_values) )
				{
					unset($value);
				}
			}
			if ( empty($this->data) && $this->required )
			{
				$this->isValid = false;
				$this->errorDescription = 'Поле &laquo;' . $this->title . '&raquo; должно иметь хотя бы одно значение';
				return false;
			}
		}
		else
		{
			if ( !in_array($this->data, $original_values) )									
			if ( $this->defaultValue ) $this->data = $this->defaultValue;
			else
			{
				$this->isValid = false;
				$this->errorDescription = 'Поле &laquo;' . $this->title . '&raquo; должно быть установлено';
				return false;
			}
		}
		$this->isValid = true;
		$this->errorDescription = NULL;
		return true;
	}
	
	public function __toString()
	{
		if ( empty($this->name) ) return '<div class="error">Поле должно иметь имя</div>';
		$this->htmlAttrs['name'] = $this->name;
		$multiple = $this->multiple ? 'multiple ' : '';
		if ( $this->multiple ) $this->htmlAttrs['name'] .= '[]';
		$element = '<select ' . $multiple;
		foreach ( $this->htmlAttrs as $attr => $value )
		{
			$element .= $attr . '="' . $value . '" ';	
		}
		$element .= '>';
		foreach ( $this->datagrid as $value => $title )
		{				
			if ( $this->multiple )
				$selected = in_array($value, $this->defaultValue) ? 'selected ' : '';
			else
				$selected = ($value == $this->defaultValue) ? 'selected ' : '';
			$element .= '<option value="' . $value . '" ' . $selected . '/>' . $title . '</option>';
		}
		$element .= '</select>';
		if ( !$this->isValid ) $element = '<div class="error">' . $element . '</div>';
		return $element;
	}
}
?>