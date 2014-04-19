<?
	class GenericModifyAction extends GenericAction
	{		
		public function act(array $data)
		{
			if ( !$handler->modify($data) )
			{
				$this->status = $handler->getStatusString();
				return false;
			}
			return true;
		}		
	}
?>