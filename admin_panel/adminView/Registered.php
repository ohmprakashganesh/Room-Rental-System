<?php
// session_start();
// if (isset($_SESSION['uid'])) {
//     $email = $_SESSION['uid'];
//         include 'Conn.php';
//         $sql = "SELECT * FROM login WHERE email='$email'";
//         $result = $conn->query($sql);
//         if ($result && $result->num_rows > 0) {
//           $row = $result->fetch_assoc();
//         }
//     $sql1="select * from login,landlord,rooms where login.email=landlord.lemail and landlord.lid=rooms.lid and lemail='$email'";
//     $result1 = $conn->query($sql1);
// }
// else{
//     header('Location:Dashboard.php');
//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="../CSS/EditUser.css">
    <link rel="stylesheet" href="../CSS/profile.css"> -->
    <link rel="stylesheet" href="asset/ajaxworkplace.css"> 


</head>
<body>
    <div class="accessories">
    <fieldset>
    <legend>Total Registered Rooms List</legend>
    <?php
  include "../config/conn.php";
    $sql="select * from rooms";
    $exe=mysqli_query($conn,$sql);
    if($exe) {

    echo '<table>';
    echo "<tr>";
    while ($rows = $exe->fetch_assoc()) {
        $rid = $rows['roomno'];
    echo '<div id="details">';
    echo "<tr>";
    echo "<td colspan='4'><hr></td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td class='room-type-cell'>" . "Room Type: " . $rows['type'] . "<br> Location: " . $rows['location'] . "</td>";
    echo "<td>" . "<a href='../UpdateRoom.php?rid=" . $rid . "'><Button >EDIT</Button></a></td>";
    echo "<td>" . "<a href='../enquire.php?rid=" . $rid . "'><Button>Details</Button></a></td>";
    echo "<td>" . "<a href='../DeleteRoom.php?rid=" . $rid . "'><Button >Delete</Button></a></td>";
    
    // echo "<td>" . "<a href='reqBooks.php?rid=" . $rid . "'><Button type='submit'> Requests</Button></a></td>";
    echo "</tr>";

            echo "<tr>";
            echo "<td colspan='4'><hr></td>";
        echo "</tr>";
    }
        echo "</table>";
    }
       ?>
        </div>
        </fieldset>
        </div>
  
</body>
<script>
    // function deleteR(id){
    //     document.getElementById('confirmation-box').style.display='block';
    //     document.getElementById('roomno').value=id;

    // }
    // function passValue(){
    //     var inputValue = document.getElementById("roomno").value;
    //     var url = "../DeleteRoom.php?rid=" + encodeURIComponent(inputValue);
    //     window.location.href = url;
    // }
</script>    
</div>
</body>
</html>