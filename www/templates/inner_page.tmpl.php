<? $part = basename(dirname($_SERVER['SCRIPT_NAME']));
   include $_SERVER['DOCUMENT_ROOT'] . "/inc/main_head.inc.php"; ?>

<table width="100%" id="inner">
	<tr>
		<td style="width: 780px; vertical-align: top;">
    		<div id="main_blocks">            	
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