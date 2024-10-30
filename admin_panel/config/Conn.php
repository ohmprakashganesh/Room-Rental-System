<?php
$conn = new mysqli("localhost", "root", "", "room renting system");
if($conn->connect_error){
    die("Could not connnect database" . $conn->connect_error);
}
?>