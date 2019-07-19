<?php  
require 'sql_credentials.class.php';

class mysql
{
	static $category_queries = [
		'artists' => 'SELECT SQL_CALC_FOUND_ROWS CONCAT(a.artist_fname,\' \', a.artist_lname) AS title,
							 MAX(i.original) AS src,
							 a.id AS id 
			FROM artists a 
			JOIN images i ON ((a.artist_fname = i.artist_fname) AND (a.artist_lname = i.artist_lname)) 
			WHERE i.featured = \'1\' 
			GROUP BY a.id ORDER BY TRIM(a.artist_lname) ASC, TRIM(a.artist_fname) ASC LIMIT ? OFFSET ?;',

		'institutions' => 'SELECT SQL_CALC_FOUND_ROWS name as title,
								  image_path as src,
								  CONCAT(address1,\' \',city,\' \',state) as info 
			FROM organizations 
			ORDER BY organizations.name ASC LIMIT ? OFFSET ?;',

		'glazings' => 'SELECT SQL_CALC_FOUND_ROWS COUNT(i.id) AS count, 
							  g.glazing AS title, 
							  m.glazing_id AS id, 
							  i.original AS src 
			FROM glazing g 
			JOIN glazing_match m ON g.id = m.glazing_id 
			JOIN images i ON m.image_id = i.id AND i.active = \'yes\' 
			GROUP BY g.glazing ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?;',

		'materials' => 'SELECT SQL_CALC_FOUND_ROWS COUNT(i.id) as count, m.material AS title, mm.material_id as id, i.original as src
			FROM material m 
			JOIN material_match mm ON m.id = mm.material_id 
			JOIN images i ON mm.image_id = i.id AND i.active =\'yes\' 
			GROUP BY m.material ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?;',

		'objects' => 'SELECT SQL_CALC_FOUND_ROWS COUNT(i.id) as count, o.object_type as title, om.object_type_id as id, i.original AS src 
			FROM object_type o
			JOIN object_type_match om ON o.id = om.object_type_id 
			JOIN images i ON om.image_id = i.id AND i.active = \'yes\' 
			GROUP BY o.object_type ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?;',

		'techniques' => 'SELECT SQL_CALC_FOUND_ROWS COUNT(i.id) as count, t.technique as title, tm.technique_id as id, i.original AS src 
			FROM techniques t 
			JOIN technique_match tm ON t.id = tm.technique_id 
			JOIN images i ON tm.image_id = i.id AND i.active = \'yes\' 
			GROUP BY t.technique ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?;',

		'temperatures' => 'SELECT SQL_CALC_FOUND_ROWS COUNT(i.id) as count, te.temperature as title, tem.temperature_id as id, i.original AS src 
			FROM temperature te 
			JOIN temperature_match tem ON te.id = tem.temperature_id 
			JOIN images i ON tem.image_id = i.id AND i.active = \'yes\' 
			GROUP BY te.temperature ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?;'
		];

	

	static $elaborate_queries = [
		'image' =>'SELECT i.original AS src,
					i.id,
					i.title AS title,
					CONCAT(i.artist_fname,\' \',i.artist_lname) AS artist,
					i.date1 AS date,
					i.height AS h,
					i.width AS w,
					i.depth AS d,
					i.license AS license 
			FROM images i WHERE i.active = \'yes\' AND i.id = ? ',
		'object' => 'SELECT o.object_type as object FROM object_type_match om JOIN object_type o ON o.id = om.object_type_id WHERE om.image_id = ?',
		'techniques' => 'SELECT t.technique AS technique FROM technique_match tm JOIN techniques t ON tm.technique_id = t.id WHERE tm.image_id = ?',
		'temp' => 'SELECT tt.temperature AS temperature FROM temperature_match ttm JOIN temperature tt ON tt.id = ttm.temperature_id WHERE ttm.image_id = ?',
		'glazing'=>'SELECT glazing, g.id from glazing_match gm join glazing g on gm.glazing_id = g.id where gm.image_id = ?',
		'material'=>'SELECT material, m.id from material_match mm join material m on mm.material_id = m.id where mm.image_id = ?'
	];
	
	static $custom_query_strings = [
		'base' =>  'SELECT SQL_CALC_FOUND_ROWS i.original as src, CONCAT(i.artist_fname,\' \',i.artist_lname,\' \',i.title,\' \') as title, i.id as id FROM images i',
		'end' => ' i.active = \'yes\' GROUP BY i.original ORDER BY i.artist_image_order LIMIT :lim OFFSET :ofs',

		'glazing' => ' JOIN glazing_match gm ON gm.image_id = i.id JOIN glazing g ON g.id = gm.glazing_id AND g.glazing LIKE (:glaze)',

		'material' => ' JOIN material_match mm ON mm.image_id = i.id JOIN material m ON m.id = mm.material_id AND m.material LIKE (:mat)',

		'object' => ' JOIN object_type_match om ON om.image_id = i.id JOIN object_type o ON o.id = om.object_type_id AND o.object_type LIKE (:obj)',

		'technique' => ' JOIN technique_match tm ON tm.image_id = i.id JOIN techniques t ON t.id = tm.technique_id AND t.technique LIKE (:tech)',

		'temperature' => ' JOIN temperature_match tem ON tem.image_id = i.id JOIN temperature te ON te.id = tem.temperature_id AND te.temperature LIKE (:temp)',

		'artist' => 'WHERE i.artist_fname LIKE (:first) AND i.artist_lname LIKE (:last)',
		'artist_id' => ' JOIN artist_match am ON am.image_id = i.id and am.artist_id = :id',
		'added' =>' i.timestamp BETWEEN :time_s and :time_e',
		'created' =>' i.date1 BETWEEN :year_s and :year_e',
	];
	static $custom_order = [
		'added' => 'ORDER BY i.timestamp',
		'artist' => 'ORDER BY i.artist_image_order' 
	];

	

	static $category_overview = 
	[
		'collection'=>'SELECT COUNT(i.original) AS ct, (SELECT i2.original FROM images i2 WHERE i2.active = \'yes\' ORDER BY RAND() LIMIT 1) AS src FROM images i WHERE i.active = \'yes\';',
		'artists'=>'SELECT COUNT(a.id) AS ct, (SELECT i2.original FROM images i2 WHERE i2.active = \'yes\' AND i2.featured = 1   ORDER BY RAND() LIMIT 1) AS src FROM artists a;',
		'glazing'=>'SELECT COUNT(g.id) AS ct, (SELECT i2.original FROM images i2 WHERE i2.active = \'yes\' AND i2.featured = 1   ORDER BY RAND() LIMIT 1) AS src FROM glazing g;',
		'material'=>'SELECT COUNT(m.id) AS ct, (SELECT i2.original FROM images i2 WHERE i2.active = \'yes\' AND i2.featured = 1   ORDER BY RAND() LIMIT 1) AS src FROM material m;',
		'object'=>'SELECT COUNT(o.id) AS ct, (SELECT i2.original FROM images i2 WHERE i2.active = \'yes\' AND i2.featured = 1   ORDER BY RAND() LIMIT 1) AS src FROM object_type o;',
		'technique'=>'SELECT COUNT(t.id) AS ct, (SELECT i2.original FROM images i2 WHERE i2.active = \'yes\' AND i2.featured = 1   ORDER BY RAND() LIMIT 1) AS src FROM techniques t;',
		'temperature'=>'SELECT COUNT(t.id) AS ct, (SELECT i2.original FROM images i2 WHERE i2.active = \'yes\' AND i2.featured = 1   ORDER BY RAND() LIMIT 1) AS src FROM temperature t;'
	];
	static $arg_associations =
	[
		'artists'=> 'id',
		'glazings'=> 'g',
		'materials'=> 'm',
		'objects'=> 'o',
		'techniques'=> 't',
		'temperatures'=> 'tem',
	];
	

	public function __construct()
	{
		$creds = new Credentials();
		$server = $creds->server;
		$dbname = $creds->dbname;
		$user = $creds->user;
		$password = $creds->password;
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
		foreach (self::$category_overview as $key => $query) {
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

		$stmt = $this->db->prepare(self::$category_queries[$query_key]);
		$stmt->bindValue(1,intval($limit),PDO::PARAM_INT);
		$stmt->bindValue(2,intval($offset),PDO::PARAM_INT);
		$querystart = microtime(true);
		$res = $stmt->execute();
		if(!$res)
		{
			printf('no results from query: %s',self::$category_queries[$query_key]);
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

		foreach (self::$elaborate_queries as $key => $query) 
		{
			$query = $query;
			$stmt = $this->db->prepare($query);
    		$stmt->bindValue(1,intval($id));

    		$stmt->execute();
			$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
			if (count($res) == 0) $result[$key] = [];
			else
				foreach ($res as $r)
					foreach ($r as $key => $value) 
						$result[$key][] = $value;
		}
		return $result;
	}


public function do_custom_query($args)
	{
		$constructed_query = self::$custom_query_strings['base'];
		/*
			For each of the possible query arguments, we check if it is set in passed $args array (created by ArgParser)
			if set, add the corresponding string to the query and construct the parameter (to be inserted after the query is entirely built)
		*/

		$flag = false; //flag is used for query segments that require WHERE or AND clauses

		if($args['artist_fn'] or $args['artist_ln'])
		{
			$first = '%'.$args['artist_fn'].'%';
			$last = '%'.$args['artist_ln'].'%';
			$constructed_query .= self::$custom_query_strings['artist'];
			$flag = true;
		}
		else if($args['artist_id'])
		{
			$id = $args['artist_id'];
			$constructed_query .= self::$custom_query_strings['artist_id'];
		}

		if($args['glazing'])
		{
			$glazing = '%'.$args['glazing'].'%';
			$constructed_query .= self::$custom_query_strings['glazing'];
		}
		if($args['material'])
		{
			$material = '%'.$args['material'].'%';
			$constructed_query .= self::$custom_query_strings['material'];
		}
		if($args['object'])
		{
			$object = '%'.$args['object'].'%';
			$constructed_query .= self::$custom_query_strings['object'];
		}
		if($args['technique'])
		{
			$technique = '%'.$args['technique'].'%';
			$constructed_query .= self::$custom_query_strings['technique'];
		}
		if($args['temperature'])
		{
			$temperature = '%'.$args['temperature'].'%';
			$constructed_query .= self::$custom_query_strings['temperature'];
		}
		

		if($args['date_s'])
		{
			$date_s = $args['date_s'];
			if($args['date_e'] == '') $args['date_e'] = date('Y');//if the end date isnt specified, use current year
			else $date_e = $args['date_e'];
			
			$constructed_query .= ($flag ? ' AND' : ' WHERE').self::$custom_query_strings['created'];
			$flag = true;
		}


		$constructed_query .= ($flag ? ' AND' : ' WHERE').self::$custom_query_strings['end'];
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
		
		//echo 'Query String: '.$stmt->queryString; //query string (without bound arguments)

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