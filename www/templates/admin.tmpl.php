<!DOCTYPE html>
<html>
<head>
    <? include $_SERVER['DOCUMENT_ROOT'] . "/templates/blocks/head_admin.php" ?>
</head>
<!-- Header area -->
<body style="background-image:none;">
<div class="container">

<? include $_SERVER['DOCUMENT_ROOT'] . "/templates/blocks/header_admin.php" ?>
<div class="row">
    <div class="container">
    <div class="col-xs-10 col-xs-offset-1">

        <? require $_SERVER['DOCUMENT_ROOT'] . "/inc/authentication.php"; ?>
        <?
                	$link = "";
					if ( $_SERVER['REQUEST_URI'] !== "/admin/" ) $link = '<a href="/admin/" class="btn btn-default"><span class="glyphicon glyphicon-arrow-left"></span></a>';
					echo $link;
		?>
        <? 
			$request = explode("?", $_SERVER['REQUEST_URI']);
			include $_SERVER['DOCUMENT_ROOT'] . $request[0] . $content ?>
   </div>
   </div>
  </div>
</div>
</body>
</html>