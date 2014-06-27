<h1>Новый анонс</h1>
<?		
	$eventAddAction = AnnounceActionFactory::getAction('AnnounceAddAction');
	$eventAddAction->setHandler(new AnnounceList);
	$eventAddForm = new AnnounceAddForm;
	$formTemplateFile = $_SERVER['DOCUMENT_ROOT'] . '/admin/announcement/addAnnform.php';
	if ( !$eventAddForm->setTemplateFile($formTemplateFile) )
		Object::showError($eventAddForm->getStatus());
	else
		$eventAddForm->handle($eventAddAction);	
	
?>