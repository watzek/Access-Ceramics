<?php  

require 'templates.class.php';
require 'mysql.class.php';


class Main
{
	private $template;
	private $db;
	private $args;
	private $result = false;

	public function __construct($args=NULL)
	{
		$this->args = $args;
		//$this->template = new Templates($args['view']);
		$this->db = new mysql();
	}

	public function show()
	{
		$this->template->getHTML();
		unset($this->template);
	}

	public function get_results()
	{
		if(!$args)
		{
			$this->result = $this->db->categories();
		}
		else if($args['category'])
		{
			$this->results = $this->db->query_category($this->args['category'],$this->args['offset'], $this->args['limit']);
		}
		else
		{
			$this->results = $this->db->do_custom_query($this->args);
		}
		return $this->result;
	}
}
?>