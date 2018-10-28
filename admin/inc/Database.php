<?php
include '../config/config.php';

Class Database {
	private $host = 'localhost';
	private $user = 'root';
	private $pass = '4833';
	private $dbname = 'sumonwebbd';

	private $dbh;
	private $error;


	public function __construct() {
		$dsn     = 'mysql:host' . $this->host . ';dbname=' . $this->dbname;
		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE    => PDO::ERRMODE_EXCEPTION
		);

		try {
			$this->dbh = new PDO( $dsn, $this->user, $this->pass, $options );
			echo "Database connection successfull";
		} catch ( PDOException $e ) {
			$this->error = $e->getMessage();
			echo $this->error;
		}
	} // constructor ended

}
