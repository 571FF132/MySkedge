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
    <li>
      <img class="main-carousel" src="/images/business-meeting.jpg">
    </li>
    <li>
      <img class="main-carousel" src="/images/coffee-meeting.jpg">
    </li>
  </ul>
  <span class="about">
    <p> With MySkedge you can schedule and manage appointments.</p>
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
