<? /*
<div id="infoblock">
	<div id="ib_menu">
    	<div>
    		<a name="ib_meanwhile" class="active" href="#">Между тем&nbsp;&darr;</a>
			<a href="#" name="ib_calendar">Календарь</a>
    		<a name="ib_mass_media" href="#">СМИ о&nbsp;нас</a>
    		<a name="ib_photo" href="#">Фото</a>
    		<a name="ib_video" href="#">Видео</a>
    	</div>
    </div>
    <div id="ib_content">
    	<? include $_SERVER['DOCUMENT_ROOT'] . "/ib_meanwhile.inc.php"; ?>   	
    </div>
</div>


<script type="text/javascript">
	$("#ib_menu a").click( function() {
			var node = $(this);			
			$('#ib_content').load(
				'/main_infoblock_content_handler.php',
				{ 'section': $(this).attr('name') },
				function(responseText, textStatus, XMLHttpRequest) {
					if ( responseText.length !== 0 )
					{
						$("#ib_menu a.active").removeClass("active");
						node.addClass("active");
					}
				}
			);
			return false;
		}
	);
</script>
*/ ?>