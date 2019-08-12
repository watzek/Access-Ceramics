<?php
	require 'classes/argparser.class.php';
	require 'classes/mysql.class.php';

	$ap = new ArgParser($_GET);
	$db = new mysql();

	$args = $ap->get_args();
	unset($ap);



	if(!$args)
	{
		$results = $db->categories();
	}
	else if($args['elaborate'] == 1)
	{
		if($args['id'])
		{
			$results = $db->elaborate($args['id']);
		}
		else
		{
			$results = ["info"=>'no id'];
		}
	}
	else if($args['state'] == 'category')
	{
		$results = $db->query_category($args);
	}
	else
	{
		$results = $db->do_custom_query($args);
	}

	echo json_encode($results);
?>
