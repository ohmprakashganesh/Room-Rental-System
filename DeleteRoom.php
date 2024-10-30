<?php
session_start();
if(isset($_GET['rid'])) {
    include 'Conn.php';
    $roomno = $_GET['rid'];
    $sql = "DELETE FROM rooms WHERE roomno= '$roomno'";
    $result = $conn->query($sql);
    $conn->query($sql);
    header("Location: SuccessDeletionPage.php");
}
else{
    header("Location:Dashboard.php");
}
?>