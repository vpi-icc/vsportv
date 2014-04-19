<?
	if (!function_exists('http_response_code')) // For 4.3.0 <= PHP <= 5.4.0
	{
		function http_response_code($newcode = NULL)
		{
			static $code = 200;
			if( $newcode !== NULL )
			{
				header('X-PHP-Response-Code: ' . $newcode, true, $newcode);
				if ( !headers_sent() )
					$code = $newcode;
			}       
			return $code;
		}
	}
?>
<?
	$sections = array("ib_meanwhile", "ib_calendar", "ib_mass_media", "ib_photo", "ib_video");
	
	if ( empty($_POST['section']) || !in_array($_POST['section'], $sections) )
	{
		http_response_code("404");
		return;
	}
		
	$section = $_POST['section'];
	include $_SERVER['DOCUMENT_ROOT'] . "/" . $section . ".inc.php";
?>