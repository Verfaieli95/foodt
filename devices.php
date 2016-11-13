<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require("common.php"); 
 
// Escape user inputs for security
$device_id = $_POST['device_id'];
$device_name = $_POST['device_name'];
$uid = $_SESSION['user']['id'];
$food_min = $_POST['food_min'];
$next_water_check = $_POST['next_water_check'];
$temp_min = $_POST['temp_min'];
$temp_max = $_POST['temp_max'];
$humidity_min = $_POST['humidity_min'];
$humidity_max= $_POST['humidity_max'];

        $query = " 
            insert into devices (device_id, device_name)  
            values (:device_id, :device_name);
             
        "; 


        $query_params = array( 
            ':device_id' => $device_id, 
            ':device_name' => $device_name, 
        ); 


  try 
        { 
            // Execute the query to create the user 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 

        $query = " 
            insert into user_devices (user_id, device_id)  
            values (:uid, :device_id);
             
        "; 


        $query_params = array( 
            ':device_id' => $device_id, 
            ':uid' => $uid, 
        ); 


  try 
        { 
            // Execute the query to create the user 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 

$query = " 
            insert into user_settings (device_id, food_min, next_water_check, temp_min, temp_max, humidity_min, humidity_max) 
            values (:device_id, 0, 0, 0, 1, 0, 1);

        "; 


        $query_params = array( 
            
            ':device_id' => $device_id, 
        ); 


  try 
        { 
            // Execute the query to create the user 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        } 
        catch(PDOException $ex) 
        { 
            // Note: On a production website, you should not output $ex->getMessage(). 
            // It may provide an attacker with helpful information about your code.  
            die("Failed to run query: " . $ex->getMessage()); 
        } 

header("Refresh: 1; url=index.html"); exit; 

?>

header("Refresh: 1; url=index.html"); exit; 

?>