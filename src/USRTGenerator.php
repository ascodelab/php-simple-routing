<?php
	
	namespace Usrt;
	use Usrt\config\Config;
	use Usrt\DB;
	use Usrt\ShortId;
	/**
	* @author:Anil Sharma
	* @Version:0.1
	* Wrapping up the core functionality
	*/
	class USRTGenerator
	{
		private $db=null;
		private $config=null;

		public function __construct()
		{
			$this->config=(new Config())->getconfig();
			$this->db=new DB($this->config['database']);
		}
		public function getall()
		{
			return $this->db->getAllCreatedLinks();
		}
		public function shrinkurl($param)
		{
			return $this->db->insert($param);
		}
		public function realurl($param)
		{
			return $this->db->view($param);
		}
	}
?>