<h1>Изменение мероприятия</h1>
<?
	$eventModifyAction = EventActionFactory::getAction('EventModifyAction');
	$eventList = new EventsList;
	$eventModifyAction->setHandler($eventList);
	//Необходимо сделать проверку на корректность id новости
	//идентификатор новости должен быть числом!
	$eventId = $_GET['id'];
	//
	$query = "SELECT id, title, summary FROM kfkis_events WHERE id=".$eventId;
	$eventData = $eventList->fetch($query);
	foreach ($eventData[0] as $key=>$value)
	{
		$eventData[$key] = $value;
	}
	if (!$eventData)
	{
		Object::showError("Новости с идентификатором $eventId не существует");
		exit;		
	}
	
	$descriptionDir = $_SERVER['DOCUMENT_ROOT'] . '/data/press';
	if (!file_exists($descriptionDir))
	{
		Object::showError('Не существует директории для хранения описания события');	
		exit;
	}

	$descriptionFile = $descriptionDir . '/' . $eventId . '.php';
	if ( !$eventData['description'] = file_get_contents($descriptionFile) )
	{
		Object::showError('Не удалось загрузить описание события из&nbsp;файла');
		exit;
	}		
	
	$eventModifyForm = new EventModifyForm($eventData);
	$formTemplateFile = $_SERVER['DOCUMENT_ROOT'] . '/admin/events/modify/editeventform.php';
	if ( !$eventModifyForm->setTemplateFile($formTemplateFile) )
		Object::showError($eventModifyForm->getStatus());
	else
		$eventModifyForm->handle($eventModifyAction);	
?>

