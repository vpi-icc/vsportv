<h1>Изменение мероприятия</h1>
<?
	$eventModifyAction = EventActionFactory::getAction('EventModifyAction');
	$eventList = new EventsList;
	$eventModifyAction->setHandler($eventList);
	//Необходимо сделать проверку на корректность id новости
	//идентификатор новости должен быть числом!
	//Лучше проверять на int или numeric?
	//$eventId = $_GET['id'];
	//if (!is_numeric($eventId))
	$eventId = (int) $_GET['id'];
	if (!is_int($eventId)||$eventId<0)
	{
		Object::showError("Идентификатор новости должен быть целым положительным числом");
		exit;		
	}

	$query = "SELECT id, title, summary FROM kfkis_events WHERE id=".$eventId;
	$eventData = $eventList->fetch($query);
	
	if (!$eventData)
	{
		Object::showError("Новости с указанным идентификатором не существует");
		exit;		
	}
	
	foreach ($eventData[0] as $key=>$value)
	{
		$eventData[$key] = $value;
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

