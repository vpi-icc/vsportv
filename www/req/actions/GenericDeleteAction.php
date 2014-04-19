<?
	class GenericDeleteAction extends GenericAction
	{		
		public function delete($id)
		{
			if ( !$handler->delete($id) )
			{
				$this->status = $handler->getStatusString();
				return false;
			}
			return true;
		}		
	}
?>