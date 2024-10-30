<?php
session_start();

if (isset($_SESSION['uid']) && isset($_GET['bid'])) {
    $bid = urldecode($_GET['bid']);
    include 'Conn.php';
    
    $sql1 = "SELECT * FROM booking_requests WHERE bid = $bid";
    $result1 = $conn->query($sql1);
    
    if ($result1 && $result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
        $rid = urlencode($row1['roomno']);
        
        $sql2 = "SELECT temail FROM tenant WHERE tid = (SELECT tid FROM booking_requests WHERE bid = $bid)";
        $result2 = $conn->query($sql2);
        
        if ($result2 && $result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            $to = $row2['temail'];
            
            $sql3 = "SELECT * FROM rooms WHERE roomno = (SELECT roomno FROM booking_requests WHERE bid = $bid)";
            $result3 = $conn->query($sql3);
            
            if ($result3 && $result3->num_rows > 0) {
                $row3 = $result3->fetch_assoc();
                
                $subject = 'Room Rental Request Rejected';
                $message = "Your Room's rental request for the above room has been rejected by the owner." . "\n";
                $message .= 'Room Type: ' . $row3['type'] . "\n";
                $message .= 'Address: ' . $row3['location'];
                $header = 'From: Team CHHAANO';
                
                if (mail($to, $subject, $message, $header)) {
                    $sql = "DELETE FROM booking_requests WHERE bid = $bid";
                    
                    if ($conn->query($sql) === true) {
                        header("Location: reqBooks.php?rid=$rid");
                    } else {
                        echo "Error deleting the booking request: " . $conn->error;
                    }
                } else {
                    echo "Error sending the email.";
                }
            } else {
                echo "Error: No room information found for the request.";
            }
        } else {
            echo "Error: No tenant email found for the request.";
        }
    } else {
        echo "Error: No room number found for the request.";
    }

    $conn->close();
} else{
    header('Location:Dashboard.php');
}
?>