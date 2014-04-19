<? 	
	error_reporting(E_ALL);
	ini_set("display_errors", "On");	
?>
<? session_start(); ?>
<? require_once $_SERVER['DOCUMENT_ROOT'] . '/req/core.php'; ?>
<? require $_SERVER['DOCUMENT_ROOT'] . "/req/video.req.php"; ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Комитет по физической кульутре и спорту Администрации городского округа &laquo;Город Волжский&raquo; Волгоградской области</title>
<meta http-equiv="Content-Language" content="ru">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta name="robots" content="index,follow">
<meta name="keywords" content="Комитет, спорткомитет, физическая культура, спорт, Волжский, Волгоградской, области, стадионы, кружки, клубы, здоровье">
<meta name="description" content="Комитет по физической кульутре и спорту Администрации городского округа «Город Волжский» Волгоградской области">
<meta name='yandex-verification' content='6d8938a2d275a9e6' />
<link href="/_css/styles.css" rel="stylesheet" />
<!--[if IE 6]>
<LINK href="/_css/styles_ie6.css" rel="stylesheet" />
<![endif]-->

<!-- <script type="text/javascript" src="/_js/menu.js"></script> -->
<script src="/_js/jquery-1.10.2.min.js"></script>
<script src="/_js/lightbox-2.6.min.js"></script>
<!-- <script type="text/javascript" src="/_js/jquery-1.7.2.min.js"></script> -->
<script type="text/javascript" src="/_js/mainhot.js"></script>
<script type="text/javascript" src="/_js/vsportv.js"></script>
<script type="text/javascript" src="/_js/jwplayer/jwplayer.js"></script>

<!-- Header area -->
<? /* if IE6 */
if ( stripos($_SERVER['HTTP_USER_AGENT'], "MSIE 6.0") !== FALSE ) :
	include $_SERVER['DOCUMENT_ROOT'] . "/inc/headplate_ie6.php";
else :
	include $_SERVER['DOCUMENT_ROOT'] . "/inc/headplate.php";
endif
?>

<div style="height:30px;"></div>

<!-- Content area -->
<? /*
	$path = explode("/", $_SERVER['REQUEST_URI']);
	$currentSection = $path[1];	
	$sections = array("" => "Новости", "gallery" => "Фото" , "video" => "Видео" );
	foreach ( $sections as $s => $title )
	{		
		if ( $currentSection !== $s ) $links[] = '<h3><a href="/' . $s . '">' . $title . '</a></h3>';
		else if ( !empty($path[2]) ) $links[] = '<h3 class="selected"><a href="/' . $s . '">' . $title . '</a></h3>';
		else $links[] = '<h3 class="selected">' . $title . '</h3>';
	}
	$links = implode(' ', $links);
*/ ?>
<table width="100%" border="1">
  <tr> 
    <!--
	<td width="220">
    	<div id="blueheader_block" >Структура портала</div>
		<div id="gray_block">
		<ul id="ulpointer">
			<? //include "../inc/menu.php"; ?>
		</ul>
		</div>
	</td>
    -->
    <td valign="top" style="padding-left:0px" id="menu">
    	<? /* =$links */ ?>
    </td>
  </tr> 
  
</table>
