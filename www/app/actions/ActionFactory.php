<?
	class ActionFactory extends Object
	{	
		public static function getAction($actionType)
		{
			if ( empty($_REQUEST['action']) ) return NULL;
			$requestAction = $_REQUEST['action'];
			switch ( $actionType )
			{
				case 'GenericAddAction':
					if ( $requestAction == 'add' ) return new GenericAddAction;
					
				case 'GenericModifyAction':
					if ( $requestAction == 'modify' ) return new GenericModifyAction;
					
				case 'GenericDeleteAction':
					if ( $requestAction == 'delete' ) return new GenericDeleteAction;
					break;	
					
				case 'GenericGetAction':
					if ( $requestAction == 'get' ) return new GenericGetAction;					
				
				default:
					return NULL;
			}
		}
	}
?>
