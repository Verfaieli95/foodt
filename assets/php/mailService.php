<?php
require("../../common.php"); 
$uid = $_GET["id"];

$query = " 
	SELECT 
	user_devices.device_id, devices.device_name
	FROM user_devices 
	LEFT JOIN devices
	ON user_devices.device_id = devices.device_id
	WHERE 
	user_id = :uid
	"; 

$query_params = array( 
	':uid' => $uid
); 

try{ 
	$stmt = $db->prepare($query); 
	$result = $stmt->execute($query_params); 
	} 
catch(PDOException $ex) 
{ 
	die("Please don't leave anything blank!"); 
} 


	$resultSet = [];
while ($cRecord =  $stmt->fetch()) {
	array_push($resultSet, $cRecord);
	}
	$resultData = array();
foreach ($resultSet as $item) {
		$resultData[$item['device_id']] = array();
	$query = " 
	SELECT 
	timestamp,
	food_level,
	temp_level,
	humidity_level
	FROM device_values 
	WHERE 
	device_id = :devid
	"; 
	$query_params = array( 
	':devid' => $item['device_id'],
	); 

	try 
	{ 
	$stmt = $db->prepare($query); 
	$result = $stmt->execute($query_params); 
	} 
	catch(PDOException $ex) 
	{ 
	die("Please don't leave anything blank!"); 
	} 

	$timestampes = [];
	$food_levels = [];
	$temp_values = [];
	$humidity_level = [];
	while($devices_row = $stmt->fetch())
	{
		array_push($timestampes, $devices_row['timestamp']);
		array_push($food_levels, $devices_row['food_level']);
		array_push($temp_values, $devices_row['temp_level']);
		array_push($humidity_level, $devices_row['humidity_level']);
	}			
	
	$resultData[$item['device_id']]['id'] = $item['device_id'];
	$resultData[$item['device_id']]['timestampes'] = $timestampes;
	$resultData[$item['device_id']]['food_levels'] = $food_levels;
	$resultData[$item['device_id']]['temp_values'] = $temp_values;
	$resultData[$item['device_id']]['humidity_level'] = $humidity_level;	
}

foreach($resultData as $item)
{
	echo 'Device ID: ';
	echo $item['id'];
	echo '<br>timestamp: ';
	echo end($item['timestampes']);
	echo '<br>food_levels: ';
	echo end($item['food_levels']);
	echo '<br>temp_values: ';
	echo end($item['temp_values']);
	echo '<br>humidity_level: ';
	echo end($item['humidity_level']);
	echo '<br><br>';
}

$content = ob_get_contents();

$f = fopen("devices_status.html", "w");
fwrite($f, $content);
fclose($f); 

require('gmail.php');

header("Refresh: 1; url=../../index.html"); exit;
?>