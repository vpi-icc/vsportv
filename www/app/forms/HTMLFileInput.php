<?
class HTMLFileInput extends HTMLFormElement
{
	public $multiple = false;
	protected $max_file_size = 0;
	public $format = array();		
	public $formatDescription = NULL;
	public $sizeLimit = 0;
	public $htmlAttrs = array(
		'type' => 'file');
		
	protected $errorCodes = array(
		UPLOAD_ERR_OK => 'Файл успешно загружен',
		UPLOAD_ERR_INI_SIZE => 'Превышен максимальный размер файла, допускаемый сервером',
		UPLOAD_ERR_FORM_SIZE => 'Превышен максимальный размер файла, указанный в форме',
		UPLOAD_ERR_PARTIAL => 'Файл загружен неполностью (т.&nbsp;е., частично)',
		UPLOAD_ERR_NO_FILE => 'К форме не был приложен файл',
		UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует каталог для временных файлов на сервере',
		UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск на сервере',
		UPLOAD_ERR_EXTENSION => 'Загрузка файла прервана одним из расширений PHP');
		
	public function __construct()
	{
		$this->max_file_size = rtrim(ini_get('upload_max_filesize'), 'MKG');
	}
	
	public function validate()
	{				
		if ( !parent::validate() )
		{
			$this->errorDescription = 'Должен быть загружен файл для поля &laquo;' . $this->title . '&raquo;';
			return false;
		}
		$this->isValid = false;
		
		/*
		var_dump($this->data);
		echo '<br />';
		return false;
		*/
		$n = count($this->data['name']);
		for ( $i = 0; $i < $n; $i++ )
		{
			$tmp_name = $this->multiple ? $this->data['tmp_name'][$i] : $this->data['tmp_name'];
			$error = $this->multiple ? $this->data['error'][$i] : $this->data['error'];
			$size = $this->multiple ? $this->data['size'][$i] : $this->data['size'];
			$name = $this->multiple ? $this->data['name'][$i] : $this->data['name'];
			$type = $this->multiple ? $this->data['type'][$i] : $this->data['type'];
			
			if ( $this->required &&	( $size == 0 ) && empty($tmp_name) )
			{
				$this->errorDescription = 'Наличие данных для поля &laquo;' . $this->title . '&raquo; обязательно';				
				return false;	
			}
			if ( !in_array($error, array(UPLOAD_ERR_OK, UPLOAD_ERR_NO_FILE)) )
			{				
				$this->errorDescription = 'Произошла ошибка при получении файла (' . $this->title . '): &laquo;' . $this->errorCodes[$error] . '&raquo;';
				return false;	
			}
			if ( $error != UPLOAD_ERR_NO_FILE && !is_uploaded_file($tmp_name) )
			{
				$this->errorDescription = 'Файл, загруженный через поле &laquo;' . $this->title . '&raquo;, не&nbsp;квалифицирован как таковой';
				return false;	
			}
			if ( $this->sizeLimit && ($size > $this->sizeLimit) )
			{
				$this->errorDescription = 'Загруженный файл (' . $name . ') превышает максимально допустимый размер (' . $this->sizeLimit . ')';
				return false;	
			}
			if ( $error != UPLOAD_ERR_NO_FILE && !empty($this->format) && !in_array($type, $this->format) )
			{
				if ( empty($this->formatDescription) )
				{
					$this->formatDescription = 'Допускается загрузка следующих типов файлов:';
					foreach ( $this->format as $format )
						$this->formatDescription .= '<br />' . $format;
				}
				$this->errorDescription = 'Загруженный файл (' . $name . ') [' . $type . '] не&nbsp;соответствует требуемому типу (' . $this->formatDescription . ')';
				return false;
			}
		}
		$this->isValid = true;
		$this->errorDescription = NULL;
		return true;
	}
	
	public function __toString()
	{
		if ( !$this->name ) return '<div class="error">Поле должно иметь имя</div>';
		$this->htmlAttrs['name'] = $this->name;
		if ( $this->multiple ) $this->htmlAttrs['name'] .= '[]';
		$element = '<input type="hidden" name="MAX_FILE_SIZE" value="' . $this->max_file_size * 1024 * 1024 . '" />';
		$element .= '<input ';
		foreach ( $this->htmlAttrs as $attr => $value )
		{
			$element .= $attr . '="' . $value . '" ';
		}
		$element .= ' />';
		if ( !$this->isValid ) $element = '<div class="error">' . $element . '</div>';
		return $element;
	}
}
?>