<?php
require_once('config.class.php');
class ArgParser
{	
	private $args;
	function __construct($args)
	{
		$this->original = $args;
		$this->args = [
			'category' => (isset($args['c']) and in_array($args['c'],CATEGORY_NAMES)) ? $args['c'] : DEFAULT_CATEGORY,
		    'artist_fn' => isset($args['af']) ? $args['af'] : '',
		    'artist_ln' => isset($args['al']) ? $args['al'] : '',
		    'glazing' => isset($args['g']) ? $args['g'] : '',
		    'material' => isset($args['m']) ? $args['m'] : '',
		    'object' => isset($args['o']) ? $args['o'] : '',
		    'technique' => isset($args['t']) ? $args['t'] : '',
		    'temperature' => isset($args['tem']) ? $args['tem'] : '',
		    'date_s'=>isset($args['ds']) ? $args['ds'] : '',
		    'date_e'=>isset($args['de']) ? $args['de'] : '',
		    'limit'=>(isset($args['l']) and $args['l'] < MAX_QUERY_LIM) ? $args['l'] : DEFAULT_LIM,
		    'offset'=>isset($args['of']) ? $args['of'] : DEFAULT_OFFSET,
		    'orderby'=>isset($args['ob']) ? $args['ob'] : '',
		    'order'=>isset($args['or']) ? $args['or'] : DEFAULT_ORDER,
		    'view' => isset($args['v']) ? $args['v'] : DEFAULT_VIEW 
  		];
  		/*foreach ($this->args as $key => $value) {;
			echo ($key .'=>'. $value);
			echo ("<br\>");
  		}*/
	}
	public function get_args()
	{
		return $this->args;
	}

	public function put_args($args)
	{
		
	}
}


?>