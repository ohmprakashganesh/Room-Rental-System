<?php
if(!isset($_SESSION['uid'])){
    header('Location:LoginT.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/book.css">
</head>

<body>


    <div id="bcontainer">
        <div id="bformbox">
            <h4><span onclick="close()">&times</span><p>Input your details </p></h4>
            <form action="#" name="myform" onsubmit="return validateform()" method="post">
                    <div class="formdesign" id="name">
                        <input type="text" name="username" placeholder="Enter your name">
                        <p class="formerror"></p>
                    </div>
                    <div class="formdesign" id="email">
                        <input type="text" name="femail" placeholder="Enter Email Address">
                        <p class="formerror"></p>
                    </div>
                    <div class="formdesign" id="phone">
                        <input type="text" name="fphone" placeholder="Enter phone number">
                        <p class="formerror"></p>
                    </div>
                    <div class="formdesign" id="address">
                        <input type="text" name="faddress" placeholder="Enter address">
                        <p class="formerror"></p>
                    </div>
                    <div class="btn">
                    <div><input type="submit" class="btnn"  value="Book "></div>
                    </div>
                </form>
        </div>
    </div>
    <div id="om"><button  onclick="run()">drop</button></div>
</body>
<script>
    function seterror(id,error){
    var ele=document.getElementById(id);
    ele.getElementsByClassName("formerror")[0].innerHTML=error;
    }
   function clearerr(){
    errors=document.getElementsByClassName('formerror');
    for(let item of errors){
        item.innerHTML= ""; 
     }
    }
     function validateform(){ 
        //console.log('clicked');
        var returnval=true;
        clearerr();
        var name = document.forms['myform']['username'].value.trim();
        var email = document.forms['myform']['femail'].value.trim();
        var phone = document.forms['myform']['fphone'].value.trim();
        var address = document.forms['myform']['faddress'].value.trim();

        if(name== ""){
            seterror("name","*Required");
            returnval= false;
        }else{
            if(name.length>30){
            seterror("name","Limit(30) Exceeded")
            returnval=false;
            }
           if (!/^[A-Za-z\s.'-]+$/.test(name)) {
           seterror("name","*Invalid Name")
           returnval= false;
        }
        }
       
        if(email== ""){
            seterror("email","*Required");
            returnval= false;
        }
        else{
          if(!/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(email)){
          seterror("email","*Invalid Email");
          returnval=false;
        }
       }
        if (address=== '') {
        seterror("address","*Required");
        returnval= false;
       }else{
        if (!/^[A-Za-z\s\-'.,]{2,}$/.test(address)) {
         seterror("address","*Invalid Address");
         returnval= false;
       }
       if (address.length > 20) {
          seterror("address","Location Limit(20) Exceeded");
          returnval= false;
        }
       }
       if (phone === '') {
        seterror("phone","*Required");
           returnval= false;
       }
       else{
        if (!/^(?:\+977|0)?[1-9]\d{9}$/.test(phone)) {
        error1.innerHTML = 'Please enter a valid Phone Number';
        returnval= false;
       }
       }
        return returnval;
    }
</script>
</body>
</html>