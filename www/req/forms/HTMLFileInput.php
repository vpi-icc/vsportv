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
		UPLOAD_ERR_OK => '���� ������� ��������',
		UPLOAD_ERR_INI_SIZE => '�������� ������������ ������ �����, ����������� ��������',
		UPLOAD_ERR_FORM_SIZE => '�������� ������������ ������ �����, ��������� � �����',
		UPLOAD_ERR_PARTIAL => '���� �������� ����������� (�.&nbsp;�., ��������)',
		UPLOAD_ERR_NO_FILE => '� ����� �� ��� �������� ����',
		UPLOAD_ERR_NO_TMP_DIR => '����������� ������� ��� ��������� ������ �� �������',
		UPLOAD_ERR_CANT_WRITE => '�� ������� �������� ���� �� ���� �� �������',
		UPLOAD_ERR_EXTENSION => '�������� ����� �������� ����� �� ���������� PHP');
		
	public function __construct()
	{
		$this->max_file_size = rtrim(ini_get('upload_max_filesize'), 'MKG');
	}
	
	public function validate()
	{				
		if ( !parent::validate() )
		{
			$this->errorDescription = '������ ���� �������� ���� ��� ���� &laquo;' . $this->title . '&raquo;';
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
				$this->errorDescription = '������� ������ ��� ���� &laquo;' . $this->title . '&raquo; �����������';				
				return false;	
			}
			if ( !in_array($error, array(UPLOAD_ERR_OK, UPLOAD_ERR_NO_FILE)) )
			{				
				$this->errorDescription = '��������� ������ ��� ��������� ����� (' . $this->title . '): &laquo;' . $this->errorCodes[$error] . '&raquo;';
				return false;	
			}
			if ( $error != UPLOAD_ERR_NO_FILE && !is_uploaded_file($tmp_name) )
			{
				$this->errorDescription = '����, ����������� ����� ���� &laquo;' . $this->title . '&raquo;, ��&nbsp;�������������� ��� �������';
				return false;	
			}
			if ( $this->sizeLimit && ($size > $this->sizeLimit) )
			{
				$this->errorDescription = '����������� ���� (' . $name . ') ��������� ����������� ���������� ������ (' . $this->sizeLimit . ')';
				return false;	
			}
			if ( $error != UPLOAD_ERR_NO_FILE && !empty($this->format) && !in_array($type, $this->format) )
			{
				if ( empty($this->formatDescription) )
				{
					$this->formatDescription = '����������� �������� ��������� ����� ������:';
					foreach ( $this->format as $format )
						$this->formatDescription .= '<br />' . $format;
				}
				$this->errorDescription = '����������� ���� (' . $name . ') [' . $type . '] ��&nbsp;������������� ���������� ���� (' . $this->formatDescription . ')';
				return false;
			}
		}
		$this->isValid = true;
		$this->errorDescription = NULL;
		return true;
	}
	
	public function __toString()
	{
		if ( !$this->name ) return '<div class="error">���� ������ ����� ���</div>';
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