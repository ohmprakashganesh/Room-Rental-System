<?php
if(($_SERVER['REQUEST_METHOD'])==="POST") {
        include 'Conn.php';
        $name = $_POST['username'];
        $sql = "SELECT * FROM admin WHERE admin_name = '$name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
                echo 'Username already taken!';
            } else {
                echo 'Username Available';
            }
        }
?>