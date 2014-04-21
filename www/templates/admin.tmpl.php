<? $part = basename(dirname($_SERVER['SCRIPT_NAME'])); 

 include $_SERVER['DOCUMENT_ROOT'] . "/inc/main_head.inc.php"; ?>
<? require $_SERVER['DOCUMENT_ROOT'] . "/inc/authentication.php"; ?>

<table width="100%" id="inner">
	<tr>
		<td style="width: 780px; vertical-align: top;">
    		<div id="main_blocks">
            	<?
                	$link = "";
					if ( $_SERVER['REQUEST_URI'] !== "/admin/" ) $link = '<a href="/admin/">&larr;&nbsp; </a>';
					echo $link;
				?>
    			<? include "content.php"; ?>
                <div style="height:30px;"></div>
            </div>
		</td>
		<td width="250" id="rightblock" style="padding-top: 70px;">        	
			<? include $_SERVER['DOCUMENT_ROOT'] . "/inc/main_right_block.inc.php" ?>
        </td>
	</tr>
</table>

<? include $_SERVER['DOCUMENT_ROOT'] .  "/inc/main_bot.inc.php" ?>