<?
	function draw_auth_form()
	{
		?>
			<form id="auth_form" method="POST" class="frght">
				<table>
					<tr>
						<th>логин</td>
						<th>пароль</td>
						<td></td>
					</tr>
					<tr>
						<td><input id="login" type="text" name="login" /></td>
						<td><input id="pass" type="password" name="pass" /></td>
						<td><input type="submit" value="go" /></td>
					</tr>
				</table>				
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
			<div>				
				<p class="f10"><a class="grey" href="<?=$logout_href?>?action=logout">сложить полномочия</a></p>
			</div>
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