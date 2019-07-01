<?php  
require('argparser.class.php');
require 'templates.class.php';
require 'mysql.class.php';
require_once('config.class.php');


class Main
{
	private $template;
	private $db;
	private $args;
	private $result = false;

	public function __construct()
	{
		$ap = new ArgParser($_GET);
		$this->args = $ap->get_args();
		unset($ap);
		//$this->template = new Templates($args['view']);
		$this->db = new mysql();
	}

	public function show()
	{
		$this->template->getHTML();
		unset($this->template);
	}


	public function get_args()
	{
		return $this->args;
	}


	public function get_results()
	{
		if(!$this->args)
		{
			$this->results = $this->db->categories();
		}
		else if($this->args['category'])
		{
			$this->results = $this->db->query_category($this->args);
		}
		else
		{
			$this->results = $this->db->do_custom_query($this->args);
		}
		return $this->results;
	}
}
?>