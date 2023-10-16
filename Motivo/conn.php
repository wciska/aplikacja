<?php
$servername = "localhost";  
$username = "w_ciska"; 
$password = "ciska"; 
$dbname = "w_ciska"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}
?>