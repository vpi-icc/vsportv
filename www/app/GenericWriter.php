<?
class GenericWriter extends Object implements IGenericWriter
{
	protected $templateFile = NULL;
	
	public function setTemplate($templateFile)
	{
		if ( !file_exists($templateFile) )
		{
			$this->status = '���� ������� ' . $templateFile . ' ��&nbsp;���������� ���� ��&nbsp;������';
			$this->showError($this->status);
			return false;
		}
		$this->templateFile = $templateFile;
		return true;
	}
	
	public function write(IManageable $genericList) {}
}
?>
