<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
require("common.php"); 
 
// Escape user inputs for security
$food_minimum = $_POST['food_minimum'];
$water_minimum = $_POST['water_minimum'];
$temperature = $_POST['temperature'];
$humidity = $_POST['humidity'];
$uid = $_SESSION['user']['id'];

        $query = " 
            update users  
             set 
                food_minimum = :food_minimum, 
                water_minimum = :water_minimum, 
                temperature = :temperature,
                humidity = :humidity
             WHERE id=:uid;
        "; 


        $query_params = array( 
            ':uid' => $uid,
            ':food_minimum' => $food_minimum, 
            ':water_minimum' => $water_minimum, 
            ':temperature' => $temperature, 
            ':humidity' => $humidity,
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