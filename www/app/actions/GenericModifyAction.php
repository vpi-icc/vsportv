<?
	class GenericModifyAction extends GenericAction
	{		
		/*public function act(array $data)
		{
			if ( !$handler->modify($data) )
			{
				$this->status = $handler->getStatusString();
				return false;
			}
			return true;
		}*/
		
		public function act(XForm $form)
		{
			if ( !$this->checkHandler() ) return false;
			if ( !$form->validate() )
			{
				$this->status = $form->getStatusString();
				$this->showError($this->status);
				$form->draw();
				return false;
			}
			if ( !$this->handler->modify($form->getData()) )
			{
				$this->status = $this->handler->getStatusString();
				$this->showError($this->status);
				return false;
			}
			$this->status = $this->handler->getStatusString();
			$this->showNotice($this->status);
			return true;
		}		
	}
?>