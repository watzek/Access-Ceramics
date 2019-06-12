<?php  
require 'config.class.php';


class mysql
{
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
	public function get_artists()
	{
		$result = $this->db->query("
			SELECT a.artist_fname, 
					a.artist_lname, 
					i.original, 
			FROM artists a 
			JOIN images i 
			ON ((a.artist_fname = i.artist_fname) AND (a.artist_lname = i.artist_lname))
			WHERE i.featured = '1' 
			ORDER BY TRIM(a.artist_lname) ASC, TRIM(a.artist_fname) ASC;");

		$result = $result->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	public function get_collection()
	{
		$result = $this->db->query("
			SELECT DISTINCT i.artist_fname,
							i.artist_lname,
							i.title,
							i.height,
							i.width,
							i.active,
							i.original
		 	FROM images i;");

		$result = $result->fetch(PDO::FETCH_ASSOC);
		echo count($result);
		/*foreach ($result as $res) {
			echo $result->title;
		}*/
		return $result;
	}

	public function get_institutions()
	{

	}

	public function get_glazing()
	{

	}

	public function get_material()
	{
		
	}

	public function get_object()
	{
		
	}

	public function get_technique()
	{
		
	}

	public function get_temperature()
	{
		
	}

	public function do_custom_query($args)
	{
		//mysql_real_escape_string(unescaped_string)	
		if($args['artist_fn'] !== NULL or $args['artist_ln'] !== NULL)
		{
			$fn = mysql_real_escape_string($args['artist_fn']);
			$ln = mysql_real_escape_string($args['artist_ln']);
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