<?php
$servername = "databases.000webhost.com";
$database = "id15444120_b3gersc";
$username = "id15444120_b3gersc_db";
$password = "J9b-N*0-qwnh5c3x";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
 
echo "Connected successfully";
 
//$sql = "INSERT INTO Students (name, lastname, email) VALUES ('Test', 'Testing', 'Testing@tesing.com')";
//if (mysqli_query($conn, $sql)) {
//      echo "New record created successfully";
//} else {
//     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
//}
mysqli_close($conn);
?>