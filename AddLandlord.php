<?php
session_start();
if(isset($_SESSION['uid'])){
  $email=$_SESSION['uid'];
  include 'Conn.php';
$sql = "SELECT * FROM login WHERE email = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name = $row['name'];
$phone = $row['phone'];
$sql1 = "SELECT * FROM landlord WHERE lemail = '$email'";
$result1 = $conn->query($sql1);
if ($result1 && $result1->num_rows > 0) { 
    header("Location:AddRoom.php");
} else {
  echo 'no';
    $sql2 = "INSERT INTO landlord (lname, lphone, lemail) VALUES ('$name', '$phone', '$email')";
    if ($conn->query($sql2) === TRUE) {
      header("Location: AddRoom.php");
     } else {
      echo "Error executing SQL query: " . $conn->error;
      exit();
     }
 }
}
else{
  header('Location:Dashboard.php');
}
?>
