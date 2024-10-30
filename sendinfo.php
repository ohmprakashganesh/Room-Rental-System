<?php
session_start();
  if(isset($_POST['email'])){
    $email = $_POST['email'];
    $to = $email;
    $subject = 'Information';
    $content = 'Hey, its CHHAANO';
    $headers = "";
    if (mail($to, $subject, $content, $headers)) {
            $_SESSION['mail']=$email;
            header("Location: InformationSend.php");
        }
}
?>