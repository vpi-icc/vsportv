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
			$this->errorDescription = '���� &laquo;' . $this->title . '&raquo; ������ ����� �������� <nobr>������ (0&ndash;9)</nobr>';
			return false; 	
		}
		if ( empty($this->data) )
		{
			$this->data = $this->defaultValue;	
		}
		if ( !is_null($this->lowerLimit) && ($this->data < $this->lowerLimit) )
		{
			$this->isValid = false;
			$this->errorDescription = '���� &laquo;' . $this->title . '&raquo; ��&nbsp;������ ���������� ����&nbsp;' . $this->lowerLimit;
			return false;
		}
		if ( !is_null($this->upperLimit) && ($this->data > $this->upperLimit) )
		{
			$this->isValid = false;
			$this->errorDescription = '���� &laquo;' . $this->title . '&raquo; ��&nbsp;������ ���������&nbsp;' . $this->upperLimit;
			return false;	
		}
		$this->isValid = true;
		$this->errorDescription = NULL;
		return true;
	}
}
?>
