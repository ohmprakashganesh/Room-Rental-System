<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chhaano - Room Renting System</title>
  <link rel="stylesheet" href="CSS/style1.css">
</head>
<body>
  <div class="top">
    <p>
      <img src="IMAGE/logo.png" alt="Chhaano Logo">
    </p>
    <nav>
      <ul>
        <li><a href="Home.php">Home</a></li>
        <li><a href="#">Rooms</a></li>
        <li><a href="#Contacts">Contact</a></li>
        <li><a class="nmenu" href="#">Menu</a></li>
       
      </ul>
    </nav>
    <p>
      <a href="signup.php"><button class="abtn" name='Login'>SIGN UP</button></a>
    </p>
  </div>
  <div id="main-content">
    <div class="introduction">
      <div>FEELS LIKE HOME</div>
      <h2>CHHAANO</h2>
    </div>
    <div class="samples">
      <div class="sample1">
        <div>
          <div class="image" id="1">
            <p>
              <img src="IMAGE/dark.PNG" alt="Sample Image 1" srcset="">
              <img src="IMAGE/eight.jpg" alt="Sample Image 2" srcset="">
            </p>
          </div>
          <div class="image" id="2">
            <p>
              <img src="IMAGE/four.PNG" alt="Sample Image 3" srcset="">
              <img src="IMAGE/five.jpg" alt="Sample Image 4" srcset="">
            </p>
          </div>
        </div>
        <div id="part-2">
          <h2>Let's Find You</h2>
          <h2>A Perfect Place to Live</h2>
          <form action="Search.php" method="post">
            <div class="dropdown">
              <div class="select">
                <span class="selected">SEARCH CATEGORIES</span>
                <div class="caret"></div>
              </div>
              <ul class="menu" name='type'>
                <li value='SINGLE'>SINGLE</li>
                <li value='SHARED'>SHARED</li>
                <li value='TRIPLE'>TRIPLE</li>
                <li value='FAMILY'>FAMILY</li>
                <li value='FLAT'>FLAT</li>
              </ul>
              <input type="hidden" name="type" id="dropdown1">
            </div>
            <div class="button">
                <button type="submit" class='search-btn' name='search'>Search</button>
            </div>
          </form>
        </div>
      </div>
      <div class="sample2">
  <div class="option">
    <div class="desc">
      <h3>Need A Room?</h3>
      <p>Here!</p>
      <p>Room listings specifically for individuals actively seeking accommodations.</p>
    </div>
    <div>
      <a href="Dashboard.php"><button type="submit" class="btn">Find a Room?</button></a>
    </div>
  </div>
  <div class="option">
    <div class="desc">
      <h3>Got A Room For Rent?</h3>
      <p>Here!</p>
      <p>Be amazed at the response rate - rent your room within days</p>
    </div>
    <div>
      <a href="AddLandlord.php"><button type="submit" class="btn">Rent your Room?</button></a>
    </div>
  </div>
</div>
    </div>
  </div>
  <div id="additional-content1">
  <div class="additional-content">
    <div class="features">
      <h2>Key Features</h2>
        <div class="list">
          <button class='info-btn'>Advanced search filters to find the perfect room</button>
          <button class='info-btn'>Real-time availability updates</button>
          <button class='info-btn'>Secure and convenient online booking</button>
          <button class='info-btn'>User reviews and ratings for each room</button>
        </div>
    </div>
  </div>
    <div class="testimonials">
      <h2>What Our Customers Say</h2>
      <div class="testimonial">
        <div class="testimonial-image">
          <img src="IMAGE/1.jpg" alt="User 1">
        </div>
        <div class="testimonial-content">
          <p>"Chhaano made it incredibly easy for me to find a suitable room within my budget. The search filters were really helpful, and the booking process was seamless. Highly recommended!"</p>
          <p class="testimonial-author">- Anne Johnson</p>
        </div>
      </div>
      <div class="testimonial">
        <div class="testimonial-image">
          <img src="IMAGE/2.jpg" alt="User 2">
        </div>
        <div class="testimonial-content">
          <p>"I had a great experience using Chhaano to rent out my spare room. The platform connected me with reliable tenants, and I found the entire process efficient and hassle-free."</p>
          <p class="testimonial-author">- Riya Smith</p>
        </div>
      </div>
    </div>
    </div>
    <div id="additional-content2">
    <div class="additional-heading">
      <h2>Explore Our Services</h2>
    </div>
    <div class="additional-content">
      <div class="services">
        <h3>Our Services</h3>
        <p>At Chhaano, we provide a range of services to ensure a seamless and convenient experience for our users:</p>
        <div class='list'>
          <button class='info-btn'>Room search and listing service</button>
          <button class='info-btn'>Secure online booking and payment system</button>
          <button class='info-btn'>Real-time availability updates</button>
          <button class='info-btn'>User reviews and ratings for rooms and landlords</button>
          <button class='info-btn'>Responsive customer support</button>
          <button class='info-btn'>Helpful resources and guides for renters and landlords</button>
        </div>
      </div>
      <div class='gap'></div>
      <div class="services">
        <h3>Why Choose Chhaano?</h3>
        <p>Here are some reasons why Chhaano is the preferred choice for room renting:</p>
        <div class="list">
          <button class='info-btn'>Wide selection of rooms in various locations</button>
          <button class='info-btn'>Advanced search filters to find the perfect room</button>
          <button class='info-btn'>Verified room listings and reliable landlords</button>
          <button class='info-btn'>Transparent pricing and no hidden fees</button>
          <button class='info-btn'>User-friendly platform with intuitive interface</button>
          <button class='info-btn'>Secure and hassle-free booking process</button>
        </div>
      </div>
    </div>
  </div>
  <footer id='Contacts'>
  <button type="submit" onclick="showMessage();"class='display-btn'>Receive Email</button>
  <div class="subscribe" id="contact">
        <h3>Want to know more about us?</h3>
        <form action="sendinfo.php" method="post" name='myform'>
        <div class="input flex" id='email'>
          <input type="email" placeholder="Email address" name='email'>
          <p class="formerror"></p>
          <a href="sendinfo.php">
            <button class="flex1 abtn" onclick="return validation()">
            Enter<i class="fas fa-arrow-circle-right"></i>
            </button>
          </a>
        </div>
        </form>
      </div>
      <hr>
  <div class="container">
      <div class='gap'></div>
      <div class="content grid">
        <div class="box">
          <div class="logo">
            <img src="IMAGE/logo_transparent.png" alt="" height="200px">
          </div>
          <div class="social flex">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram"></i>
            <i class="fab fa-youtube"></i>
          </div>
        </div>

        <div class="box center-align">
          <h3>Quick Links</h3>
          <ul>
            <li><i class="fas fa-angle-double-right"></i>Big Data</li>
            <li><i class="fas fa-angle-double-right"></i>Wellness</li>
            <li><i class="fas fa-angle-double-right"></i>Spa Gallery</li>
            <li><i class="fas fa-angle-double-right"></i>Reservation</li>
            <li><i class="fas fa-angle-double-right"></i>FAQ</li>
            <li><i class="fas fa-angle-double-right"></i>Contact</li>
          </ul>
        </div>
        <div class="box center-align">
          <h3>Quick Links</h3>
          <ul>
            <li><i class="fas fa-angle-double-right"></i>Restaurent</li>
            <li><i class="fas fa-angle-double-right"></i>Wellness</li>
            <li><i class="fas fa-angle-double-right"></i>Spa Gallery</li>
            <li><i class="fas fa-angle-double-right"></i>Reservation</li>
            <li><i class="fas fa-angle-double-right"></i>FAQ</li>
            <li><i class="fas fa-angle-double-right"></i>Contact</li>
          </ul>
        </div>
        <div class="box right-align">
          <h3>Services</h3>
          <div class="icon flex">
            <div class="i">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="text">
              <h4>Address</h4>
              <p>Jhapa, Nepal</p>
            </div>
          </div>
          <div class="icon flex">
            <div class="i">
              <i class="fas fa-phone"></i>
            </div>
            <div class="text">
              <h4>Phone</h4>
              <p>+977 9876543210</p>
            </div>
          </div>
          <div class="icon flex">
            <div class="i">
              <i class="far fa-envelope"></i>
            </div>
            <div class="text">
              <h4>Email</h4>
              <p>teamchhaano@gmail.com</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  <div class="footer-bottom">
    <p>&copy; 2023 Chhaano - Room Renting System. All rights reserved.</p>
  </div>
</footer>
  <script>
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach((dropdown, index) => {
      const select = dropdown.querySelector('.select');
      const caret = dropdown.querySelector('.caret');
      const menu = dropdown.querySelector('.menu');
      const options = dropdown.querySelectorAll('.menu li');
      const selected = dropdown.querySelector('.selected');
      const hiddenInput = dropdown.querySelector(`#dropdown${index + 1}`);

      select.addEventListener('click', () => {
        dropdowns.forEach((dropdown) => {
          dropdown.querySelector('.menu').classList.remove('menu-open');
          dropdown.querySelector('.select').classList.remove('select-clicked');
          dropdown.querySelector('.caret').classList.remove('caret-rotate');
        });

        select.classList.toggle('select-clicked');
        caret.classList.toggle('caret-rotate');
        menu.classList.toggle('menu-open');
      });

      options.forEach(option => {
        option.addEventListener('click', () => {
          selected.innerText = option.innerText;
          hiddenInput.value = option.getAttribute('value');
          select.classList.remove('select-clicked');
          caret.classList.remove('caret-rotate');
          menu.classList.remove('menu-open');
          options.forEach(option => {
            option.classList.remove('active');
          });
          option.classList.add('active');
        });
      });
    });
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
    function validation(){
        var returnval=true;
        clearerr();
        var email = document.forms['myform']['email'].value;
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
        return returnval;
    }
  function clearError(id) {
  seterror(id, '');
}
document.forms['myform']['email'].addEventListener('input', function() {
  clearError('email');
});
function showMessage() {
  var button=document.querySelector('tog-button');
  var elements = document.querySelectorAll('.subscribe');
  elements.forEach(function(element) {
    if (element.style.display === 'block') {
      element.style.display = 'none';
    } else {
      element.style.display = 'block';
    }
  });
}
</script>
</body>
</html>
