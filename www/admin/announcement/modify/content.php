<h1>Изменение анонса</h1>
<?
	$announceModifyAction = AnnounceActionFactory::getAction('AnnounceModifyAction');
	$announceList = new AnnounceList;
	$announceModifyAction->setHandler($announceList);
	//Необходимо сделать проверку на корректность id новости
	//идентификатор новости должен быть числом!
	//Лучше проверять на int или numeric?
	//$eventId = $_GET['id'];
	//if (!is_numeric($eventId))
	$announceId = (int) $_GET['id'];
	if (!is_int($announceId)||$announceId<0)
	{
		Object::showError("Идентификатор новости должен быть целым положительным числом");
		exit;		
	}
	$query = "SELECT id, title, lead, place, date_start FROM kfkis_adz WHERE id=".$announceId;
	$announceData = $announceList->fetch($query);
	
	//var_dump($announceData);
	if (!$announceData)
	{
		Object::showError("Анонса с указанным идентификатором не существует");
		exit;		
	}
	
	foreach ($announceData[0] as $key=>$value)
	{
		if (strcmp($key, 'date_start')==0)
		{
			$announceData[$key] = substr($value,0,10);
		}
		else
		{
			$announceData[$key] = $value;
		}
	}
	
	$announceModifyForm = new AnnounceModifyForm($announceData);
	$formTemplateFile = $_SERVER['DOCUMENT_ROOT'] . '/admin/announcement/modify/editAnnform.php';
	if ( !$announceModifyForm->setTemplateFile($formTemplateFile) )
		Object::showError($announceModifyForm->getStatus());
	else
		$announceModifyForm->handle($announceModifyAction);	
?>

