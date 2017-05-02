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

mysql_select_db($database_testsimule, $testsimule);
$query_Questions = "SELECT * FROM questions";
$Questions = mysql_query($query_Questions, $testsimule) or die(mysql_error());
$row_Questions = mysql_fetch_assoc($Questions);
$totalRows_Questions = mysql_num_rows($Questions);
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
<title>Questions</title>
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
        <div id="Holder" style="background-image:url(images/content1.jpg); background-repeat:repeat-y;">
        	<div id="HeaderContainer">
          		 <div id="Header">
                 	<h1>Test Simule!!</h1>
           		 </div>
           		<div id="Nav">
           		</div>
           	</div>
           <div id="Content">
           	<div id="Questions">
            	<form name="Questions" action="eval.php" method="post" >
                	 <?php do { ?>
               	     <p><?php echo $row_Questions['question']; ?></p>
                	   <ul>
                	     <li><input type="radio" name="<?php echo $row_Questions['id']; ?>" value="<?php echo $row_Questions['a1']; ?>"/><span><?php echo $row_Questions['a1']; ?></span></li>
                	     <li><input type="radio" name="<?php echo $row_Questions['id']; ?>" value="<?php echo $row_Questions['a2']; ?>"/><span><?php echo $row_Questions['a2']; ?></span></li>
                	     <li><input type="radio" name="<?php echo $row_Questions['id']; ?>" value="<?php echo $row_Questions['a3']; ?>"/><span><?php echo $row_Questions['a3']; ?></span></li>
                	     <li><input type="radio" name="<?php echo $row_Questions['id']; ?>" value="<?php echo $row_Questions['a4']; ?>"/><span><?php echo $row_Questions['a4']; ?></span></li>
               	       </ul>
                	   <?php } while ($row_Questions = mysql_fetch_assoc($Questions)); ?>
<!-- <p>1. Awebpage displays a picture. What tag was used to display that picture?</p>
	            <ul>
    	        	<li><input type="radio" name="Q1"/><span>Picture</span></li>
        	        <li><input type="radio" name="Q1"/><span>image</span></li>
            	    <li><input type="radio" name="Q1"/><span>img</span></li>
                	<li><input type="radio" name="Q1"/><span>src</span></li>
            	</ul>
                
                <p>2. &lt;b&gt; tag makes the enclosed text bold. What is other tag to make text bold?</p>
	            <ul>
    	        	<li><input type="radio" name="Q2"/><span>&lt;strong&gt;</span></li>
        	        <li><input type="radio" name="Q2"/><span>&lt;dar&gt;</span></li>
            	    <li><input type="radio" name="Q2"/><span>&lt;black&gt;</span></li>
                	<li><input type="radio" name="Q2"/><span>&lt;emp&gt;</span></li>
            	</ul>
                
                <p>3. Tags and test that are not directly displayed on the page are written in _____ section.</p>
	            <ul>
    	        	<li><input type="radio" name="Q3"/><span>&lt;html&gt;</span></li>
        	        <li><input type="radio" name="Q3"/><span>&lt;head&gt;</span></li>
            	    <li><input type="radio" name="Q3"/><span>&lt;title&gt;</span></li>
                	<li><input type="radio" name="Q3"/><span>&lt;body&gt;</span></li>
            	</ul>
                
                 <p>4. Which tag inserts a line horizontally on your web page?</p>
	            <ul>
    	        	<li><input type="radio" name="Q3"/><span>&lt;hr&gt;</span></li>
        	        <li><input type="radio" name="Q3"/><span>&lt;line&gt;</span></li>
            	    <li><input type="radio" name="Q3"/><span>&lt;tr&gt;</span></li>
                	<li><input type="radio" name="Q3"/><span>&lt;line direction="horizontal"&gt;</span></li>
            	</ul>
                
                <p>5. What should be the first tag in any HTML document?</p>
	            <ul>
    	        	<li><input type="radio" name="Q3"/><span>&lt;head&gt;</span></li>
        	        <li><input type="radio" name="Q3"/><span>&lt;title&gt;</span></li>
            	    <li><input type="radio" name="Q3"/><span>&lt;html&gt;</span></li>
                	<li><input type="radio" name="Q3"/><span>&lt;document&gt;</span></li>
            	</ul>
                
                 <p>6. &lt;BASE&gt; tag is designed to appear only between</p>
	            <ul>
    	        	<li><input type="radio" name="Q3"/><span>&lt;head&gt;</span></li>
        	        <li><input type="radio" name="Q3"/><span>&lt;title&gt;</span></li>
            	    <li><input type="radio" name="Q3"/><span>&lt;body&gt;</span></li>
                	<li><input type="radio" name="Q3"/><span>&lt;form&gt;</span></li>
            	</ul>
                
                 <p>7. The tag which allows you to rest other HTML tags within the description is</p>
	            <ul>
    	        	<li><input type="radio" name="Q3"/><span>&lt;th&gt;</span></li>
        	        <li><input type="radio" name="Q3"/><span>&lt;td&gt;</span></li>
            	    <li><input type="radio" name="Q3"/><span>&lt;tr&gt;</span></li>
                	<li><input type="radio" name="Q3"/><span>&lt;caption&gt;</span></li>
            	</ul>
               
                <p>8. Which of the following statement is not true regarding java script?</p>
	            <ul>
    	        	<li><input type="radio" name="Q3"/><span>Java is a loosely typed language</span></li>
        	        <li><input type="radio" name="Q3"/><span>Java script is an object based language</span></li>
            	    <li><input type="radio" name="Q3"/><span>Java script is event driven</span></li>
                	<li><input type="radio" name="Q3"/><span>Java script cannot run in standalone mode(without a browser)</span></li>
            	</ul>
                 
                 <p>9. How many root elements can XML document have?</p>
	            <ul>
    	        	<li><input type="radio" name="Q3"/><span>One</span></li>
        	        <li><input type="radio" name="Q3"/><span>Two</span></li>
            	    <li><input type="radio" name="Q3"/><span>Three</span></li>
                	<li><input type="radio" name="Q3"/><span>As many as memory provides</span></li>
            	</ul>
                
                <p>10.The XML object is </p>
	            <ul>
    	        	<li><input type="radio" name="Q3"/><span>Entity</span></li>
        	        <li><input type="radio" name="Q3"/><span>Entity Reference</span></li>
            	    <li><input type="radio" name="Q3"/><span>Comment Reference</span></li>
                	<li><input type="radio" name="Q3"/><span>Comment Data</span></li>
            	</ul>
                -->
                <p><span>&nbsp;</span><input type="submit" class="submit" name="submit" id="submit" value="Submit"/></p>
            <input type="hidden" name="MM_submit" value="submit">
                </form>
             </div>
           	</div>
           <div id="Footer">
           </div>
       </div>
        </div>
	</div>
</body>
</html>
<?php
mysql_free_result($Questions);
?>
