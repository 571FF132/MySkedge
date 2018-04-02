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
	$eid = $_GET['eid'];
	$cid = $_GET['cid'];
	/*$ts = $_GET['ts'];
	$te = $_GET['te'];
        */
	$ts = date('Y-m-d G:i:s', strtotime($_GET['ts']));
	$te = date('Y-m-d G:i:s', strtotime($_GET['te']));
	$dao->deleteCXappointment($bid, $eid, $cid, $ts, $te);
	header("Location:dashboard.php");
      	exit;
}
exit;
