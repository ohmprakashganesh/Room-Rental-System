<?php
session_start();
if (isset($_SESSION['uid'])) {
    $email = $_SESSION['uid'];
    include 'Conn.php';
    $sql = "SELECT * FROM login WHERE email='$email'";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

    }
    $sql1 = "SELECT * FROM login, tenant WHERE login.email=tenant.temail AND login.email='$email'";
    $result1 = $conn->query($sql1);
    if ($result1 && $result1->num_rows > 0) {
        $row1 = $result1->fetch_assoc();
    }

    $sql2 = "SELECT * FROM login, landlord, rooms WHERE login.email=landlord.lemail AND landlord.lid=rooms.lid AND email='$email'";
    $result2 = $conn->query($sql2);
    if ($result2 && $result2->num_rows > 0) {
        $row2 = $result2->fetch_assoc();
    }
    $sql3=" select count(rooms.lid) as tot_rooms from landlord,rooms where landlord.lid=rooms.lid and lemail='$email'";
    $result3 = $conn->query($sql3);
    $row3=$result3->fetch_assoc();
    $sqls=" select count(booking.tid) as total_rooms from tenant,booking where tenant.tid=booking.tid and temail='$email'";
    $results = $conn->query($sqls);
    $rows=mysqli_fetch_assoc($result);

    }
else{
    header('Location:LoginUser.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/profile.css">
</head>
<body>
    <div id="user-profiles">
        <h2>User-Info</h2>
        <hr>
        <div id="image">
            <div id="pic"><img src="IMAGE/1.jpg" alt="picture here" srcset=""></div>
            <div id="details">
                <p class="name">Name:<?php echo $row['name']?></p>
                <p class="id">User ID: @<?php echo $row['id']?></p>
            </div>
        </div>
        <div id="rooms">
        <a href="rentedRoom.php"><div id="roomrented">
            <?php if(isset($rows['total_rooms'])) echo $rows['total_rooms'];
            ?>
            <br>Room Rented</div></a>

            <a href="addedRoom.php"><div id="roomadded">
            <?php if(isset($row3['tot_rooms'])) echo $row3['tot_rooms'];?>
            <br>Room Added</div></a>
        </div>
        <div id="edits">    
            <a href="editDetails.php"><div id="edit">Edit</div></a>
            <a href="changeDetails.php"><div id="change">Change Password</div></a>
        </div>
        <div id="logout">    
        <a href="logout.php">LOG OUT</a>
        </div>    
    </div>
</body>
</html>