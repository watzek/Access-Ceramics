<?php
require 'sql_credentials.class.php';
require 'sql_queries.class.php';

class mysql
{
	static $arg_associations =
	[
		'artists'=> 'id',
		'glazings'=> 'g',
		'materials'=> 'm',
		'objects'=> 'o',
		'techniques'=> 't',
		'temperatures'=> 'tem',
		'institutions' => 'in'
	];

	public function __construct($NO_DB = false)
	{
		if ($NO_DB) return;
		$server = Credentials::SERVER; //correct syntax?
		$dbname = Credentials::DBNAME;
		$user = Credentials::USER;
		$password = Credentials::PASSWORD;
		try
		{
			$this->db = new PDO("mysql:host=$server;dbname=$dbname", $user, $password);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
		  	echo $e->getMessage();//FIXTHIS AT END
		}

	}

	public function get_found_rows()
	{
		$res = $this->db->query("SELECT FOUND_ROWS()");
		return intval($res->fetch(PDO::FETCH_ASSOC)['FOUND_ROWS()']);
	}

	public function categories()
	{
		$categories = [];
		foreach (Queries::$category_overview as $key => $query) {
			$stmt = $this->db->query($query);
			$categories[$key] = $stmt->fetch(PDO::FETCH_ASSOC);
		}
		return $categories;
	}

	public function query_category($args)
	{
		$query_key = $args['category'];
		$limit = $args['limit'];
		$offset = $args['offset'];

		$stmt = $this->db->prepare(Queries::$category_queries[$query_key]);
		$stmt->bindValue(1,intval($limit),PDO::PARAM_INT);
		$stmt->bindValue(2,intval($offset),PDO::PARAM_INT);
		$querystart = microtime(true);
		$res = $stmt->execute();
		if(!$res)
		{
			printf('no results from query: %s',Queries::$category_queries[$query_key]);
			return false;
		}

		$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach ($res as &$r) $r['args'] = self::$arg_associations[$query_key].'='.$r['id'];

		unset($r);

		$result['res'] = $res;
		$result['time'] = microtime(true) - $querystart; //time taken for query
		$result['count'] = $this->get_found_rows();
		return $result;
	}


	//Takes an image id and returns elaborated information about the image
	public function elaborate($id)
	{
		$id = $id;
		$result = [];

		foreach (Queries::$elaborate_queries as $key => $query)
		{
			$stmt = $this->db->prepare($query);
    	$stmt->bindValue(1,intval($id));
			$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			'Query String: '.$stmt->queryString; //query string (without bound arguments)
			if (count($res) == 0) $result[$key] = [];
			else
				foreach ($res as $r)
					foreach ($r as $key => $value)
						$result[$key][] = $value;
		}
		return $result;
	}

public function artist_information($args)
{
	$stmt = $this->db->prepare(Queries::$artist_query);
	$stmt->bindValue(1,$args['artist_id']);

	$querystart = microtime(true);
		try
		{
			$result = $stmt->execute();
		}catch(PDOException $e)
		{
			?>
			<h3><?=$e?></h3>
			<?php
		}

		$result = [];
		$result['res'] = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
		$result['time'] = microtime(true) - $querystart; //time taken for query
		return $result;

}

public function do_custom_query($args)
	{
		$constructed_query = Queries::$custom_query_strings['base'];
		/*
			For each of the possible query arguments, we check if it is set in passed $args array (created by ArgParser)
			if set, add the corresponding string to the query and construct the parameter (to be inserted after the query is entirely built)
		*/

		$flag = false; //flag is used for query segments that require WHERE or AND clauses

		if($args['artist_fn'] or $args['artist_ln'])
		{
			$first = '%'.$args['artist_fn'].'%';
			$last = '%'.$args['artist_ln'].'%';
			$constructed_query .= Queries::$custom_query_strings['artist'];
			$flag = true;
		}
		else if($args['artist_id'])
		{
			$id = $args['artist_id'];
			$constructed_query .= Queries::$custom_query_strings['artist_id'];
		}

		if($args['glazing'])
		{
			$glazing = '%'.$args['glazing'].'%';
			$constructed_query .= Queries::$custom_query_strings['glazing'];
		}
		if($args['material'])
		{
			$material = '%'.$args['material'].'%';
			$constructed_query .= Queries::$custom_query_strings['material'];
		}
		if($args['object'])
		{
			$object = '%'.$args['object'].'%';
			$constructed_query .= Queries::$custom_query_strings['object'];
		}
		if($args['technique'])
		{
			$technique = '%'.$args['technique'].'%';
			$constructed_query .= Queries::$custom_query_strings['technique'];
		}
		if($args['temperature'])
		{
			$temperature = '%'.$args['temperature'].'%';
			$constructed_query .= Queries::$custom_query_strings['temperature'];
		}


		if($args['date_s'])
		{
			$date_s = $args['date_s'];
			if($args['date_e'] == '') $args['date_e'] = date('Y');//if the end date isnt specified, use current year
			else $date_e = $args['date_e'];

			$constructed_query .= ($flag ? ' AND' : ' WHERE').Queries::$custom_query_strings['created'];
			$flag = true;
		}


		$constructed_query .= ($flag ? ' AND' : ' WHERE').Queries::$custom_query_strings['end'];
		$stmt = $this->db->prepare($constructed_query);

		//now that the query is built we bind all the parameters
		if (isset($glazing)) $stmt->bindParam(':glaze',$glazing);
		if (isset($material)) $stmt->bindParam(':mat',$material);
		if (isset($object)) $stmt->bindParam(':obj',$object);
		if (isset($technique)) $stmt->bindParam(':tech',$technique);
		if (isset($temperature)) $stmt->bindParam(':temp',$temperature);

		if(isset($id))
		{
			$stmt->bindParam(':id',$id);
		}
		else if(isset($first) or isset($last))
		{
			$stmt->bindParam(':first',$first);
			$stmt->bindParam(':last',$last);
		}
		if(isset($date_s))
		{
			$stmt->bindParam(':year_s',$date_s);
			$stmt->bindParam(':year_e',$date_e);
		}

		//limit and offset are always included, so they are handled at the end
		$lim = intval($args['limit']);
		$ofs = intval($args['offset']);

		$stmt->bindValue(':lim',$lim, PDO::PARAM_INT);
		$stmt->bindValue(':ofs', $ofs, PDO::PARAM_INT);

		//'Query String: '.$stmt->queryString; //query string (without bound arguments)

		$querystart = microtime(true);
		try
		{
			$result = $stmt->execute();
		}catch(PDOException $e)//FIXTHIS for end
		{
			//deal with error, dont echo it
			?>
			<h3><?=$e?></h3>
			<?php
		}
		$result = [];
		$result['res'] = $stmt->fetchAll(PDO::FETCH_ASSOC);


		$result['time'] = microtime(true) - $querystart; //time taken for query
		$result['count'] = $this->get_found_rows();
		return $result;
	}
}

?>
