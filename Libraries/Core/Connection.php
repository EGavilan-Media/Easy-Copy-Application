<?php
class Connection{
	private $connect;

	public function __construct(){
		$connectionString = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
		try{
			$this->connect = new PDO($connectionString, DB_USER, DB_PASSWORD);
			$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		    //echo "Connection has been established successfully!";
		}catch(PDOException $e){
			$this->connect = 'Error de conexión';
			echo "ERROR: " . $e->getMessage();
		}
	}

	public function connect(){
		return $this->connect;
	}
}

?>