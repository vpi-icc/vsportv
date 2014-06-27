<? session_start() ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <? include "blocks/head.php" ?>
</head>
<!-- Header area -->
<body>
<table align="center" cellpadding="0" cellspacing="0" border="0" id="maintable">
<? include "blocks/header.php" ?>
<tr>
<td colspan="2"><table class="content" border="0">
<tr>
    <td style="vertical-align: top">
    	<h2><?=$title;?></h2>
        <? include $_SERVER['DOCUMENT_ROOT'] . '/' . $content ?>
    </td>
    <td rowspan="2" class="inner_right">
        <? include "blocks/rightblock.php" ?>
    </td>
</tr>
</table></td>
</tr>
<tr>
    <td colspan="2">
        <? include "blocks/sitemap.php" ?>
        <? include "blocks/footer.php" ?>
        </td>
</tr>
</table>
</body>
</html>
