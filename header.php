<html>
<head>
    	<title>MySkedge</title>
	<link href="https://fonts.googleapis.com/css?family=Martel|Nova+Mono|Sarina|Shrikhand" rel="stylesheet">
    	<link rel="stylesheet" href="/css/style.css">
	<script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="/js/jquery.jcarousel.min.js"></script>
        <script type="text/javascript" src="/js/script.js"></script>  
	<script type="text/javascript" src="/js/ajax.js"></script>
</head>
<body>
    	<div id="navigation">
    	<span class="navigation-item" id="navigation-home">
      		<a href="index.php">
       			<img id="brand" src="/images/MySkedgeLogo256x256.png" alt="MySkedge.com">
  		</a>
    	</span>
    	<span class ="navigation-item" id="navigation-links">
    	<ul>
			<?php
			if (isset($_SESSION['access_granted']) && $_SESSION['access_granted']) {
			echo "<li><a href='dashboard.php'>MySkedge!</a></li>";
  			echo "<li><a href='logout.php'>L0G0UT</a></li>";
			}else{		
			echo "<li><a href='login.php'>L0G1N</a></li>";
			}
			?>
    	</ul>
    	</span> 
    	</div>

