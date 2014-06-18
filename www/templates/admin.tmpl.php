<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <? include $_SERVER['DOCUMENT_ROOT'] . "/templates/blocks/head_admin.php" ?>
</head>
<!-- Header area -->
<body style="background-image:none;">
<style>
h1 {
	font-size:32px;
	padding:10px;
}
</style>
<table align="center" cellpadding="0" cellspacing="0" border="0" id="maintable">
<? include $_SERVER['DOCUMENT_ROOT'] . "/templates/blocks/header.php" ?>
<tr>
<td colspan="3"><table class="content" border="0">
<tr>
    <td style="vertical-align: top">
    	<h2><?=$title;?></h2>
        <? require $_SERVER['DOCUMENT_ROOT'] . "/inc/authentication.php"; ?>
        <?
                	$link = "";
					if ( $_SERVER['REQUEST_URI'] !== "/admin/" ) $link = '<a href="/admin/" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span></a>';
					echo $link;
		?>
        <? include $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'] . $content ?>
    </td>
</tr>
</table></td>
</tr>
</table>
</body>
</html>