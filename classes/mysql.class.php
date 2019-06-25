<?php  
require 'config.class.php';



class mysql
{
	static $queries = [
		'artists' => "SELECT CONCAT(a.artist_fname,' ', a.artist_lname) AS title, MAX(i.original) AS original, a.id AS id FROM artists a JOIN images i ON ((a.artist_fname = i.artist_fname) AND (a.artist_lname = i.artist_lname)) WHERE i.featured = '1' GROUP BY a.id ORDER BY TRIM(a.artist_lname) ASC, TRIM(a.artist_fname) ASC LIMIT ? OFFSET ?",

		'artist' => "",

		'institutions' => "SELECT DISTINCT * FROM organizations ORDER BY organizations.name ASC LIMIT ? OFFSET ?",

		'institution' => "",

		'images' => "SELECT CONCAT(i.artist_fname, ' ', i.artist_lname) AS artist, i.title AS title, MAX(i.original) AS original FROM images i WHERE i.active = 'yes' AND i.artist_fname IS NOT NULL AND i.artist_fname != '' AND i.title IS NOT NULL AND i.title != '' GROUP BY i.original LIMIT ? OFFSET ?",

		'image' => "",

		'glazings' => "SELECT COUNT(i.id) AS count, g.glazing AS title, m.glazing_id AS id, i.original AS original FROM glazing g JOIN glazing_match m ON g.id = m.glazing_id JOIN images i ON m.image_id = i.id AND i.active = 'yes' GROUP BY g.glazing ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?",

		'glazing' => "",

		'materials' => "SELECT COUNT(i.id) as count, m.material as title, mm.material_id as id FROM material m JOIN material_match mm ON m.id = mm.material_id JOIN images i ON mm.image_id = i.id AND i.active = 'yes' GROUP BY m.material ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?",

		'material' => "",

		'objects' => "SELECT COUNT(i.id) as count, m.object_type as title, om.object_type_id as id i.original AS original FROM object_type m JOIN object_type_match om ON m.id = om.object_type_id JOIN images i ON om.image_id = i.id AND i.active = 'yes' GROUP BY m.object_type ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?",

		'object' => "",

		'techniques' => "SELECT COUNT(i.id) as count, m.techniques as title, tm.techniques_id as id i.original AS original FROM techniques m JOIN technique_match tm ON m.id = tm.techniques_id JOIN images i ON tm.image_id = i.id AND i.active = 'yes' GROUP BY m.techniques ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?",

		'technique' => "",

		'temperatures' => "SELECT COUNT(i.id) as count, m.temperature as title, tm.temperature_id as id i.original AS original FROM temperature m JOIN temperature_match tm ON m.id = tm.temperature_id JOIN images i ON tm.image_id = i.id AND i.active = 'yes' GROUP BY m.temperature ORDER BY COUNT(i.id) DESC LIMIT ? OFFSET ?",

		'temperature' => "",
		'elaborate' => "
		SELECT  i.original AS src,
				i.id,
				i.title AS title,
				CONCAT(i.artist_fname,' ',i.artist_lname) AS artist,
				i.date1 AS date1,
				i.date2 AS date2,
				t.technique AS tech,
				tt.temperature AS temp,
				g.glazing AS glaze,
				m.material AS mat,
				i.height AS h,
				i.width AS w,
				i.depth AS d,
				i.license AS lic 
			FROM images i JOIN technique_match tm ON i.id = tm.image_id 
			      JOIN techniques t ON tm.technique_id = t.id 
			      JOIN temperature_match ttm ON ttm.image_id = i.id 
			      JOIN temperature tt ON tt.id = ttm.temperature_id
			      JOIN glazing_match gm ON gm.image_id = i.id
			      JOIN glazing g ON g.id = gm.glazing_id
			      JOIN material_match mm ON mm.image_id = i.id
			      JOIN material m ON mm.material_id = m.id
			      JOIN object_type_match om ON om.image_id = i.id
			      JOIN object_type o ON o.id = om.object_type_id
			WHERE i.active = '1' and i.id in (?)
			GROUP BY src"
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

	static $default_query = "images";
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
			printf("no value matching key: |%s| found, using default",$query_key);
			$query_key = self::$default_query;
		}

		$prep_q = $this->db->prepare(self::$queries[$query_key]);

		$result = $this->prep_q->execute($limit,$offset);
		if(!$result)
		{
			printf("no results from query: %s",self::$queries[$query_key]);
			return false;
		}
		
		return $result->fetchAll(PDO::FETCH_ASSOC);
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
			if($args['date_e'] == '') $args['date_e'] = date("Y");//if the end date isnt specified, use current year
			else $date_e = $args['date_e'];
			
			$constructed_query .= ($flag ? ' AND' : ' WHERE').self::$custom_query_strings['created'];
			$flag = true;
		}


		$constructed_query .= ($flag ? ' AND' : ' WHERE').self::$custom_query_strings['end'];
		$prep_q = $this->db->prepare($constructed_query);

		//now that the query is built we bind all the parameters
		if (isset($glazing)) $prep_q->bindParam(':glaze',$glazing);
		if (isset($material)) $prep_q->bindParam(':mat',$material);
		if (isset($object)) $prep_q->bindParam(':obj',$object);
		if (isset($technique)) $prep_q->bindParam(':tech',$technique);
		if (isset($temperature)) $prep_q->bindParam(':temp',$temperature);
		
		if(isset($first) or isset($last))
		{
			$prep_q->bindParam(':first',$first);
			$prep_q->bindParam(':last',$last);
		}
		if(isset($date_s))
		{
			$prep_q->bindParam(':year_s',$date_s);
			$prep_q->bindParam(':year_e',$date_e);
		}
		
		//limit and offset are always included, so they are handled at the end
		if($args['limit'] !== '') $lim = $args['limit'];
			else $lim = self::DEFAULT_QUERY_LIM;
		if($args['offset'] !== '') $ofs = $args['offset'];
			else $ofs = self::DEFAULT_QUERY_OFFSET;

		$prep_q->bindValue(':lim',$lim, PDO::PARAM_INT);
		$prep_q->bindValue(':ofs', $ofs, PDO::PARAM_INT);
		
		//echo "Query String: ".$prep_q->queryString; // to see query string used (sin. bound arguments)

		$querystart = microtime(true);
		try
		{
			$result = $prep_q->execute();
		}catch(PDOException $e)//FIXTHIS for end
		{
			//deal with error, dont echo it 
			?>
			<h3><?=$e?></h3> 
			<?php
		}
		
		$result = $prep_q->fetchAll(PDO::FETCH_ASSOC);

		
		$result['time'] = microtime(true) - $querystart; //time taken for query
		return $result;
	}

	//Takes a array of image ids and returns elaborated information about the image
	public function elaborate($ids)//TEST
	{
		$request_str = $ids[0];
		$cnt = count($ids);
		for ($i=1; $i < $cnt; $i++) { 
			$request_str .= ','.$ids[$i];
		}

		$prep_q = $this->db->prepare(self::$queries['elaborate']);
		$result = $this->db->execute($request_str);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

}


?>