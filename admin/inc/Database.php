<?php
// include '../config/config.php';

Class Database {
	private $host = 'localhost';
	private $user = 'root';
	private $pass = '4833';
	private $dbname = 'sumonwebbd';

	public $dbh;
	public $error;


	public function __construct() {
		$dsn     = 'mysql:host='.$this->host.';dbname='.$this->dbname;
		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
		);

		try {
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
			
		} catch ( PDOException $e ) {
			$this->error = $e->getMessage();
			echo $this->error;
		}
	} // constructor ended

}

