<?php  
require 'config.class.php';


class mysql
{
	static $queries = [
		'artists' => "SELECT CONCAT(a.artist_fname, a.artist_lname) AS title , i.original AS original, a.id AS id FROM artists a JOIN images i ON ((a.artist_fname = i.artist_fname) AND (a.artist_lname = i.artist_lname)) WHERE i.featured = '1' ORDER BY TRIM(a.artist_lname) ASC, TRIM(a.artist_fname) ASC LIMIT 20;",

		'artist' => "SELECT a.artist_fname, a.artist_lname, i.original, a.id FROM artists a JOIN images i ON ((a.artist_fname = i.artist_fname) AND (a.artist_lname = i.artist_lname)) WHERE (i.featured = '1' AND a.artist_fname LIKE ('%%s%') AND a.artist_lname LIKE ('%%s%')) ORDER BY TRIM(a.artist_lname) ASC, TRIM(a.artist_fname) ASC;",

		'institutions' => "SELECT * FROM organizations ORDER BY organizations.name ASC;",

		'institution' => "",

		'images' => "SELECT DISTINCT i.artist_fname,i.artist_lname,i.title,i.height,i.width,i.active,i.original FROM images i WHERE i.active = 'yes' AND i.artist_fname IS NOT NULL AND i.artist_fname != '' AND i.title IS NOT NULL AND i.title != '';",

		'image' => "SELECT * from images i where i.id = %s",

		'glazings' => "SELECT COUNT(i.id), g.glazing, m.glazing_id FROM glazing g JOIN glazing_match m ON g.id = m.glazing_id JOIN images i ON m.image_id = i.id AND i.active = 'yes' GROUP BY g.glazing ORDER BY COUNT(i.id) DESC;",

		'glazing' => "SELECT i.* FROM images i JOIN glazing_match m WHERE m.glazing_id = %s AND i.id = m.image_id ORDER BY i.artist_lname ASC, i.artist_fname ASC;",

		'materials' => "SELECT COUNT(i.id), m.material, mm.material_id FROM material m JOIN material_match mm ON m.id = mm.material_id JOIN images i ON mm.image_id = i.id AND i.active = 'yes' GROUP BY m.material ORDER BY COUNT(i.id) DESC;",

		'material' => "SELECT i.* FROM images i JOIN material_match m WHERE m.material_id = %s AND i.id = m.image_id ORDER BY i.artist_lname ASC, i.artist_fname ASC;",

		'objects' => "SELECT COUNT(i.id), m.object_type, om.object_type_id FROM object_type m JOIN object_type_match om ON m.id = om.object_type_id JOIN images i ON om.image_id = i.id AND i.active = 'yes' GROUP BY m.object_type ORDER BY COUNT(i.id) DESC;",

		'object' => "SELECT i.* FROM images i JOIN object_type_match m WHERE m.object_type_id = %s AND i.id = m.image_id ORDER BY i.artist_lname ASC, i.artist_fname ASC;",

		'techniques' => "SELECT COUNT(i.id), m.techniques, tm.techniques_id FROM techniques m JOIN technique_match tm ON m.id = tm.techniques_id JOIN images i ON tm.image_id = i.id AND i.active = 'yes' GROUP BY m.techniques ORDER BY COUNT(i.id) DESC;",

		'technique' => "SELECT i.* FROM images i JOIN technique_match m WHERE m.techniques_id = %s AND i.id = m.image_id ORDER BY i.artist_lname ASC, i.artist_fname ASC;",

		'temperatures' => "SELECT COUNT(i.id), m.temperature, tm.temperature_id FROM temperature m JOIN temperature_match tm ON m.id = tm.temperature_id JOIN images i ON tm.image_id = i.id AND i.active = 'yes' GROUP BY m.temperature ORDER BY COUNT(i.id) DESC;",

		'temperature' => "SELECT i.* FROM images i JOIN temperature_match m WHERE m.temperature_id = %s AND i.id = m.image_id ORDER BY i.artist_lname ASC, i.artist_fname ASC;"
	];

	static $default_query = "images";

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

	public function query_db($result_type, $arg_dict = NULL)
	{
		if(!isset($result_type) or !isset($queries[$result_type]))
		{
			$result_type = self::$default_query;
		}
		
		$result = $this->db->query(self::$queries[$result_type]);
		if($result)
		{
			return $result->fetchAll(PDO::FETCH_ASSOC);
		}
		printf("no results from query: %s",$queries[$result_type]);
		return false;
	}

	public function do_custom_query($args)
	{
		//mysql_real_escape_string(unescaped_string)	
		if($args['artist_fn'] !== NULL or $args['artist_ln'] !== NULL)
		{
			$fn = mysqli_real_escape_string($args['artist_fn']);
			$ln = mysqli_real_escape_string($args['artist_ln']);
			$query = "SELECT a.artist_fname, a.artist_lname, ";	
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