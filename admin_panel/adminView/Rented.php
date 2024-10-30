
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
    <legend>List of Room</legend>
    <?php
  include "../config/conn.php";
    $sql="select * from rooms where availability='no'";
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