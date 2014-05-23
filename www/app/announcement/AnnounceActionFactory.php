<?
	class AnnounceActionFactory extends ActionFactory
	{	
		public static function getAction($actionType)
		{
			if ( empty($_REQUEST['action']) ) return new GenericAction;
			$requestAction = $_REQUEST['action'];
			switch ( $actionType )
			{
				case 'AnnounceAddAction':
					if ( $requestAction == 'addannounce' ) return new $actionType;
					
				case 'AnnounceModifyAction':
					if ( $requestAction == 'modifyannounce' ) return new $actionType;
					
				/*
				case 'GenericDeleteAction':
					if ( $requestAction == 'delete' ) return new GenericDeleteAction;
					break;	
					
				case 'GenericGetAction':
					if ( $requestAction == 'get' ) return new GenericGetAction;
				*/					
			}
			return new GenericAction;
		}
	}
?>
