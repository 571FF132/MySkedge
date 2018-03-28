<html>
<head>
    	<title>MySkedge</title>
    	<link rel="stylesheet" href="/css/style.css">
	<script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="/js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="/js/script.js"></script>  
</head>
<body>
    	<div id="navigation">
    	<span class="navigation-item" id="navigation-home">
      		<a href="index.php">
       			<img id="brand" src="/images/MySkedgeLogo256x256.png" alt="MySkedge.com">
  		</a>
    	</span>
    	<span class ="navigation-item" id="navigation-links>
    	<ul id=navigation-links-list">
      		<li class="navigation-item">
			/*<?php
			if (isset($_SESSION["access_granted"]) && $_SESSION["access_granted"]) {
  			echo "<a href='logout.php'>L0G0UT</a>";
			}else{		
			echo "<a href='login.php'>L0G1N</a>";
			}
			?>*/
			<a href='login.php'>Login</a>
      		</li>
    	</ul>
    	</span> 
    	</div>

