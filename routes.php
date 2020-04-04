<?php
	use Blog\PostController;
	$blog = new PostController();
	//putting router to work
	switch ($request) {
		case "/get":
			echo $blog->getall();
			break;
		case "/create":
			echo $blog->create($_POST);
			break;
		case "/update":
			parse_str(file_get_contents("php://input"),$vars);
			echo $blog->update($vars);
			break;
		case "/delete":
			parse_str(file_get_contents("php://input"),$vars);
			echo $blog->delete($vars);
			break;
		default:
			echo $blog->getall();
	}	
?>