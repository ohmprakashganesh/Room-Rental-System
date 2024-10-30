<?php

  include 'conn.php';
// if(isset($_GET['id'])){
//     $roomno=$_GET['id'];
//     $sql = "select * from rooms, landlord where landlord.lid=rooms.lid and roomno='$roomno'  )" ;
//     $result = $conn->query($sql);
//     if($result && $result->num_rows>0)
//     $row = $result->fetch_assoc();
//   }else
 if(isset($_GET['rid'])) {
    $rid=$_GET['rid'];
    $sql = "select * from rooms, landlord where landlord.lid=rooms.lid and roomno = '$rid'" ;
    // $result = $conn->query($sql);
    $result=mysqli_query($conn,$sql);
    if($result && $result->num_rows > 0)
    $row = $result->fetch_assoc();
  } else{
    header('Location:Dashboard.php');
  }
 
  //this code is for admin ko enquiere click garda




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Information</title>
    <link rel="stylesheet" href="CSS/enqbook.css">
    <link rel="stylesheet" href="CSS/final.css">
</head>
<body>
    <div class="top">
    <p>
        <img src="IMAGE/logo.png" alt="">
    </p>
    <nav>
        <ul>
            <li> <a href="#">Home</a></li>
            <li> <a href="#">Rooms</a></li>
            <li> <a href="#">Contact</a></li>
            <li> <a class="menu" href="#">Menu</a></li>
        </ul>
    </nav>
    <p>
        <a href="LoginUser.php"><button class="abtn">You</button> </a>
    </p>
</div>
    <div class="container">
        <div class="left-side">
        <?php echo '<img src="' . $row['image'] . '">'; ?>
        </div>
        <div class="right-side">
            <div class="room-info">
                <h2>Room Information</h2>
                <p>Type: <?php echo $row['type'];?></p></p>
                <p>Address: <?php echo $row['location'];?></p>
                <p>Price: <?php echo $row['price'];?></p>
            </div>
            <div class="landlord-info">
                <h2>Landlord Information</h2>
                <p>Name: <?php echo $row['lname'];?></p>
                <p>Email: <?php echo $row['lemail'];?></p>
                <p>Phone: <?php echo $row['lphone'];?></p>
            </div>
            <?php $sqll="select * from rooms";
    $exe=mysqli_query($conn,$sqll);
    if($exe){
        $res=mysqli_fetch_assoc($exe);
        if($res['availability']=='no'){ ?>
            <a ><button class="ebooked">Booked</button></a>
            <?php 
        } else{ ?>
        <a href="LoginT.php?id=<?php echo $roomno ?>"><button class="book-button">Booked</button></a>

        <?php


        }
    }
        ?>


            
        </div>
    </div>
</body>
</html>