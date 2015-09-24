<?php 

include('config.php');

include_once('classes/db.php');
$objDb = new db();
//$objDb->createConn();

include_once('classes/url.php');
$objUrl = new url();

if (isset($_GET['url']) && trim($_GET['url'])!="") { //This uis coming from .htaccess file.
	$redirect = $objUrl->getRedirectUrl($_GET['url']);
	header('HTTP/1.1 301 Moved Permanently');  
	header("Location: ".$redirect);  
}
if (isset($_POST['url']) && trim($_POST['url'])!="") {
	$redirect = $objUrl->setRedirectUrl($_POST['url']);
	header('Location: '.$redirect);
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Short URLs</title>
<style type="text/css">
</style>
</head>

<body>

URL to shorten:

<form id="frm_short_url" name="frm_short_url" method="post">
  <input type="text" id="url" name="url" />
  <input type="submit" name="Submit" value="Go" />
</form>


<?php if (!empty($_GET['s'])) { ?>
<br />
Shortened URL: <a href="<?php echo SERVER_NAME.trim(dirname($_SERVER['REQUEST_URI']),'/').'/'; ?><?php echo $_GET['s']; ?>" target="_blank"><?php echo SERVER_NAME.trim(dirname($_SERVER['REQUEST_URI']),'/').'/'; ?><?php echo $_GET['s']; ?></a>
<?php } ?>

</body>
</html>
