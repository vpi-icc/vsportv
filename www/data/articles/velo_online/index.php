<? 
	session_start();
	$part = 'reg_bachelor';
	$req_path=$_SERVER['DOCUMENT_ROOT'];
	$pos=strripos($req_path,'/');
	$req_path=substr($req_path,0,$pos).'/req/init_volpi.req';
	require_once($req_path); 
	$vars=new class_vars;
	$mysql = new class_mysql;

	include ($vars->path_inc.'/inner.inc.php');
	
?>
