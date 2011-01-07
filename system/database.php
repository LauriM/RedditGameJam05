<?php
$time = time();

mysql_pconnect($db_server,$db_username,$db_password) or die();
mysql_select_db($db_database);

function query($query,$debug = false){
	
	if($debug == true){
		echo "$query";
	}
	
	$mysql_debug = true;

	if($mysql_debug == "true"){
		//debug enabled
		$result = mysql_query($query) or die(mysql_error());
	}else{
		//debug disabled
		$result = mysql_query($query) or die();
	}

	//Global, because its easy way to get total query count
	global $total_query_count;
	$total_query_count = $total_query_count + 1;

	return $result;
}

?>
