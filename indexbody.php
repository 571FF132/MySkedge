<div class="carousel-wrapper">
  <div id="img-carousel">
  <img class="main-carousel" src="/images/barbershop.jpg">
  <img class="main-carousel" src="/images/nailsalon.jpg">
  <img class="main-carousel" src="/images/calendar.png">
  <span class="about">
    <p> With MySkedge you can schedule and manage appointments with customers and clients from anywhere. Customers and clients will have an easy and convenient way to schedule appointments with you.</p>
  </span>
  <span class="carousel-login-button>
    <?php
    if (isset($_SESSION["access-granted"]) && $_SESSION["access-granted"]){
      echo "<a href='dashboard.php'>Get Started</a>"
    } else {
      echo "<a href='login.php'>Sign up now! It is 100% NOT free!</a>"
    }
    ?>
  </span>
  </div>
</div>
