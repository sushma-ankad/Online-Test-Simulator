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
mysql_select_db($database_testsimule,$testsimule);
$total=0;
$cookie_name="USN";

foreach ($_POST as $param_name => $param_val) {
    //echo "Param: $param_name; Value: $param_val<br />\n";

	if ($param_name!="submit" || $param_name!="MM_submit")
	{
		$query_answer=sprintf("SELECT answer from questions where id=%s", GetSQLValueString($param_name,"int"));
		$answer=mysql_query($query_answer,$testsimule) or die(mysql_error());
		$row_answer=mysql_fetch_assoc($answer);
		if(strcmp($row_answer['answer'],$param_val) == 0) 
			$total = $total + 1;
	}
}

$value=$_COOKIE[$cookie_name];
$query_answer=sprintf("UPDATE users set marks=%s where USN=%s", GetSQLValueString ($total,"int"), GetSQLValueString($value,"text"));
		$answer=mysql_query($query_answer,$testsimule) or die(mysql_error());

?>

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
           	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><h1 align="center">Your score is : <?php echo $total; ?></h1><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
           </div>
           <div id="Footer">
           </div>
       </div>
        </div>
	</div>
</body>
</html>
