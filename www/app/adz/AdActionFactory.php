<?
	class AdActionFactory extends ActionFactory
	{	
		public static function getAction($actionType)
		{
			if ( empty($_REQUEST['action']) ) return new GenericAction;
			$requestAction = $_REQUEST['action'];
			switch ( $actionType )
			{
				case 'GenericAddAction':
					if ( $requestAction == 'addad' ) return new $actionType;
					
				case 'GenericModifyAction':
					if ( $requestAction == 'modifyad' ) return new $actionType;
					
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
