<?php  

require 'templates.class.php';
require 'mysql.class.php';


class Main
{
	private $template;
	private $db;
	private $args;
	private $result;

	public function __construct($args)
	{
		//if no view is set, default template is returned
		$this->args = $args;
		$this->template = new Templates($args['view']);
		
		if(isset($args['q']))
		{
			$this->db = new mysql();
			$this->result = $this->db->query_db($this->args['q']);
		}
	}

	public function show()
	{
		$this->template->getHTML();
		unset($this->template);
	}
}
?>