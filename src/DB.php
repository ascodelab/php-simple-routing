<?php
	namespace Usrt;
	/**
	* @author:Anil Sharma
	* @Version:0.1
	* Wrapping up the core functionality
	*/
	class DB
	{
		private $conn=null;
		private $host=null;
		private $user=null;
		private $password=null;
		private $dbname=null;

		public function __construct($param){
			$this->host=$param['host'];
			$this->user=$param['user'];
			$this->password=$param['password'];
			$this->dbname=$param['dbname'];
			try {
			    $this->conn = new \PDO('mysql:host='.$this->host.';dbname='.$this->dbname,$this->user,$this->password);
			    return $this->conn;
			}catch (PDOException $e){
			    print "Error!: " . $e->getMessage() . "<br/>";
			    die();
			}
		}
		// Inserting data into database
		public function insert($param){
			$longurl=htmlentities($param['longurl']);
			$title=htmlentities($param['title']);
			$shorturl=null;
			//Save title as url if title is empty
			if(empty($title)) $title=$longurl;
			$shorturl=null;
			// Get instance of connection string
			$connobj=$this->conn;
			$smt=$connobj->prepare("INSERT INTO collection(longurl,title)VALUES(?,?)");
			$smt->execute(array($longurl,$title));
			if (!$smt) {
			    echo "\nPDO::errorInfo():\n";
			    print_r($dbh->errorInfo());
			    die();
			}
			return $this->createShortLink($connobj->lastInsertId()); 
		}
		// Geting all results
		public function getAllCreatedLinks(){
			$connobj=$this->conn;
			$smt=$connobj->prepare("select * from collection");
			$smt->execute();
			return json_encode($smt->fetchAll(\PDO::FETCH_ASSOC));
		}
		// getiing actual link and increasing clicked
		public function view($id){

			$usrtid = new ShortId();
			$sid=$usrtid->decode($id,6);
			// Updating results
			$connobj=$this->conn;
			$smt=$connobj->prepare("UPDATE collection SET clicked=clicked + 1 where id='{$sid}'");
			$smt->execute();
			//Now returning the result
			$get=$connobj->prepare("SELECT * from collection WHERE shorturl='{$id}'");
			$get->execute();

			return json_encode($get->fetch(\PDO::FETCH_ASSOC));
			
		}
		//Creating short link
		private function createShortLink($id){

			$usrtid = new ShortId();
			$sid=$usrtid->encode($id,6);
			// Updating results
			$connobj=$this->conn;
			$smt=$connobj->prepare("UPDATE collection SET shorturl='{$sid}' where id='{$id}'");
			$smt->execute();
			//Now returning the result
			$get=$connobj->prepare("SELECT * from collection WHERE id='{$id}'");
			$get->execute();

			return json_encode($get->fetch(\PDO::FETCH_ASSOC));

		}
	}
?>