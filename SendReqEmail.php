<?php
session_start();
if(isset($_SESSION['ReqEmail']) && isset($_SESSION['reqroom'])){
    include 'Conn.php';
    $room=$_SESSION['reqroom'];
    $sql="Select * from landlord where lid=(select lid from rooms where roomno=$room)";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $to=$_SESSION['ReqEmail'];
    $subject='Booking Request';
    $message = "Your booking request has been successfully added to the database.\n\n";
    $message .= "Wait for Confirmation\n\n";
    $message .= "Owner Details:\n";
    $message .= "Name: " . $row['lname'] . "\n";
    $message .= "Phone: " . $row['lphone'] . "\n";
    $message .= "Email: " . $row['lemail'] . "\n";
    $header='From: Team CHHAANO';
    if(mail($to,$subject,$message,$header)){
        $_SESSION['cemail']=$to;
        header('Location:FinalReqConfirm.php');
    }
    else {
        echo "Email sending to tenant failed. Check your email configuration.";
    }
    $to1=$row['lemail'];
    

    $sql1="Select * from tenant where temail='$to'";
    $result1=$conn->query($sql1);
    $row1=$result1->fetch_assoc();
    $subject1='Booking Request Arrived';
    $message1="The room you have added in CHHAANO website has a rent Request.'\n'.Please Respond.'\n\n'";
    $message1 .= "Request is Waiting for Confirmation.\n\n";
    $message1 .= "<u>Tenant Details</u>\n";
    $message1 .= "Name: " . $row1['tname'] . "\n";
    $message1 .= "Phone: " . $row1['tphone'] . "\n";
    $message1 .= "Email: " . $row1['temail'] . "\n";
    $header1='From: Team CHHAANO';
    if(mail($to1,$subject1,$message1,$header1)){
        header('Location:FinalReqConfirm.php');
    }
    else {
        echo "Email sending to owner failed. Check your email configuration.";
    }
}
?>
