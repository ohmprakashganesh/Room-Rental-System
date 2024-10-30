<?php
session_start();

if (isset($_SESSION['uid']) && isset($_GET['room'])) {
    $roomno = urldecode($_GET['room']);
    
    include 'Conn.php';
    
    $email = $_SESSION['uid'];
    
    $sql = "SELECT tid FROM tenant WHERE temail='$email'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $tid = $row['tid'];
        
        $sql1 = "SELECT bid FROM booking_requests WHERE tid=$tid AND roomno=$roomno";
        $result1 = $conn->query($sql1);
        
        if ($result1 && $result1->num_rows > 0) {
            $_SESSION['reqroom']=$roomno;
            $_SESSION['ReqEmail'] = $email;
            header('Location: SendReqEmail.php');
            exit;
        } else {
            $sqls="select roomno from booking_requests where roomno=$roomno";
            $results=$conn->query($sqls);
            if($results && $results->num_rows>0){
                echo 'Room already booked';
            }
            else{
                $sql2 = "INSERT INTO booking_requests (tid, roomno) VALUES ($tid, $roomno)";
                $result2 = $conn->query($sql2);
                
                if ($result2) {
                    $_SESSION['reqroom']=$roomno;
                    $_SESSION['ReqEmail'] = $email;
                    header('Location: SendReqEmail.php');
                    exit; 
                }
            }
        }
    }
}
else{
    header('Location:Dashboard.php');
}