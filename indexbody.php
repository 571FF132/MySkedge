<div class="carousel-wrapper">
  <div class="jcarousel">
  <ul>
    <li>
      <img class="main-carousel" src="/images/barbershop.jpg">
    </li>
    <li>
      <img class="main-carousel" src="/images/nailsalon.jpg">
    </li>
    <li>
      <img class="main-carousel" src="/images/calendar.png">
    </li>

  </ul>
  <span class="about">
    <p> With MySkedge you can schedule and manage appointments with customers and clients from anywhere. Customers and clients will have an easy and convenient way to schedule appointments with you.</p>
    <?php
    if (isset($_SESSION['access_granted']) && $_SESSION['access_granted']){
      echo "<a href='dashboard.php'>Get Started</a>";
    } else {
      echo "<a href='login.php'>Sign up now! It is 100% NOT free!</a>";
    }
    ?>
   
  </span>
  </div>
</div>
