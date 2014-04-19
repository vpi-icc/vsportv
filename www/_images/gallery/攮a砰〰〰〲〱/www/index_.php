<? 
	// if ( $_SERVER['REMOTE_ADDR'] != "31.128.159.67") die("В разработке");
	error_reporting(-1);
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	//if (!ini_set('open_basedir', ini_get('open_basedir') . ';c:/www/vhosts/vsport.pnhost.ru/inc;c:/www/vhosts/vsport.pnhost.ru/req')) die('failed to set ini');
?>
<?
	$part = "root";
	include $_SERVER['DOCUMENT_ROOT'] . "/inc/main_head.inc.php";	
	
	//phpinfo();
?>

<div style="height:25px"></div>
<table width="100%" style="border-collapse: collapse;">
    <td style="width: 780px"><div id="main_blocks">
		<? include "content.php"; ?>        
      </div></td>
    <td width="250" id="rightblock"><? include $_SERVER['DOCUMENT_ROOT'] . "/inc/main_right_block.inc.php" ?>
      <br />
      <br />
      <br /></td>
  </tr>
</table>
<? include $_SERVER['DOCUMENT_ROOT'] . "/inc/main_bot.inc.php" ?>
