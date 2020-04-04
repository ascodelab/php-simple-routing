<?php
	
	namespace Blog;
	use Blog\config\Config;
	use Blog\PostModel;
	/**
	* @author:Sourabh
	* @Version:0.1
	* Wrapping up the core functionality
	*/
	class PostController
	{
		private $db=null;
		private $config=null;

		public function __construct()
		{
			$this->config=(new Config())->getconfig();
			$this->db=new PostModel($this->config['database']);
		}
		public function getall()
		{
			return $this->db->getAllPosts();
		}
		// creating new post
		public function create($request)
		{
			//create code
			return json_encode($request);
		}
		// update post
		public function update($request)
		{
			//update code
			return json_encode($request);
		}
		//delete  post
		public function delete($request)
		{
			//delete code
			return json_encode($request);
		}
	}
?>