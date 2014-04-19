<?
	class EventActionFactory extends ActionFactory
	{	
		public static function getAction($actionType)
		{
			if ( empty($_REQUEST['action']) ) return new GenericAction;
			$requestAction = $_REQUEST['action'];
			switch ( $actionType )
			{
				case 'EventAddAction':
					if ( $requestAction == 'addevent' ) return new $actionType;
					
				case 'EventModifyAction':
					if ( $requestAction == 'modifyevent' ) return new $actionType;
					
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
