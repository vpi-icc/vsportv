<h1>����� ��������</h1>

<?
	if ( !empty($_GET['id']) )
	{
		$eventId = $_GET['id'];
		$eventsList = new EventsList;
		$eventInfoWriter = new EventInfoWriter;
		$template = $_SERVER['DOCUMENT_ROOT'] . '/events/eventInfo.html';
		$eventInfoWriter->setTemplate($template);
		$eventInfoWriter->setEventId($eventId);
		$eventsList->write($eventInfoWriter);
	}
	else
	{
		Object::showError('����������� ��&nbsp;�������');	
	}
	
?>


<h1>�������� ���������</h1>

<!-- VK Widget -->
<div id="vk_groups" style="margin: 15px auto;"></div>
<script type="text/javascript">
VK.Widgets.Group("vk_groups", {mode: 0, width: "300", height: "350"}, 26001058);
</script>

<div id="vk_poll" style="margin: 15px auto;"></div>

<script type="text/javascript">
	VK.Widgets.Poll('vk_poll', {width: '280', pageUrl: 'http://kdm.org.ru'}, '3718809_9a6bd30364d9e88bc3');
</script>

<? /*
<h1>�������</h1>

<table class="placeholder linklist" width="325">
	<col width="100" />
	<tr>
		<td><a href="#"><img src="/_images/events/evt2_75.jpg" alt="evt2_big" title="evt2_big" class="photo noborder" /></a></td>
		<td><a href="#">��� &laquo;��������&raquo;</a></td>
	</tr>	
	<tr>
		<td><a href="#"><img src="/_images/events/evt3_75.jpg" alt="evt2_big" title="evt2_big" class="photo noborder" /></a></td>
		<td><a href="#">������ &laquo;������&raquo;</a></td>
	</tr>	
</table>

<h1>������� �����������</h1>

<table class="placeholder linklist" width="325">
	<col width="100" />
	<tr>
		<td><a href="#"><img src="/_images/events/evt2_75.jpg" alt="evt2_big" title="evt2_big" class="photo" /></a></td>
		<td><a href="#">����� ��������� �������� ���������!</a></td>
	</tr>	
	<tr>
		<td><a href="#"><img src="/_images/events/evt3_75.jpg" alt="evt2_big" title="evt2_big" class="photo" /></a></td>
		<td><a href="#">��������� ������!</a></td>
	</tr>	
</table>
*/ ?>