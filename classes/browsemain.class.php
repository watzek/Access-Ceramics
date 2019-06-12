<?php  

require 'templates.class.php';
require 'mysql.class.php';


class Main
{
	private $template;
	private $db;
	private $args;

	public function __construct($args)
	{
		//if no view is set, default template is returned
		$this->args = $args;
		$this->template = new Templates($args['view']);
		
		$this->db = new mysql(); 
	}

	public function show()
	{
		$this->template->getHTML();
		unset($this->template);
	}

	public function query_db()
	{
		$this->db->do_query($this->args);
	}
}
?>