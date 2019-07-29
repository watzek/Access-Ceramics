<?php
require_once 'argparser.class.php';
require_once 'templates.class.php';
require_once 'mysql.class.php';
require_once 'config.class.php';


class Main
{
	private $template;
	private $db;
	private $args;
	private $result = false;
	public $style_pack = [];

	public function __construct($style_choice = -1)
	{
		$ap = new ArgParser($_GET);
		$this->args = $ap->get_args();
		unset($ap);
		//$this->template = new Templates($args['view']);
		$this->db = new mysql();

		if ($style_choice > -1)
		{
			$this->style_pack = ($style_choice < count(STYLE_PACKS)) ? STYLE_PACKS[$style_choice]:[];

			if (isset($this->style_pack[$this->args['view']]))
				$active_key = $this->args['view'];
			else
				$active_key = $this->style_pack['default'];
			unset($this->style_pack['default']);

			$this->style_pack['active'] = $active_key;
			$this->active_style = $this->style_pack[$active_key];
		}
	}



	// public function show()
	// {
	// 	$this->template->getHTML();
	// 	unset($this->template);
	// }

	public function get_args()
	{
		return $this->args;
	}


	public function get_results()
	{
		if($this->args['state'] == 'main')
		{
			$this->results = $this->db->categories();
		}
		else if($this->args['state'] == 'category')
		{
			$this->results = $this->db->query_category($this->args);
		}
		else if($this->args)
		{
			$this->results = $this->db->do_custom_query($this->args);
		}
		return $this->results;
	}

	public function artist_info()
	{
		return $this->db->artist_information($this->args);
	}
}
?>
