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
		<img src="/_images/_layout/boy.png" width="478" height="301" alt="Запишись в спортивную секцию" />
	</div>
    <div id="rghtblock">
      <div id="search">
        <input type="text" name="request" value="Поиск" onclick="return false; window.location='/search/'"/>
      </div>
      <div id="advanced"> 
        <!--<li><a href="#">Карта портала</a></li>--> 
        <a href="/">Контактная информация</a>
      </div>
    </div>
    <!-- <div class="frght"><img src="/_images/_layout/" alt=""></div>	--> 
	<div id="uppermenu">
    	<?
			$sections = array(
				"" => "Главное",
				"events" => "Все новости",
				"gallery" => "Фото",
				"video" => "Видео",
				"vseobutch" => "Спортивный всеобуч"/*,	22.11.2013 закомментил т.к. раздел не наполнен			
				"links" => "Полезные ссылки"*/);
				
			drawVectorMenu($sections);	    
		?>			    
    </div>
    <div id="plate">
	  <div id="plate2">
	    <div class="fleft"><a href="/"><img src="/_images/_layout/logo.gif" width="108" height="109" alt="Комитет по физической культуре и спорту" /></a></div>
	    <div id="title" class="fleft">
	      <div><strong>Комитет по&nbsp;физической<br />культуре и&nbsp;спорту<br /></strong><span class="f10">Администрации городского округа &laquo;Город Волжский&raquo; Волгоградской области</span></div>
	      <div class="f14">	        
          <br />
	      Официальный информационный портал</div>
	    </div>	    
	  </div>
	</div>
	<div id="lowermenu">
    <?
    	$sections = array(
				"about" => "О комитете",
				"infrastructure" => "Спортивная инфраструктура",
				//"volzhsky" => "Волжский спорт",
				"organizations" => "Общественные организации",
				//"info" => "Физкультура для всех", 22,11,2013 закомментил т.к. раздел не наполнен 
				"documents" => "Документы");				
				
		drawVectorMenu($sections);
	?>    
    </div>
</div>