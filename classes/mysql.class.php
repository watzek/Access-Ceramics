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


	public function getCategory($category)
	{
		switch ($category) {
			case 'collection':
				# code...
				break;
			case 'artists':
				# code...
				break;
			case 'glazing':
				# code...
				break;
			case 'materials':
				# code...
				break;
			case 'objects':
				# code...
				break;
			case 'technique':
				# code...
				break;
			case 'temperature':
				# code...
				break;
			default:
				# code...
				break;
		}
	}

	public function searchBox($search_query)
	{

	}

	public function allImages()
	{
		$db = $this->db;
		try 
		{
      		$stmt = $db->prepare("select * from images");
      		$stmt->execute();
      		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
      		//var_dump($rows);
    	}
		catch (Exception $e) 
		{
		  echo $e;
		}
		return $rows;
	}


}

?>