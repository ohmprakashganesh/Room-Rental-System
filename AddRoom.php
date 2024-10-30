<?php
 include 'Conn.php';
ini_set('mysql_connect_timeout',300);
ini_set('default_socket_timeout',300);

session_start();
if (isset($_SESSION['uid'])) {
    $email = $_SESSION['uid'];
   
} else {
    header("Location: login.php");
}
 $sql1 = "SELECT * FROM landlord WHERE lemail='$email'";
    $exe=mysqli_query($conn,$sql1);
    $row = mysqli_fetch_assoc($exe);
    $id=$row['lid'];


if (isset($_POST['submit']) && isset($_FILES['image'])) {
    include 'Conn.php';
    $type = trim($_POST['type']);
    $price = trim($_POST['price']);
    $location = trim($_POST['location']);
    $description = trim($_POST['description']);

    $sql2 = "SELECT * FROM landlord WHERE lemail='$email'";
    $result = $conn->query($sql2);
    $row = $result->fetch_assoc();
    $id = $row['lid'];

    $image = $_FILES['image'];
    $imagename = $image['name'];
    $imagefiletemp = $image['tmp_name'];

    $filename_seprate = explode('.', $imagename);
    $file_extension = strtolower(end($filename_seprate));

    $allowed_extensions = array('jpg', 'png', 'jpeg');
    if (in_array($file_extension, $allowed_extensions)) {
        $upload_directory = 'upload/';
        $upload_image = $upload_directory . basename($imagename);

        if (move_uploaded_file($imagefiletemp, $upload_image)) {
            $sql3 = "INSERT INTO rooms (type, price, location, lid,availability, description, image) VALUES ('$type', '$price', '$location', '$id','yes', '$description', '$upload_image')";
            if ($conn->query($sql3)) {
                header("Location: SuccessPage.php");
                exit;
            } else {
                echo 'Error: ' . $conn->error;
            }
        } else {
            echo 'Error: Failed to move the uploaded file.';
        }
    } else {
        echo 'Error: Invalid file extension. Only JPG, PNG, and JPEG files are allowed.';
    }
}
?>


<?php 
    // $image = file_get_contents($_FILES['image']['tmp_name']);
    // $image = mysqli_real_escape_string($conn, $image);

    // $sql3 = "INSERT INTO rooms (type, price, location, lid, description, image) VALUES ('$type', '$price', '$location', $id, '$description', '$image')";
    // if($conn->query($sql3)){
    //     header("Location: SuccessPage.php");
    //     exit;
    // }
    // else{
    //     echo 'Error'.$conn->error;
    // }
// 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=f, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='CSS/Registration.css'>
</head>
<body>
    <div id="main-container">
        <fieldset>
            <legend>Room-Details</legend>
            <div id="form-Box">
                <table>
                    <form action="#" method="post" enctype="multipart/form-data">
                        <div id="error2" class="error">
                            <?php
                            if (isset($_GET['error'])) {
                                echo "Landlord not registered yet.";
                            }
                            ?>
                        </div>
                        <tr>
                            <div id="input-email" class="input-data">
                                <td><input type="email" name="email" id="email" placeholder="Registered Email"
                                value="<?php if(isset($email)) echo $email;?>
                                " disabled></td>
                            </div>
                        </tr>
                        <tr>
                            <div id="input-type" class="input-data">
                                <td>
                                    <select name="type" id="type">
                                        <option value="Select">Select Type</option>
                                        <option value="SINGLE">Single</option>
                                        <option value="SHARED">Shared</option>
                                        <option value="TRIPLE">Triple</option>
                                        <option value="FAMILY">Family</option>
                                        <option value="FLAT">Flat</option>
                                    </select>
                                </td>
                            </div>
                            <div id="input-price" class="input-data">
                                <td><input type="text" name="price" id="price"placeholder="Price per Month"></td>
                            </div>
                        </tr>
                        <tr>
                            <div id="input-location" class="input-data">
                                <td><input type="text" name="location" id="location" placeholder="Location"></td>
                            </div>
                            <div id="input-image" class="input-data">
                                <td><input type="file" name="image" id="image"></td>
                            </div>
                        </tr>
                        <tr>
                            <div id="input-description" class="input-data">
                                <td colspan="2" align="center"><textarea name="description" id="description" cols="85" rows="10"></textarea></td>
                            </div>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><button type="submit" name='submit' onclick="return regValidation()">REGISTER</button></td>
                        </tr>
                        <tr>
                            <td colspan="2"><a href="AddLandlord.php?temp=<?php echo '200'?>">Not Registered a Landlord yet?</a></td>
                        </tr> 
                    </form>
                </table>
            </div>
        </fieldset>
    </div>
</body>
<script>
function regValidation() {
  var type = document.getElementById('type');
  var price = document.getElementById('price');
  var email = document.getElementById('email');
  var location = document.getElementById('location');
  var description = document.getElementById('description');
  var picture = document.getElementById('image');
  var error2 = document.getElementById('error2');
  error2.innerHTML = '';
  if (email.value.trim() === '') {
    error2.innerHTML = 'Please enter your Email Address';
    email.focus();
    return false;
  }
  if (location.value.trim() === '') {
    error2.innerHTML = 'Please enter the Location';
    location.focus();
    return false;
  }
  if (!/^[A-Za-z\s\-'.,]{2,}$/.test(location.value.trim())) {
    error2.innerHTML = 'Please enter a valid Location';
    location.focus();
    return false;
  }
  if (location.value.trim().length > 20) {
    error2.innerHTML = 'Location Limit(20) Exceeded';
    location.focus();
    return false;
  }

  if (price.value.trim() === '') {
    error2.innerHTML = 'Please enter the Price';
    price.focus();
    return false;
  }

  if (type.value === 'select') {
    error2.innerHTML = 'Please select the Type of Room';
    return false;
  }
  var allowedExtensions = ['.jpg', '.jpeg', '.png'];
  var fileExtension = picture.value.substring(picture.value.lastIndexOf('.')).toLowerCase();
  var maxSizeInBytes = 40*1024*1024;
  if (picture.value.trim() === '') {
  error2.innerHTML = 'Please insert a picture';
  return false;
}
else{
    var fileSizeInBytes = picture.files[0].size;
}
if (!allowedExtensions.includes(fileExtension)) {
  error2.innerHTML = 'Picture Format ' + allowedExtensions.join(', ') + ' required';
  return false;
}
if (fileSizeInBytes > maxSizeInBytes) {
  error2.innerHTML = 'File size exceeds the maximum limit of 40MiB.';
  return false;
}
if (description.value.trim().length <10|| description.value.trim().length >300) {
    error2.innerHTML = 'Please select the description of Room within(10-300) Characters';
    return false;
  }

    return true;
}  
</script>
</html>
