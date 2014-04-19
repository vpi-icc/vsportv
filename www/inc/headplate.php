<?
function drawVectorMenu(array $sections)
{		
	$uri = explode('/', $_SERVER['REQUEST_URI']);
	$section = $uri[1];			
	foreach ( $sections as $item => $title )
	{
		if ( $item == $section )
		{
			$link = "<span>" . $title . "</span>";
		}
		else
		{
			if ( empty($item) )
				$link = '<a href="/">' . $title . '</a>';
			else
				$link = '<a href="/' . $item . '/">' . $title . '</a>';	
		}
		echo $link;
	}	    	
}
?>

<div id="header">
	<div id="boy">
		<img src="/_images/_layout/boy.png" width="478" height="301" alt="�������� � ���������� ������" />
	</div>
    <div id="rghtblock">
      <div id="search">
        <input type="text" name="request" value="�����" onclick="return false; window.location='/search/'"/>
      </div>
      <div id="advanced"> 
        <!--<li><a href="#">����� �������</a></li>--> 
        <a href="/">���������� ����������</a>
      </div>
    </div>
    <!-- <div class="frght"><img src="/_images/_layout/" alt=""></div>	--> 
	<div id="uppermenu">
    	<?
			$sections = array(
				"" => "�������",
				"events" => "��� �������",
				"gallery" => "����",
				"video" => "�����",
				"vseobutch" => "���������� �������"/*,	22.11.2013 ����������� �.�. ������ �� ��������			
				"links" => "�������� ������"*/);
				
			drawVectorMenu($sections);	    
		?>			    
    </div>
    <div id="plate">
	  <div id="plate2">
	    <div class="fleft"><a href="/"><img src="/_images/_layout/logo.gif" width="108" height="109" alt="������� �� ���������� �������� � ������" /></a></div>
	    <div id="title" class="fleft">
	      <div><strong>������� ��&nbsp;����������<br />�������� �&nbsp;������<br /></strong><span class="f10">������������� ���������� ������ &laquo;����� ��������&raquo; ������������� �������</span></div>
	      <div class="f14">	        
          <br />
	      ����������� �������������� ������</div>
	    </div>	    
	  </div>
	</div>
	<div id="lowermenu">
    <?
    	$sections = array(
				"about" => "� ��������",
				"infrastructure" => "���������� ��������������",
				//"volzhsky" => "�������� �����",
				"organizations" => "������������ �����������",
				//"info" => "����������� ��� ����", 22,11,2013 ����������� �.�. ������ �� �������� 
				"documents" => "���������");				
				
		drawVectorMenu($sections);
	?>    
    </div>
</div>