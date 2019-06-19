<?php  
require 'config.class.php';

class mysql
{
	static $queries = [
		'artists' => "SELECT CONCAT(a.artist_fname,' ', a.artist_lname) AS title , i.original AS original, a.id AS id FROM artists a JOIN images i ON ((a.artist_fname = i.artist_fname) AND (a.artist_lname = i.artist_lname)) WHERE i.featured = '1' ORDER BY TRIM(a.artist_lname) ASC, TRIM(a.artist_fname) ASC LIMIT %d OFFSET %d;",

		'artist' => "SELECT a.artist_fname, a.artist_lname, i.original, a.id FROM artists a JOIN images i ON ((a.artist_fname = i.artist_fname) AND (a.artist_lname = i.artist_lname)) WHERE (i.featured = '1' AND a.artist_fname LIKE ('%%s%') AND a.artist_lname LIKE ('%%s%')) ORDER BY TRIM(a.artist_lname) ASC, TRIM(a.artist_fname) ASC LIMIT %d OFFSET %d;",

		'institutions' => "SELECT * FROM organizations ORDER BY organizations.name ASC LIMIT %d OFFSET %d;",

		'institution' => "",#"",

		'images' => "SELECT DISTINCT CONCAT(i.artist_fname, ' ', i.artist_lname), i.title AS title, i.original as original FROM images i WHERE i.active = 'yes' AND i.artist_fname IS NOT NULL AND i.artist_fname != '' AND i.title IS NOT NULL AND i.title != '' LIMIT %d OFFSET %d;",

		'image' => "",#"SELECT * from images i where i.id = %s",

		'glazings' => "SELECT COUNT(i.id) AS count, g.glazing AS title, m.glazing_id AS id, i.original AS original FROM glazing g JOIN glazing_match m ON g.id = m.glazing_id JOIN images i ON m.image_id = i.id AND i.active = 'yes' GROUP BY g.glazing ORDER BY COUNT(i.id) DESC LIMIT %d OFFSET %d;",

		'glazing' => "",#"SELECT i.* FROM images i JOIN glazing_match m WHERE m.glazing_id = %s AND i.id = m.image_id ORDER BY i.artist_lname ASC, i.artist_fname ASC LIMIT %d OFFSET %d;",

		'materials' => "SELECT COUNT(i.id) as count, m.material as title, mm.material_id as id FROM material m JOIN material_match mm ON m.id = mm.material_id JOIN images i ON mm.image_id = i.id AND i.active = 'yes' GROUP BY m.material ORDER BY COUNT(i.id) DESC LIMIT %d OFFSET %d;",

		'material' => "",#"SELECT i.* FROM images i JOIN material_match m WHERE m.material_id = %s AND i.id = m.image_id ORDER BY i.artist_lname ASC, i.artist_fname ASC LIMIT %d OFFSET %d;",

		'objects' => "SELECT COUNT(i.id) as count, m.object_type as title, om.object_type_id as id i.original AS original FROM object_type m JOIN object_type_match om ON m.id = om.object_type_id JOIN images i ON om.image_id = i.id AND i.active = 'yes' GROUP BY m.object_type ORDER BY COUNT(i.id) DESC LIMIT %d OFFSET %d;",

		'object' => "",#"SELECT i.* FROM images i JOIN object_type_match m WHERE m.object_type_id = %s AND i.id = m.image_id ORDER BY i.artist_lname ASC, i.artist_fname ASC LIMIT %d OFFSET %d;",

		'techniques' => "SELECT COUNT(i.id) as count, m.techniques as title, tm.techniques_id as id i.original AS original FROM techniques m JOIN technique_match tm ON m.id = tm.techniques_id JOIN images i ON tm.image_id = i.id AND i.active = 'yes' GROUP BY m.techniques ORDER BY COUNT(i.id) DESC LIMIT %d OFFSET %d;",

		'technique' => "",#"SELECT i.* FROM images i JOIN technique_match m WHERE m.techniques_id = %s AND i.id = m.image_id ORDER BY i.artist_lname ASC, i.artist_fname ASC LIMIT %d OFFSET %d;",

		'temperatures' => "SELECT COUNT(i.id) as count, m.temperature as title, tm.temperature_id as id i.original AS original FROM temperature m JOIN temperature_match tm ON m.id = tm.temperature_id JOIN images i ON tm.image_id = i.id AND i.active = 'yes' GROUP BY m.temperature ORDER BY COUNT(i.id) DESC LIMIT %d OFFSET %d;",

		'temperature' => ""#"SELECT i.* FROM images i JOIN temperature_match m WHERE m.temperature_id = %s AND i.id = m.image_id ORDER BY i.artist_lname ASC, i.artist_fname ASC LIMIT %d OFFSET %d;"
	];

	static $default_query = "images";
	static $default_query_lim = 20;
	static $default_query_offset = 0;
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
		}
		catch(PDOException $e) 
		{
		  	echo $e->getMessage();
		}
		
	}

	public function query_db($query_key, $limit=self::$default_query_lim, $offset=self::$default_query_offset, $arg_dict=NULL)
	{
		if(!isset($query_key) or !isset(self::$queries[$query_key]))
		{
			printf("no value matching key: |%s| found, using default",$query_key);
			$query_key = self::$default_query;
		}

		$query = sprintf(self::$queries[$query_key], $limit, $offset);

		$result = $this->db->query($query);
		if(!$result)
		{
			printf("no results from query: %s",self::$queries[$query_key]);
			return false;
		}
		
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}

	public function do_custom_query($args)
	{
		//mysql_real_escape_string(unescaped_string)	
		if($args['artist_fn'] !== NULL or $args['artist_ln'] !== NULL)
		{
			
		}
		else if($args['glazing'] !== NULL)
		{

		}
		else if($args['material'] !== NULL)
		{

		}
		else if($args['object'] !== NULL)
		{

		}
		else if($args['technique'] !== NULL)
		{

		}
		else if($args['temperature'] !== NULL)
		{

		}
	}

}


?>