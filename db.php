<?

	$host = "localhost";
	$db = "cch2o_db";
	$db_user = "cch2o_db_user";
	$db_pw = "main9013f";

	$conn = mysql_connect($host, $db_user, $db_pw);
	// if(!$conn){ echo "did not connect";}
	// else
	// {
	// 	echo "worked";
	// }

	mysql_select_db($db, $conn);

?>