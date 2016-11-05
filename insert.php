<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require("common.php"); 
 
// Escape user inputs for security
$food_minimum = $_POST['food_minimum'];
$water_minimum = $_POST['water_minimum'];
$temperature_min = $_POST['temperature_min'];
$temperature_max = $_POST['temperature_max'];
$humidity_min = $_POST['humidity_min'];
$humidity_max= $_POST['humidity_max'];
$uid = $_SESSION['user']['id'];

        $query = " 
            update devices  
             set 
                food_minimum = :food_minimum, 
                water = :water, 
                temperature_min = :temperature_min,
                temperature_max = :temperature_max,
                humidity_min = :humidity_min,
                humidity_max = :humidity_max
             WHERE id=:uid;
        "; 


        $query_params = array( 
            ':uid' => $uid,
            ':food_minimum' => $food_minimum, 
            ':water' => $water, 
            ':temperature_min' => $temperature_min, 
            ':temperature_max' => $temperature_max, 
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