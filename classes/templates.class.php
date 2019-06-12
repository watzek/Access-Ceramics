<?php

final class Templates{
	static $templates = array(
		'home' => '.\\templates\\home.php',
		'pane' => '.\\templates\\viewpane.php',
		'grid' => '.\\templates\\gridview.php',
		'list' => '.\\templates\\listview.php',
		'search' => '.\\templates\\search.php'
	);
	static $default = 'home';

	public static function getTemplate($template_type)
	{
		if ($template_type == '' or !isset(self::$templates[$template_type]))
		{
			$template_type = self::$default;
		}
		return readfile(self::$templates[$template_type]);
	}
}

  ?>