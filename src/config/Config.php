<?php
namespace Usrt\config;
class Config{
	// Define settings
	protected $config=[
		'hosturl'=>'localhost/usrt',
		'database'=>[
			'host'=>'localhost',
			'user'=>'root',
			'password'=>'password',
			'dbname'=>'usrt'
		]
	 ];
	 public function getconfig(){
	 	return $this->config;
	}
}
	
?>