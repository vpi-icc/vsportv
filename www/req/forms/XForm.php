<?
class XForm extends Object implements IValidateable
{
	protected $isValid = true;
	protected $formData = array();
	protected $formElements = array();
	protected $formTemplateFile = NULL;	
	protected $status;
		
	public function __construct()
	{

	}
	
	public function createElement($elementType)
	{
		return new $elementType;
		//throw new Exception('Illegal class name passed');
	}
	
	public function getStatusString()
	{
		return $this->status;	
	}
	
	public function &addElement($elementType, $name, $title, $required = false, $defaultValue = '')
	{
		try	{ $element = $this->createElement($elementType); }
		catch ( Exception $e ) { return false; }
		
		$element->name = $name;
		$element->title = $title;
		$element->defaultValue = $defaultValue;
		$element->required = $required;
		
		$this->formElements[$name] = $element;
		return $this->formElements[$name];
	}
	
	public function validate()
	{
		$this->isValid = false;
		$this->status = NULL;
		foreach ( $this->formElements as $name => $element )
		{
			if ( isset($_REQUEST[$name]) )
				$element->data = $_REQUEST[$name];
			elseif ( !empty($_FILES[$name]) )
				$element->data = $_FILES[$name];				
			else
				$element->data = NULL;
			if ( !$element->isValid )
			{
				$this->status .= $element->errorDescription . '<br />';			
			}
		}
		
		if ( !empty($this->status) ) return false;
		
		$this->isValid = true;
		return true;
	}
	
	public function getData()
	{
		foreach ( $this->formElements as $name => $element )
		{
			$this->formData[$name] = $element->data;	
		}
		return $this->formData;
	}
	
	public function setTemplateFile($formTemplateFile)
	{
		if ( !file_exists($formTemplateFile) )
		{
			$this->status = 'Файл &laquo;' . $formTemplateFile . '&raquo; не&nbsp;найден';
			return false;
		}
		$this->formTemplateFile = $formTemplateFile;
		return true;
	}
	
	public function handle(IFormAction $formAction)
	{
		if ( !$formAction )
		{
			$this->draw();
			return false;	
		}
		$formAction->act($this);
	}
	
	private function return_bytes($val) {
 	   $val = trim($val);
		$last = strtolower($val[strlen($val)-1]);
		switch($last) {
			// The 'G' modifier is available since PHP 5.1.0
			case 'g':
				$val *= 1024;
			case 'm':
				$val *= 1024;
			case 'k':
				$val *= 1024;
		}
	
		return $val;
	}
	
	public function draw()
	{
		if ( !$this->formTemplateFile )
		{
			$this->status = 'Не задан шаблон формы';
			return false;	
		}
				
		$formTemplate = file_get_contents($this->formTemplateFile);
		$search = array_keys($this->formElements);
		$search[] = 'MAX_FILE_SIZE';
		foreach ( $search as &$label )
		{
			$label = '{' . $label . '}';
		}
		$replace = array_values($this->formElements);
		$replace[] = $this->return_bytes(ini_get('upload_max_filesize')) / 1024 / 1024;
		
		echo str_replace($search, $replace, $formTemplate);
	}
}
?>