
<ul>
	<li>
		<a href="/admin/events/">+ �������</a>
	</li>
	<li>
		<a href="/admin/video/">+ �����</a>
	</li>
	<li>
		<a href="/admin/video_pro/">+ ����� Pro</a>
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

<h1>������ ��������� �����������</h1>

<?
	$eventsList = new EventsList;
	$template = $_SERVER['DOCUMENT_ROOT'] . '/admin/events/eventEntry.html';
	$eventsListWriter = new EventAdmListWriter;
	$eventsListWriter->setTemplate($template);
	$eventsList->write($eventsListWriter);
?>