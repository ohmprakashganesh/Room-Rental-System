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
    $sql1="select * from login,landlord,rooms where login.email=landlord.lemail and landlord.lid=rooms.lid and lemail='$email'";
    $result1 = $conn->query($sql1);
}
else{
    header('Location:Dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/EditUser.css">
    <link rel="stylesheet" href="CSS/profile.css">
</head>
<body>
    <div class="accessories">
    <fieldset>
    <legend>List of Room</legend>
    <?php
if ($result1 && $result1->num_rows > 0) {
    echo '<table>';
    echo "<tr>";
    while ($rows = $result1->fetch_assoc()) {
        $rid = $rows['roomno'];
if($conn->query($sql)) {
    echo '<div id="details">';
    echo "<tr>";
    echo "<td colspan='4'><hr></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='room-type-cell'>" . "Room Type: " . $rows['type'] . "<br> Location: " . $rows['location'] . "</td>";
    echo "<td>" . "<a href='UpdateRoom.php?rid=" . $rid . "'><Button type='submit'>EDIT</Button></a></td>";
    echo "<td>" . "<Button type='submit' onclick='return deleteR(rid=" . $rid . ")'>DELETE</Button></td>";

    
    $sqll2="select * from booking_requests where roomno='$rid'";
    $exe2=mysqli_query($conn,$sqll2);
    $res2=mysqli_fetch_assoc($exe2);

    $sqll="select * from rooms where roomno='$rid'";
    $exe=mysqli_query($conn,$sqll);
    if($exe){
        $res=mysqli_fetch_assoc($exe);
        if($res['availability']=='no'){
            echo "<td >" . "<Button id='booked' type='button'> Booked</Button></td>";
        }else if($res2 && $res['availability']=='yes'){
            echo "<td '>" . "<a href='reqBooks.php?rid=" . $rid . "'><Button id='requests'  type='submit'> Requests</Button></a></td>";
    
        }else{
            

        }
    }
    // echo "<td>" . "<a href='reqBooks.php?rid=" . $rid . "'><Button type='submit'> Requests</Button></a></td>";
    echo "</tr>";
}
            echo "<tr>";
            echo "<td colspan='4'><hr></td>";
        }
        echo "</tr>";
        echo "</table>";
    }
       ?>
        </div>
        </fieldset>
        </div>
    <div id="confirmation-box">
    <input type="text" name="" id="roomno" disabled>
        <div class="confirmation-message">
            <p>Are you sure you want to proceed with this action?</p>
        </div>
        <div class="button-container">
        <a href='#' onclick='passValue()'><button class="proceed-button">Proceed</button></a>
        <a href='addedRoom.php'><button class="cancel-button">Cancel</button></a>
        </div>
    </div>
</body>
<script>
    function deleteR(id){
        document.getElementById('confirmation-box').style.display='block';
        document.getElementById('roomno').value=id;

    }
    function passValue(){
        var inputValue = document.getElementById("roomno").value;
        var url = "DeleteRoom.php?rid=" + encodeURIComponent(inputValue);
        window.location.href = url;
    }
</script>    
</div>
</body>
</html>