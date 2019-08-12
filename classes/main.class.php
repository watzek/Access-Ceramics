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
	private $NO_DB = false;

	public function __construct($style_choice = -1)
	{
		$ap = new ArgParser($_GET);
		$this->args = $ap->get_args();
		unset($ap);

		$this->db = new mysql($this->NO_DB);

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

	

	public function get_args()
	{
		return $this->args;
	}


	public function get_results()
	{
		if($this->args['state'] == 'main')
		{
			if ($this->NO_DB)
			{
				$this->results = [
					  'object' => [
							'src' =>'/img/acpics/Hirotake-Imanishi.shell.jpg',
							'ct' => 0
					]
					, 'glazing' => [
							'src' =>'/img/acpics/Hirotake-Imanishi.shell.jpg',
							'ct' => 0
					]
					, 'material' => [
							'src' =>'/img/acpics/Hirotake-Imanishi.shell.jpg',
							'ct' => 0
					]
					, 'technique' => [
							'src' =>'/img/acpics/Hirotake-Imanishi.shell.jpg',
							'ct' => 0
					]
					, 'temperature' => [
							'src' =>'/img/acpics/Hirotake-Imanishi.shell.jpg',
							'ct' => 0
					]
					, 'artists' => [
							'src' =>'/img/acpics/Hirotake-Imanishi.shell.jpg',
							'ct' => 0
					]
					, 'collection' => [
							'src' =>'/img/acpics/Hirotake-Imanishi.shell.jpg',
							'ct' => 0
					]

				];
			}
			else
				$this->results = $this->db->categories();
		}
		else if($this->args['state'] == 'category')
		{
			if ($this->NO_DB)
			{
				$this->results = [
					'count' => 30,
					'time' => 0,
					'res' => [
						 ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
					]
				];
			}
			else
				$this->results = $this->db->query_category($this->args);
		}
		else if($this->args)
		{
			if ($this->NO_DB)
			{
				$this->results = [
					'count' => 30,
					'time' => 0,
					'res' => [
						 ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
						, ['id'=>'0009','src'=>'/img/acpics/Hirotake-Imanishi.shell.jpg','title'=>'Fake Picture!']
					]
				];
			}
			else
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
