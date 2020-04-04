<?php
namespace Blog\config;
class Config{
	// Define settings
	protected $config=[
		'hosturl'=>'localhost:8000',
		'database'=>[
			'host'=>'localhost',
			'user'=>'anil',
			'password'=>'123456',
			'dbname'=>'usrt'
		]
	 ];
	 public function getconfig(){
	 	return $this->config;
	}
}
	
?>