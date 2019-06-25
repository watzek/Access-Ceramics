<?php  
require 'config.class.php';



class mysql
{
	static $queries = [
		'artists' => 'SELECT CONCAT(a.artist_fname,\' \', a.artist_lname) AS title, MAX(i.original) AS original, a.id AS id FROM artists a JOIN images i ON ((a.artist_fname = i.artist_fname) AND (a.artist_lname = i.artist_lname)) WHERE i.featured = \'1\' GROUP BY a.id ORDER BY TRIM(a.artist_lname) ASC, TRIM(a.artist_fname) ASC LIMIT ? OFFSET ?',

		'artist' => '',

		'institutions' => 'SELECT DISTINCT * FROM organizations ORDER BY organizations.name ASC LIMIT ? OFFSET ?',

		'institution' => '',

		'images' => 'SELECT CONCAT(i.artist_fname, \' \', i.artist_lname) AS artist, i.title AS title, MAX(i.original) AS original 
			FROM images i 
			WHERE i.active = \'yes\' 
			AND i.artist_fname IS NOT NULL 
			AND i.artist_fname != \'\' 
			AND i.title IS NOT NULL 
			AND i.title != \'\' GROUP BY i.original order by i.timestamp DESC LIMIT ? OFFSET ?',

		'image' => '',

		'glazings' => 'SELECT COUNT(i.id) AS count, g.glazing AS title, m.glazing_id AS id, i.original AS original 
		FROM glazing g 
		JOIN glazing_match m ON g.id = m.glazing_id 
		JOIN images i ON m.image_id = i.id AND i.active = \'yes\' 
		GROUP BY g.glazing ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?',

		'glazing' => '',

		'materials' => 'SELECT COUNT(i.id) as count, m.material AS title, mm.material_id as id, i.original as original
		FROM material m 
		JOIN material_match mm ON m.id = mm.material_id 
		JOIN images i ON mm.image_id = i.id AND i.active =\'yes\' 
		GROUP BY m.material ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?',

		'material' => '',

		'objects' => 'SELECT COUNT(i.id) as count, o.object_type as title, om.object_type_id as id, i.original AS original 
			FROM object_type o
			JOIN object_type_match om ON o.id = om.object_type_id 
			JOIN images i ON om.image_id = i.id AND i.active = \'yes\' 
			GROUP BY o.object_type ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?',

		'object' => '',

		'techniques' => 'SELECT COUNT(i.id) as count, t.technique as title, tm.technique_id as id, i.original AS original 
			FROM techniques t 
			JOIN technique_match tm ON t.id = tm.technique_id 
			JOIN images i ON tm.image_id = i.id AND i.active = \'yes\' 
			GROUP BY t.technique ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?',

		'technique' => '',

		'temperatures' => 'SELECT COUNT(i.id) as count, te.temperature as title, tem.temperature_id as id, i.original AS original 
			FROM temperature te 
			JOIN temperature_match tem ON te.id = tem.temperature_id 
			JOIN images i ON tem.image_id = i.id AND i.active = \'yes\' 
			GROUP BY te.temperature ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?',

		'temperature' => ''];

	static $elaborate_queries = [
		'elaborate' => '
			SELECT  i.original AS src,
					i.id,
					i.title AS title,
					CONCAT(i.artist_fname,\' \',i.artist_lname) AS artist,
					i.date1 AS date1,
					t.technique AS tech,
					tt.temperature AS temp,
					i.height AS h,
					i.width AS w,
					i.depth AS d,
					i.license AS lic 
			FROM images i JOIN technique_match tm ON i.id = tm.image_id 
			      JOIN techniques t ON tm.technique_id = t.id 
			      JOIN temperature_match ttm ON ttm.image_id = i.id 
			      JOIN temperature tt ON tt.id = ttm.temperature_id
			      JOIN object_type_match om ON om.image_id = i.id
			      JOIN object_type o ON o.id = om.object_type_id
			WHERE i.active = \'yes\' and i.id in',
			
		'elab_g'=>'SELECT glazing, g.id from glazing_match gm join glazing g on gm.glazing_id = g.id where gm.image_id = ?;',
		'elab_m'=>'SELECT material, m.id from material_match mm join material m on mm.material_id = m.id where mm.image_id = ?;'
	];
	
	static $custom_query_strings = [
		'base' =>  'SELECT i.original as src, CONCAT(i.artist_fname,\' \',i.artist_lname,\' \',i.title,\' \') as title, i.id as id FROM images i',
		'end' => ' i.active = \'yes\' GROUP BY i.original LIMIT :lim OFFSET :ofs',
		'artist' => ' i.artist_fname LIKE (:first) 
					AND i.artist_lname LIKE (:last)',
		'glazing' => ' JOIN glazing_match gm ON gm.image_id = i.id
					JOIN glazing g ON g.id = gm.glazing_id AND g.glazing LIKE (:glaze)',
		'material' => ' JOIN material_match mm ON mm.image_id = i.id
					JOIN material m ON m.id = mm.material_id AND m.material LIKE (:mat)',
		'object' => ' JOIN object_type_match om ON om.image_id = i.id
					JOIN object_type o ON o.id = om.object_type_id AND o.object_type LIKE (:obj)',
		'technique' => ' JOIN technique_match tm ON tm.image_id = i.id
					JOIN techniques t ON t.id = tm.technique_id AND t.technique LIKE (:tech)',
		'temperature' => ' JOIN temperature_match tem ON tem.image_id = i.id
					JOIN temperature te ON te.id = tem.temperature_id AND te.temperature LIKE (:temp)',
		'added' => ' i.timestamp BETWEEN :time_s and :time_e',
		'created' => ' i.date1 BETWEEN :year_s and :year_e'
	];

	static $default_query = 'images';
	const DEFAULT_QUERY_LIM = 20;
	const DEFAULT_QUERY_OFFSET = 0;


	public function __construct()
	{
		$config = new config();
		$server = $config->server;
		$dbname = $config->dbname;
		$user = $config->user;
		$password = $config->password;
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

	public function query_db($query_key, $offset=self::DEFAULT_QUERY_OFFSET, $limit=self::DEFAULT_QUERY_LIM, $arg_dict=NULL)//TEST
	{
		if(!isset($query_key) or !isset(self::$queries[$query_key]))
		{
			printf('no value matching key: |%s| found, using default',$query_key);
			$query_key = self::$default_query;
		}

		$stmt = $this->db->prepare(self::$queries[$query_key]);
		$stmt->bindValue(1,$limit,PDO::PARAM_INT);
		$stmt->bindValue(2,$offset,PDO::PARAM_INT);

		$result = $stmt->execute();
		if(!$result)
		{
			printf('no results from query: %s',self::$queries[$query_key]);
			return false;
		}
		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	// Used to create custom queries based on user entered parameters
	public function do_custom_query($args)
	{
		$constructed_query = self::$custom_query_strings['base'];
		/*
			For each of the possible query arguments, we check if it is set in passed $args array (created by ArgParser)
			if set, add the corresponding string to the query and construct the parameter (to be inserted after the query is entirely built)
		*/

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
		$flag = false; //flag is used for query segments that require WHERE or AND clauses
		if($args['artist_fn'] or $args['artist_ln'])
		{
			$first = '%'.$args['artist_fn'].'%';
			$last = '%'.$args['artist_ln'].'%';
			$constructed_query .= ($flag ? ' AND' : ' WHERE').self::$custom_query_strings['artist'];//$flag use here is for consistency
			$flag = true;
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
		
		if(isset($first) or isset($last))
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
		if($args['limit'] !== '') $lim = $args['limit'];
			else $lim = self::DEFAULT_QUERY_LIM;
		if($args['offset'] !== '') $ofs = $args['offset'];
			else $ofs = self::DEFAULT_QUERY_OFFSET;

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
		
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		
		$result['time'] = microtime(true) - $querystart; //time taken for query
		return $result;
	}

	//Takes a array of image ids and returns elaborated information about the image
	public function elaborate($ids)
	{
		//since the query requires an array, we have to construct count($id) place holders (?) to be filled by ids
		$inQuery = implode(',', array_fill(0, count($ids), '?'));

		$query = self::$elaborate_queries['elaborate']." ($inQuery) GROUP BY src";

		$stmt = $this->db->prepare($query);
		
		//echo 'Query String: '.$stmt->queryString; //query string (without bound arguments)
		
		foreach ($ids as $k => $id)
    		$stmt->bindValue(($k+1), $id, PDO::PARAM_INT);

    	$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		/* 
			Images can have multiple glazings and materials, so for each result we issue
			another query and construct an array of the form id => name.
			This functionality could probably be added to the above query, but I was having trouble with that.
		*/
		foreach ($result as &$res) {

			$glazing = $this->db->prepare(self::$elaborate_queries['elab_g']);
			$glazing->execute(array($res['id']));
			$res['glazing'] = [];

			foreach ($glazing->fetchAll(PDO::FETCH_ASSOC) as $value)
				$res['glazing'][$value['id']] = $value['glazing'];

			$material = $this->db->prepare(self::$elaborate_queries['elab_m']);
			$material->execute(array($res['id']));
			$res['material'] = [];

			foreach ($material->fetchAll(PDO::FETCH_ASSOC) as $value)
				$res['material'][$value['id']] = $value['material'];

		} unset($res);

		return $result;
	}

}


?>