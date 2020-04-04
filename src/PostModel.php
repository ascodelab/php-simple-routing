<?php
	namespace Blog;
	/**
	* @author:Sourabh
	* @Version:0.1
	* Wrapping up the core functionality
	*/
	class PostModel
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
		public function getAllPosts(){
			$connobj=$this->conn;
			$smt=$connobj->prepare("select * from collection");
			$smt->execute();
			return json_encode($smt->fetchAll(\PDO::FETCH_ASSOC));
		}
	}
?>