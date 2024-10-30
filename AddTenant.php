<?php
session_start();
if(isset($_SESSION['uid'])){
  if(isset($_GET['variable']))
  $receivedVariable = urldecode($_GET['variable']);
  $encodedVariable = urlencode($receivedVariable);
  $email=$_SESSION['uid'];
  include 'Conn.php';
$sql = "SELECT * FROM login WHERE email = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$name = $row['name'];
$phone = $row['phone'];
$sql1 = "SELECT * FROM tenant WHERE temail = '$email'";
$result1 = $conn->query($sql1);
if ($result1 && $result1->num_rows > 0) { 
    header("Location: ConfirmBooking.php?variable=$encodedVariable");
} else {
  echo 'no';
    $sql2 = "INSERT INTO tenant (tname, tphone, temail) VALUES ('$name', '$phone', '$email')";
    if ($conn->query($sql2) === TRUE) {
      header("Location: ConfirmBooking.php?variable=$encodedVariable");
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