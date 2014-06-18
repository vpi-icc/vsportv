
		<a href="/admin/announcement/" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Анонс</a>

		<a href="/admin/events/" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Новость</a>



<?
/*
	$eventMainListWriter = new EventMainListWriter;
	$template = $_SERVER['DOCUMENT_ROOT'] . '/eventEntryMain.html';
	$eventMainListWriter->setTemplate($template);	
	$eventsList = new EventsList;
	$eventsList->write($eventMainListWriter);
*/
?>

<h1>Список прошедших мероприятий</h1>

<?
	$eventsList = new EventsList;
	$template = $_SERVER['DOCUMENT_ROOT'] . '/admin/events/eventEntry.html';
	$eventsListWriter = new EventAdmListWriter;
	$eventsListWriter->setTemplate($template);
	$eventsList->write($eventsListWriter);
?>