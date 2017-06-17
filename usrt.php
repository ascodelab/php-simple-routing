<?php
	use Usrt\USRTGenerator;
	$usrt = new USRTGenerator();
	//Checking the request types
	if(!empty($_GET['get'])){
		echo $usrt->getall();
		return;
	}
	if(!empty($_GET['visit'])){
		$r=json_decode($usrt->realurl($_GET['visit']),true);
		header('Location:'.$r['longurl']);
	}
	if(!empty($_POST)){
		$params=[
			'longurl'=>$_POST['longurl'],
			'title'=>"NA"
		];
		echo($usrt->shrinkurl($params));
		return;
	}
	
	//Loading views
	require_once("public/views/index.php");
?>