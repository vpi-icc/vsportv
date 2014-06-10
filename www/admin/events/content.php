<h1>Новое мероприятие</h1>
<?		
	$eventAddAction = EventActionFactory::getAction('EventAddAction');
	$eventAddAction->setHandler(new EventsList);
	$eventAddForm = new EventAddForm;
	$formTemplateFile = $_SERVER['DOCUMENT_ROOT'] . '/admin/events/addeventform.php';
	if ( !$eventAddForm->setTemplateFile($formTemplateFile) )
		Object::showError($eventAddForm->getStatus());
	else
		$eventAddForm->handle($eventAddAction);	
	
?>
