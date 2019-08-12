<?php

class Snippits
{
	static $templates = [
		'classic-navbar' => 'extras/navbar.classic.html',
		'header-search' => 'extras/search-header.html',
		'info-about' => 'info/about_the_project.html',
		'info-contribute' => 'info/contribute.html',
		'info-faq' => 'info/faq.html',
		'info-help' => 'info/help.html',
		'info-resources' => 'info/resources.html',
		'404' => 'extras/404.html'
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
