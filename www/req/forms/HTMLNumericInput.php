<?
class HTMLNumericInput extends HTMLTextInput
{
	public $lowerLimit = NULL;
	public $upperLimit = NULL;
	
	public function __construct()
	{
		
	}
	
	public function validate()
	{
		if ( !parent::validate() ) return false;		
		if ( !is_numeric($this->data) && !empty($this->data) ) 
		{			
			$this->isValid = false;
			$this->errorDescription = 'Поле &laquo;' . $this->title . '&raquo; должно иметь цифровой <nobr>формат (0&ndash;9)</nobr>';
			return false; 	
		}
		if ( empty($this->data) )
		{
			$this->data = $this->defaultValue;	
		}
		if ( !is_null($this->lowerLimit) && ($this->data < $this->lowerLimit) )
		{
			$this->isValid = false;
			$this->errorDescription = 'Поле &laquo;' . $this->title . '&raquo; не&nbsp;должно опускаться ниже&nbsp;' . $this->lowerLimit;
			return false;
		}
		if ( !is_null($this->upperLimit) && ($this->data > $this->upperLimit) )
		{
			$this->isValid = false;
			$this->errorDescription = 'Поле &laquo;' . $this->title . '&raquo; не&nbsp;должно превышать&nbsp;' . $this->upperLimit;
			return false;	
		}
		$this->isValid = true;
		$this->errorDescription = NULL;
		return true;
	}
}
?>
