<? /*
<br /><br /><br />
<h4 class="grey">��������� �����������</h4>
<p><strong>26&nbsp;�������</strong> �&nbsp;������ �������������� ��� ���������� ���������� �&nbsp;������������������ ����� ������������ �������&nbsp;&#8470;&nbsp;2 (��.&nbsp;�������������,&nbsp;20) ��������� <strong><a href="/gallery/gymnasts/">����������� ������������</a></strong> ������������� �����. ������ �������&nbsp;&mdash; �&nbsp;10:00.</p>
<br />
*/ ?>

<br /><br />

<div>
  <object id="Flash" width="285px">
    <param name="movie" value="/_swf/vseros_fsk_230x100.swf">
    <param name="quality" value="high">
  <param name="wmode" value="transparent" />
  </object>
</div>
<br />
<? /*<h1 class="blueheader f16">������������ ��������</h1>
<div id="gray_block">	
	<div class="fleft" style="margin: 0 15px 0 0;"> <img src="/_images/kohanovsky.jpg" alt="������ ���������� �����������" /></div>
	<h1>������ ���������� �����������<br /><span class="f10">������������ ��������</span></h1><br /><br /><br />    
	<p class="f16">������� �������!</p>
	<p>��&nbsp;��� ������� �������� �������� ����� ��&nbsp;����� ���������� ������� ��� ������. ���� ������&nbsp;&mdash; ������ ������� ��� ����� ���� �&nbsp;�������� ���������������� ��������� �����������.</p>
	<p><a href="/intro/">������ ���������</a>...</p>
</div> */ ?>

<? /*
<div style="height:25px"></div>
<h1 class="redheader"><span class="f16" style="color: #fff">�����������!</span></h1>
<div id="gray_block" class="cntr">
	<img src="/_images/romanenko.jpg" alt="������� ���������� ���������" style="margin: 0 auto;" />
    <h1>������� ���������� ���������<br /><span class="grey f10">���������� ������� ��������� �� ����� �������� � ����������� ������� � ������� ��������� <nobr>�� 75-�� �����������</nobr></span></h1>
<ul id="ulpointer">

</ul>
*/ ?>
<br />
<br />
<h1>���������� ������</h1>
<br />
<?					
	$eventFavouritesListWriter = new EventFavouritesListWriter;
	$template = $_SERVER['DOCUMENT_ROOT'] . '/eventFavouritesEntry.html';
	$eventFavouritesListWriter->setTemplate($template);	
	$eventsList = new EventsList;
	$eventsList->write($eventFavouritesListWriter);							
?>

</div>

<div style="height:20px;"></div>
<div style="height:20px;"></div>

<table class="vtop">
	<col width="50" />
    <tr>
        <td colspan="2" class="orange f20"><strong>������� ��������� ������</strong><br /><br /></td>
    </tr>

	<tr>
        <td><img class="photo" src="/_images/kondrashov.jpg" alt="�������� ���������" /></td>
        <td><h1 class="top">�������� ���������<br /><span class="grey f12">������ ������ �������������� ������ �� �����. ������ ����� ���� � ������</span></h1></td>
    </tr>
    <tr>
        <td><img class="photo" src="/_images/timoshkin.jpg" alt="������� ��������" /></td>
        <td><h1>������� ��������<br /><span class="grey f12">������ ������ �������������� ������ �� �����. ������ ����������� � ������ ���� � ������. ������� ������</span></h1></td>
    </tr>
    <tr>
        <td><img class="photo" src="/_images/zhabko.jpg" alt="����� �����" /></td>
        <td><h1>����� �����<br /><span class="grey f12">������ ������ �������������� ������ �� ��������. 4-� ������� ��������� ������. ��������� ���� ����� ���������</span></h1></td>
    </tr>
</table>