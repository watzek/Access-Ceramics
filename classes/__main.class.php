<?php  

require 'templates.class.php';
require 'mysql.class.php';


class main
{
	private $body;
	private $db;

	public function __construct($args)
	{
		//get body body
		if(isset($_GET['view'])) $this->body = Templates::getTemplate($_GET['view']);
		else $this->body = Templates::getTemplate(''); //if no view is set, pass empty string for default template


		$this->db = new mysql(); 
	}

	public function printTemplate()
	{
		echo $this->body;
	}
}
?>