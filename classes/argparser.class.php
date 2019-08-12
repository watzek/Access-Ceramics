<?php
require_once 'config.class.php';
class ArgParser
{
	private $args;
	function __construct($args)
	{
		$this->original = $args;
		$this->args = [
				'category' => isset($args['category']) ? $args['category'] : DEFAULT_CATEGORY,
		    'artist_fn' => isset($args['artist_fn']) ? $args['artist_fn'] : '',
		    'artist_ln' => isset($args['artist_ln']) ? $args['artist_ln'] : '',
		    'artist_id' => isset($args['artist_id']) ? $args['artist_id'] : '',
		    'glazing' => isset($args['glazing']) ? $args['glazing'] : '',
		    'material' => isset($args['material']) ? $args['material'] : '',
		    'object' => isset($args['object']) ? $args['object'] : '',
		    'technique' => isset($args['technique']) ? $args['technique'] : '',
		    'temperature' => isset($args['temperature']) ? $args['temperature'] : '',
		    'date_s'=>isset($args['date_s']) ? $args['date_s'] : '',
		    'date_e'=>isset($args['date_e']) ? $args['date_e'] : '',
		    'limit'=>(isset($args['limit']) and $args['limit'] < MAX_QUERY_LIM) ? $args['limit'] : DEFAULT_LIM,
		    'offset'=>isset($args['offset']) ? $args['offset'] : DEFAULT_OFFSET,
		    'orderby'=>isset($args['orderby']) ? $args['orderby'] : '',
		    'order'=>isset($args['order']) ? $args['order'] : DEFAULT_ORDER,
		    'view' => isset($args['view']) ? $args['view'] : DEFAULT_VIEW,
		    'elaborate' => isset($args['elaborate']) ? $args['elaborate'] : 0,
		    'id' => isset($args['id']) ? $args['id'] : '',
				'state' => isset($args['state']) ? $args['state'] : DEFAULT_STATE,
				'page' => isset($args['page']) ? $args['page'] : 0
  		];
  		/*foreach ($this->args as $key => $value) {;
			echo ($key .'=>'. $value);
			echo ("<br\>");
  		}*/
  		if(!in_array($this->args['category'],CATEGORY_NAMES))
  			$this->args['category']=DEFAULT_CATEGORY;
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
