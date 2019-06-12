<?php

final class Templates{
	static $templates = array(
		'home' => '..\\templates\\home.php',
		'pane' => '..\\templates\\viewpane.php',
		'grid' => '..\\templates\\gridview.php',
		'list' => '..\\templates\\listview.php',
		'search' => '..\\templates\\search.php'
	);
	static $default = 'home';

	public function __construct($template_type)
	{
		echo ($template_type);
		if (!isset($template_type) or $template_type == '' or !isset(self::$templates[$template_type]))
		{
			$template_type = self::$default;
		}
		$this->filename = Templates::$templates[$template_type];
	}
	public function getHTML()
	{	
		readfile($this->filename);	
	}
}

  ?>