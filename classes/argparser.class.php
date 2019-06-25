<?php

class ArgParser
{	
	private $args;
	function __construct($args)
	{
		$this->args = [
			'q' => isset($args['q']) ? $args['q'] : '',
		    'artist_fn' => isset($args['af']) ? $args['af'] : '',
		    'artist_ln' => isset($args['al']) ? $args['al'] : '',
		    'glazing' => isset($args['g']) ? $args['g'] : '',
		    'material' => isset($args['m']) ? $args['m'] : '',
		    'object' => isset($args['o']) ? $args['o'] : '',
		    'technique' => isset($args['t']) ? $args['t'] : '',
		    'temperature' => isset($args['tem']) ? $args['tem'] : '',
		    'view' => isset($args['v']) ? $args['v'] : '',  
		    'date_s'=>isset($args['ds']) ? $args['ds'] : '',
		    'date_e'=>isset($args['de']) ? $args['de'] : '',
		    'limit'=>isset($args['l']) ? $args['l'] : '',
		    'offset'=>isset($args['of']) ? $args['of'] : '',
		    'orderby'=>isset($args['ob']) ? $args['ob'] : '',
		    'order'=>isset($args['or']) ? $args['or'] : ''
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
}


?>