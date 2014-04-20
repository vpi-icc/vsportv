<?
class HTMLFormElement implements IValidateable
{
	public $name = NULL;
	public $title = NULL;
	protected $data = NULL;
	public $errorDescription = NULL;
	public $isValid = true;
	public $required = false;
	public $defaultValue = NULL;
	
	public function __construct()
	{
		
	}
			
	public function validate()
	{
		if ( $this->required && empty($this->data) )
		{
			$this->isValid = false;
			$this->errorDescription = '���� &laquo;' . $this->title . '&raquo; ����������� �&nbsp;����������';
			return false;			
		}
		$this->isValid = true;
		$this->errorDescription = NULL;
		return true;	
	}
	
	public function __toString()
	{
		return $data;
	}
	
	public function __get($member)
	{
		if ( $member == 'data' ) return $this->data;	
	}
	
	public function __set($member, $value)
	{
		if ( $member == 'data' )
		{
			$this->data = $value;
			$this->validate();
		}
	}
}
?>