<?
class DB
{
 	private $dsn = 'mysql:dbname=w1_vsport;host=localhost';
	private $dbuser = 'w1_vsport';
	private $dbpass = 'vsport';
    //private $dbuser = 'root';
    //private $dbpass = '';
	private $options = array(
		PDO::ATTR_PERSISTENT => false,
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
 
    protected static $instance;  // object instance
	protected static $dbh;
 
    private function __construct()
	{
		$this->dbh = new PDO($this->dsn, $this->dbuser, $this->dbpass, $this->options);
		$this->dbh->query("SET CHARACTER SET 'cp1251'");
	}
    private function __clone() { /* ... */ }
 
    public static function getInstance() {
		//if ( self::$instance !== null ) echo "DB-object already created";
		return (self::$instance === null) ? 
			   self::$instance = new self() :
			   self::$instance;		
    }
	
	public function &__get($field)
	{
		if ( $field === 'dbh' )
		{
			return $this->dbh;
		}
	}
}
?>