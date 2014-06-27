  
<?
/*
	$eventMainListWriter = new EventMainListWriter;
	$template = $_SERVER['DOCUMENT_ROOT'] . '/eventEntryMain.html';
	$eventMainListWriter->setTemplate($template);	
	$eventsList = new EventsList;
	$eventsList->write($eventMainListWriter);
*/
?>

<!-- Nav tabs -->
<ul class="nav nav-tabs">
  <li class="active"><a href="#news" data-toggle="tab">Новости</a></li>
  <li><a href="#announcement" data-toggle="tab">Анонсы</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane active" id="news">
    <a href="/admin/events/" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Новость</a>
    <h1>Список прошедших мероприятий</h1>
<?
	$eventsList = new EventsList;
	$template = $_SERVER['DOCUMENT_ROOT'] . '/admin/events/eventEntry.html';
	$eventsListWriter = new EventAdmListWriter;
	$eventsListWriter->setTemplate($template);
	$eventsList->write($eventsListWriter);
?>
  </div>
  <div class="tab-pane" id="announcement">
    <a href="/admin/announcement/" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Анонс</a>
    <h1>Список анонсов</h1>
<?
	$eventsList = new AnnounceList;
	$template = $_SERVER['DOCUMENT_ROOT'] . '/admin/announcement/announceEntry.html';
	$eventsListWriter = new AnnounceAdmListWriter;
	$eventsListWriter->setTemplate($template);
	$eventsList->write($eventsListWriter);
?>      
  </div>
</div>
