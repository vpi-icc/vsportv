<?
	class GenericAction extends Object implements IFormAction
	{
		protected $handler = NULL;
		protected $status = NULL;
					
		public function setHandler(IManageable $handler)
		{
			$this->handler = $handler;	
		}
		
		public function checkHandler()
		{
			if ( !$this->handler )
			{
				$this->status = 'Не установлен объект-обработчик события';
				$this->showError($this->status);
				return false;
			}
			return true;
		}
		
		public function act(XForm $form)
		{
			if ( !$this->checkHandler() ) return false;
			$form->draw();
		}
		
		public function getStatusString()
		{			
			return $this->status;	
		}
	}
?>
