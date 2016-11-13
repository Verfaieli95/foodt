<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require("common.php"); 
 
// Escape user inputs for security
$food_min = $_POST['food_min'];
$next_water_check = $_POST['next_water_check'];
$temp_min = $_POST['temp_min'];
$temp_max = $_POST['temp_max'];
$humidity_min = $_POST['humidity_min'];
$humidity_max= $_POST['humidity_max'];
$device_id = $_POST['device_id'];

        $query = " 
            update user_settings  
             set 
                food_min = :food_min, 
                next_water_check = :next_water_check, 
                temp_min = :temp_min,
                temp_max = :temp_max,
                humidity_min = :humidity_min,
                humidity_max = :humidity_max
             WHERE device_id=:device_id;
        "; 


        $query_params = array( 
            ':device_id' => $device_id,
            ':food_min' => $food_min, 
            ':next_water_check' => $next_water_check, 
            ':temp_min' => $temp_min, 
            ':temp_max' => $temp_max, 
            ':humidity_min' => $humidity_min,
            ':humidity_max' => $humidity_max,
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