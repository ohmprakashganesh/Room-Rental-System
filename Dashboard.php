<?php
include 'conn.php';
$query = "SELECT * FROM rooms";
$data = mysqli_query($conn, $query);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/final.css">
</head>

<body>
    <div class="top">
        <p>
            <img src="IMAGE/logo.png" alt="">
        </p>
        <nav>
         <ul>
            <li> <a href="home1.php">Home</a></li>
            <li> <a href="rooms.php">Rooms</a></li>
            <li> <a href="contact.php">Contact</a></li>
            <li> <a  class="menu" href="#">Menu</a></li>
         </ul>
        </nav>
        <p>
        <a href="signup.php"><button class="abtn" name='Login'>+ ADD</button>  </a>
        <?php 
        session_start();
        if (isset($_SESSION['uid'])) { ?>
           
            <a href="user.php"><button class="abtn" name='Login'>YOU</button>  </a>
        <?php 
        }else{
            ?>
          <a href="LoginUser.php"><button class="abtn" name='Login'>LOGIN</button>  </a>
   
        <?php  }
        ?>


        </p>
    </div>
    <div class="disp">
        <img src="IMAGE/banner.png" alt="">
      </div>
      <form action="Search.php" method='post'>

      <div class="search">
        <p>
            FIND THE ROOM 
        </p>
        <p>TYPE  <select name="type" id="type">
        <option value="SELECT">SELECT</option>
        <option value="SINGLE">Single</option>
        <option value="SHARED">Shared</option>
        <option value="TRIPLE">Triple</option>
        <option value="FAMILY">Family</option>
        <option value="FLAT">Flat</option>
        </select> 
      </p>
        <p>PRICE  <select name="price" id="price">
            <option value="Price">Range</option>
            <option value="Below 1000">Below RS1000</option>
            <option value="1000">RS 1000</option>
            <option value="2000">RS 2000</option>
            <option value="3000">RS 3000</option>
            <option value="4000">RS 4000</option>
            <option value="5000">RS 5000</option>
            <option value="6000">RS 6000</option>
            <option value="7000">RS 7000</option>
            <option value="8000">RS 8000</option>
            <option value="9000">RS 9000</option>
            <option value="10000">RS 10000</option>
            <option value="Above 10000">Above RS10000</option>
            </select>
         </p>

        <p>LOCATION
            <input type='text' name='location'>
      </p>
      <p>
          <input type="submit" value="Explore Rooms" name="search">
      </div>
        </form>


<div class="container">
    <?php 

if ($data) {
    while ($temp = mysqli_fetch_assoc($data)) {
        ?>
            <div class="box">
                <div class="img">
                <?php if (!empty($temp['image'])): ?>
                    <img src="<?php  echo $temp['image']; ?> ">
                    <?php endif; ?>
                </div>
                <div class="detail">
                    <?php if (!empty($temp['type'])): ?>
                        <p class="title"><?php echo $temp['type']; ?></p>
                    <?php endif; ?>
                    <?php if (!empty($temp['price'])): ?>
                        <p class="price">price: Rs <?php echo $temp['price']; ?></p>
                    <?php endif; ?>
                    <div class="btn">
                        <?php 
                        if($temp['availability'] == 'yes' || $temp['availability'] == 'Yes'){ 
                            ?>
                            <a href="enquire.php?id=<?php echo $temp['roomno']; ?>"><button>Enquire</button></a>
                            <a href="LoginT.php?id=<?php echo $temp['roomno']; ?>"><button>Book</button></a>

                            <?php 
                        }else{ ?>
                            <a href="enquire.php?id=<?php echo $temp['roomno']; ?>"><button>Enquire</button></a>
                            <a><button class='ebooked'>Booked</button></a>
                            <?php

                        }
                        ?>


                   

                        <!-- <a href="enquire.html"><button>Enquire</button></a>
                        <a href="new.html"><button>Book</button></a> -->
                    </div>
                </div>
            </div>

        <?php
    }
} else {
    echo "Error executing the query: " . mysqli_error($conn);
}
?>
 </div>


    
</body>
</html>