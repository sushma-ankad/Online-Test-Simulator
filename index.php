<?php require_once('Connections/testsimule.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "register")) {
  $insertSQL = sprintf("INSERT INTO users (name, USN, Sem, Department) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['name'], "text"),
                       GetSQLValueString($_POST['USN'], "text"),
                       GetSQLValueString($_POST['Sem'], "int"),
                       GetSQLValueString($_POST['Department'], "text"));

  mysql_select_db($database_testsimule, $testsimule);
  $Result1 = mysql_query($insertSQL, $testsimule) or die(mysql_error());
  
  $insertGoTo = "regsuccess.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_login"])) && ($_POST["MM_login"] == "login")) {
  $insertSQL = sprintf("SELECT * FROM users WHERE USN = %s AND Sem = %s",
                       GetSQLValueString($_POST['USN'], "text"),
                       GetSQLValueString($_POST['Sem'], "int"));

  mysql_select_db($database_testsimule, $testsimule);
  $Result1 = mysql_query($insertSQL, $testsimule) or die(mysql_error());
  $totalRows_Result = mysql_num_rows($Result1);
  if ( $totalRows_Result > 0) {
	  $cookie_name="USN";
	  $cookie_value=$_POST['USN'];
	  setcookie($cookie_name,$cookie_value,time()+(86400*30),"/");
  
	  $insertGoTo = "questions.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
    	$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    	$insertGoTo .= $_SERVER['QUERY_STRING'];
  	}
  	header(sprintf("Location: %s", $insertGoTo));
  } else {
	  $insertGoTo = "loginfailed.php";
	  if (isset($_SERVER['QUERY_STRING'])) {
    	$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    	$insertGoTo .= $_SERVER['QUERY_STRING'];
  	}
  	header(sprintf("Location: %s", $insertGoTo));
  }
}


mysql_select_db($database_testsimule, $testsimule);
$query_Insert = "SELECT * FROM users";
$Insert = mysql_query($query_Insert, $testsimule) or die(mysql_error());
$row_Insert = mysql_fetch_assoc($Insert);
$totalRows_Insert = mysql_num_rows($Insert);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Home</title>
</head>

<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Untitled Document</title>
<link href="boilerplate.css" rel="stylesheet" type="text/css">
<link href="file:///C|/xampp/htdocs/testsimulation/testsimule.css" rel="stylesheet" type="text/css">
<link href="css/test.css" rel="stylesheet" type="text/css"/>
<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

Do the following if you're using your customized build of modernizr (http://www.modernizr.com/):
* insert the link to your js here
* remove the link below to the html5shiv
* add the "no-js" class to the html tags at the top
* you can also remove the link to respond.min.js if you included the MQ Polyfill in your modernizr build 
-->
<!--[if lt IE 9]>
<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="respond.min.js"></script>

</head>
<body>
	<div class="gridContainer clearfix">
		<div id="LayoutDiv1">
        <div id="Holder">
        	<div id="HeaderContainer">
          		 <div id="Header">
                 	<h1>Test Simule!!</h1>
           		 </div>
           		<div id="Nav">
           		</div>
           	</div>
           <div id="Content">
           
           	<div id="ContentLeft">
	           <h1>Register</h1>
	           <form name="register" action="<?php echo $editFormAction; ?>" method="POST" id="register" style="margin:5px 0 0 20%">
	           <p><span>Name</span><input type="text" name="name" id="name" required placeholder="Ex: John Smith"/></p><br />
	           <p><span>USN</span><input type="text" name="USN" id="USN" required placeholder="Ex: 2BA14IS056" onchange="chkusn();"/></p><br />
	           <p><span>Semester</span><input type="text" name="Sem" id="Sem" required placeholder="Ex: 6" onchange="chksem();"/></p><br />
   		       <p><span>Department</span><!--<input type="text" name="dept" id="dept" required="required" placeholder="Ex: ISE"/>-->
        	   <select name="Department"><option value="AU">AU</option><option value="ISE">ISE</option><option value="CSE">CSE</option>
            	                         <option value="MECH">MECH</option><option value="CIVIL">CIVIL</option><option value="EEE">EEE</option>
                	                     <option value="ECE">ECE</option><option value="EI">EI</option>
                    	                 <option value="BT">BT</option></select></p><br />
            	<p><span>&nbsp;</span><input type="submit" class="submit" name="submit" id="submit" value="Register"/></p>
            	<input type="hidden" name="MM_insert" value="register">
           		</form>
          	</div>
            
            <div id="ContentRight">
            	 <h1>Login</h1>
	           <form name="login" action="<?php echo $loginFormAction; ?>" method="POST" id="register"  style="margin:5px 0 0 20%">
	           <p><span>USN</span><input type="text" name="USN" id="USN1" required placeholder="Ex: 2BA14IS056" onchange="chkusn1();"/></p><br />
	           <p><span>Semester</span><input type="text" name="Sem" id="Sem1" required placeholder="Ex: 6" onchange="chksem1();"/></p><br />
            	<p><span>&nbsp;</span><input type="submit" class="submit" name="submit" id="submit" value="Login"/></p>
            	<input type="hidden" name="MM_login" value="login">
           		</form>
            </div>
          </div>
           <div id="Footer">
           </div>
       </div>
        </div>
	</div>
    
    <script src="js/valid.js"></script>
        <script src="js/valid1.js"></script>

</body>
</html>
<?php
mysql_free_result($Insert);
?>
