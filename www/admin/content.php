
<ul>
	<li>
		<a href="/admin/events/">+ Новость</a>
	</li>
	<li>
		<a href="/admin/video/">+ Видео</a>
	</li>
	<li>
		<a href="/admin/video_pro/">+ Видео Pro</a>
	</li>
</ul>


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