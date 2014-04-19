<?
	$eventSwitcherWriter = new EventSwitcherWriter;
	$template = $_SERVER['DOCUMENT_ROOT'] . '/eventMainHot.html';
	$eventSwitcherWriter->setTemplate($template);	
	$eventsList = new EventsList;
	$eventsList->write($eventSwitcherWriter);
?>

<? include $_SERVER['DOCUMENT_ROOT'] . "/inc/main_professional_sport.inc.php" ?>
<br />
<br />
<?					
	$eventMainListWriter = new EventMainListWriter;
	$template = $_SERVER['DOCUMENT_ROOT'] . '/eventEntryMain.html';
	$eventMainListWriter->setTemplate($template);	
	$eventsList = new EventsList;
	$eventsList->write($eventMainListWriter);							
?>
<p class="left" style="margin-left: 570px; font-size: 14pt;"><a href="/events/">Все новости</a></p>					
<br />
<br />
<? include $_SERVER['DOCUMENT_ROOT'] . "/inc/main_infoblock.inc.php" ?>
<!-- <div style="height:30px;"></div> -->
<? include $_SERVER['DOCUMENT_ROOT'] . "/inc/main_amateur_sport.inc.php" ?>
<div style="height:30px;"></div>
<? include $_SERVER['DOCUMENT_ROOT'] . "/inc/main_photogallery.inc.php" ?>

<?
