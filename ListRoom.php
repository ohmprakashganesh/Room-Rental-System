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
    <meta name="viewport" content="width=<, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='CSS/user.css'>
    <link rel='stylesheet' href='CSS/Registration.css'>
</head>
<body>
<div id="container">
        <div class="image-section">
            <div class="image">
                <img src="IMAGE/dark.PNG" alt="" srcset="">
            </div>
            <div class="name">
            <p class="name"><?php echo $row['name']?></p>
                <p class="phone"><?php echo $row['phone']?></p>
                <p class="email"><?php echo $row['email']?></p>
                <p class="id">User ID: @<?php echo $row['id']?></p>
            </div>
        </div>
    <div class="accessories">
    <fieldset>
    <legend>List of Room</legend>
    <?php
if ($result1 && $result1->num_rows > 0) {
    echo '<table>';
    echo "<tr>";
    while ($rows = $result1->fetch_assoc()) {
        $rid = $rows['roomno'];
        echo '<div id="details">';
        echo "<tr>";
        echo "<td colspan='3'><hr></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td width='80%'>" . " Room Type: ".$rows['type']. "<br> Location: ".$rows['location']."</td>";
        echo "<td>" . "<a href='UpdateRoom.php?rid=" . $rid. "'><Button type='submit'>EDIT</Button></a></td>";
        echo "<td>" . "<Button type='submit' onclick='return deleteR(rid=" . $rid. ")'>DELETE</Button></td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td colspan='3'><hr></td>";
       }
       echo "</tr>";
       echo "</table>";
     }
     else{
        echo "No rooms Registered by this landlord!";
        }
    ?>
    </div>
    </fieldset>
    </div>
    <div id="confirm">
      <input type="text" name="" id="roomno" disabled>
      <span>Are you sure you want to delete?</span><hr>

      <div class="cancel">
        <a href='ListRoom.php'><button type='Submit' id='cancel'>Cancel</button></a>
    </div>
      <div class="delete">
        <a href='#' onclick='passValue()'><button type='Submit' id='con-btn'>Delete</button></a>
    </div>
    </div>
</body>
<script>
    function deleteR(id){
        document.getElementById('confirm').style.display='block';
        document.getElementById('roomno').value=id;

    }
    function passValue(){
        var inputValue = document.getElementById("roomno").value;
        var url = "DeleteRoom.php?rid=" + encodeURIComponent(inputValue);
        window.location.href = url;
    }
</script>
</html>

