<?

	// global variables
	$login = 'kfkis';
	$pass = ',jujhjlbWf';
	$upload_max_filesize = rtrim( ini_get('upload_max_filesize'), 'KMG' );
	
	// global constants
	define('CRLF', "\n");
	define('TAB', "\t");
	
	// global functions

	function __autoload($class_name)
	{
		$lookupPaths = array('/', '/actions/', '/events/', '/forms/', '/adz/');
		foreach ( $lookupPaths as $subpath )
		{
			$classFileName = $_SERVER['DOCUMENT_ROOT'] . '/app' . $subpath . $class_name . '.php';
			if ( file_exists($classFileName) )
			{
				require_once $classFileName;
				return;
			}
		}
	}
	
	function default_exception_handler($e)
	{
		echo '<div class="error">' . $e->getMessage() . '</div>';	
	}
	
	function ajax_exception_handler($e)
	{
		echo 'error: ' . $e->getMessage();
	}

	error_reporting(E_ALL);
	set_exception_handler('default_exception_handler');
	
	
	
	require_once 'app/interfaces.php';
	

?>