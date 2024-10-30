<?php

if (isset($_POST['search'])) {
    include 'Conn.php';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : 'Selectt';
    $location = isset($_POST['location']) ? $_POST['location'] : '';

    if ($type === 'Selectt') {
        $error = "Please select a valid room type.";
    } else {
        $type = $conn->real_escape_string($type);
        $location = $conn->real_escape_string($location);

        $sql = "SELECT * FROM rooms WHERE type='$type'";

        if ($price !== 'Price') {
            if ($price == 'Below 1000') {
                $sql .= " AND price < 1000 ";
            } elseif ($price == 'Above 10000') {
                $price = intval($price);
                $sql .= " AND price > 10000 ";
            } else {
                $price = intval($price);
                $sql .= " AND price BETWEEN $price AND " . ($price + 999);
            }
        }

        if (!empty($location)) {
            $sql .= " AND location LIKE '%$location%' ";
        }
          $result=mysqli_query($conn,$sql);
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Page Title</title>
    <link rel="stylesheet" href="CSS/nextcard.css">
    <link rel="stylesheet" href="CSS/final.css">

 

</head>
<body>
    <div class="top">
        <p>
            <img src="IMAGE/logo_transparent.png" alt="">
        </p>
        <nav>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Rooms</a></li>
                <li><a href="#">Contact</a></li>
                <li><a class="menu" href="#">Menu</a></li>
            </ul>
        </nav>
        <p>
            <a href="login.php"><button class="abtn" name='Login'>Log In</button></a>
        </p>
    </div>
    <div class="disp">
        <img src="IMAGE/logo_transparent.png" alt="">
    </div>
    <form action="#" method="post" onsubmit="return validate()">
        <div class="error"></div>
        <div class="search">
            <p>FIND THE ROOM </p>
            <p>TYPE</p>
            <select name="type" id="type">
                <option value="Selectt">SELECT</option>
                <option value="SINGLE">Single</option>
                <option value="SHARED">Shared</option>
                <option value="TRIPLE">Triple</option>
                <option value="FAMILY">Family</option>
                <option value="FLAT">Flat</option>
            </select>
            <p>PRICE</p>
            <select name="price" id="price">
                <option value="Price">Range</option>
                <option value="Below 1000">Below RS 1000</option>
                <option value="1000">RS 1000</option>
                <option value="2000">RS 2000</option>
                <option value="3000">RS 3000</option>
                <option value="4000">RS 4000</option>
                <option value="5000">RS 5000</option>
                <option value="6000">RS 6000</option>
                <option value="7000">RS 7000</option>
                <option value="8000">RS 8000</option>
                <option value="9000">RS 9000</option>
                <option value="Above 10000">Above RS 10000</option>
            </select>
            <p>LOCATION
                <input type='text' name='location'>
            </p>
            <div>
                <input type="submit" value="Explore Rooms" name="search">
            </div>
        </div>
    </form>

    <div class="container">
    <?php

                // if ($result->num_rows > 0) {
                //     echo "<td>";
                //     echo "<div class='container'>";
                //     echo "<div class='one'>";
                //     while ($row = $result->fetch_assoc()) {
                //         echo "<div class='img'>";
                //         echo "<img src='data:image/jpeg;base64," . base64_encode($row['image']) . "'>";
                //         echo "</div>";
                //         echo "<div class='detail'>";
                //         echo "<p class='title'>";
                //         echo $row['type'] . " ROOM </p>";
                //         echo "<p class='dtl'>";
                //         echo $row['description'] . "<br>";
                //         echo "</p>";
                //         echo "<p class='price'>";
                //         echo 'RS ' . $row['price'] . "<br>";
                //         echo "</p>";
                //         echo "</div>";
                //         echo "<div class='btn'>";
                //         echo "<a href='enquire.php?id=" . $row['roomno'] . "'> <button class='child_btn'>Enquire</button></a>";
                //         echo "<a href='LoginT.php?id=" . $row['roomno'] . "'> <button class='child_btn'>Book</button></a>";
                //         echo "</div>";
                //     }
                //     echo "</div>";
                //     echo "</div>";
                //     echo "</td>";
                // }

               
            
            

     if ( isset($result) && $result->num_rows> 0)
    while ($temp = mysqli_fetch_assoc($result)) {
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
                    <a href="enquire.php?id=1"> <button class="child_btn">Enquire</button></a>
                      <a href="LoginT.php?id=1"> <button class="child_btn">Book</button></a>
                    </div>
                </div>
            </div>

        <?php
    }
       
    ?>

       <div class="empty"><?php if(isset($error)) echo $error?></div>
     
    </div>
    <script>
        function validate(){
            if(document.getElementById('type').value=='Selectt'){
                document.querySelector('.error').innerHTML='Type must be specified';
                return false;
            }
        }
    </script>
</body>
</html>
