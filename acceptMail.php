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
        
        $sql2 = "SELECT * FROM tenant WHERE tid = (SELECT tid FROM booking_requests WHERE bid = $bid)";
        $result2 = $conn->query($sql2);
        
        if ($result2 && $result2->num_rows > 0) {
            $row2 = $result2->fetch_assoc();
            $to = $row2['temail'];
            
            $sql3 = "SELECT * FROM rooms WHERE roomno = (SELECT roomno FROM booking_requests WHERE bid = $bid)";
            $result3 = $conn->query($sql3);
            
            if ($result3 && $result3->num_rows > 0) {
                $row3 = $result3->fetch_assoc();
                
                $subject = 'Room Rental Request accepted';
                $message = "Your Room's rental request for the above room has been accepted by the owner." . "\n";
                $message .= 'Room Type: ' . $row3['type'] . "\n";
                $message .= 'Address: ' . $row3['location'];
                $header = 'From: Team CHHAANO';
                
                if (mail($to, $subject, $message, $header)) {
                    $sql = "INSERT INTO booking_requests (tid, roomno) VALUES ('" . $row2['tid'] . "', '" . $row1['roomno'] . "')";  // Use 'bookings' table instead of 'booking_requests'
                    
                    if ($conn->query($sql) === true) {
                        // Delete the booking request
                        $sqls = "DELETE FROM booking_requests WHERE roomno = " . $row1['roomno'];
                        
                        if ($conn->query($sqls) === true) {
                            // Update room availability
                            $sq = "UPDATE rooms SET availability = 'no' WHERE roomno = " . $row1['roomno'];
                            
                            if ($conn->query($sq) === true) {
                                // Redirect to a success page or perform other actions
                                header("Location: reqBooks.php?rid=$rid");


                            } else {
                                echo "Error updating room availability: " . $conn->error;
                            }
                        } else {
                            echo "Error deleting the booking request: " . $conn->error;
                        }
                    } else {
                        echo "Error inserting into bookings: " . $conn->error;
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
        header('Location: Dashboard.php');
    }
}


?>