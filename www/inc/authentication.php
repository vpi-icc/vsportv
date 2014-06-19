<?
	function draw_auth_form()
	{
		?>
			<form id="auth_form" method="POST" class="form-inline" role="form">
				<div class="form-group">
					<label for="login"><span class="glyphicon glyphicon-user"></span></label>
					<input id="login" class="form-control" type="text" name="login" />
				</div>&nbsp;&nbsp;
				<div class="form-group">
					<label for="pass"><span class="glyphicon glyphicon-lock"></span></label>
					<input id="pass" class="form-control" type="password" name="pass" />
				</div>
			    <button type="submit" class="btn btn-default" value="go"><span class="glyphicon glyphicon-log-in"></span> Войти</button>
			</form>			
		<?	
	}	
	
	
	if ( !empty($_POST['login']) && !empty($_POST['pass']) )
	{
		if ( ($_POST['login'] == $login) && ($_POST['pass'] == $pass) )
		{
			$_SESSION['authenticated'] = true;
			// todo: log login entries to the database (datetime, ip)
			
			//echo '0'; // login successful
		}
		else
		{
			echo 'incorrect auth data';
			draw_auth_form();
		}
	}	
	
	
	
	// logout action handler
	if ( !empty($_GET['action']) && $_GET['action'] == 'logout' )
		$_SESSION['authenticated'] = false;
		
	// URL to current page without the 'action=logout' parameter
	$logout_href = str_replace(array('?action=logout', '&action=logout'), '', $_SERVER['REQUEST_URI']);
	if ( !empty($_SESSION['authenticated']) && $_SESSION['authenticated'] )
	{
		?>
			<a class="btn btn-default pull-right" href="<?=$logout_href?>?action=logout"><span class="glyphicon glyphicon-log-out"></span> Выйти</a>
		<?
	}
	else
	{
		echo 'not authenticated';
		echo date('H:i:s');
		draw_auth_form();	
		die();		
	}	
?>