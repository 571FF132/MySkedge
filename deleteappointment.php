<?

session_start();
require_once('Dao.php');
if (isset($_SESSION['access_granted']) && !$_SESSION['access_granted']
     || !isset($_SESSION['access_granted'])) {

      $_SESSION['sentiment'] = "bad";
      $_SESSION['messages'][0] = "Don't do that, bro. That's messed up. Login first.";
      header("Location:login.php");
      exit;
}else{
	$dao = new Dao();
	$bid = $_GET['bid'];
	$dao->deleteCXappointment($bid);
	header("Location:dashboard.php");
      	exit;
}
exit;
