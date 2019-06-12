<?php
	
class Navbar
{
	static $templates = [
		'classic' => '../navbars/navbar.classic.php'
	];
	static $default = 'classic';
	
	public function __construct($type)
	{
		if(!$type or $type == '' or !isset(self::$templates[$type]))
			$this->template = self::$templates[$default];
		else
			$this->template = self::$templates[$type];
	}

	public function show()
	{
		readfile($this->template);
		unset($this->template);
	}

}

?>