<?php 
$cookie_name="USN";
//$cookie_value="John Deo";
//setcookie($cookie_name,$cookie_value,time()+(86400*30),"/");

?>
<?php
if(!isset($_COOKIE[$cookie_name]))
{
	echo "cookie named:".$cookie_name."is not set!";
}
else
{
	echo "cookie:".$cookie_name."is set!<br>";
	echo "value is:".$_COOKIE[$cookie_name];
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>