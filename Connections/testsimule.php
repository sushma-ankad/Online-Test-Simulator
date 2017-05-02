<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_testsimule = "localhost";
$database_testsimule = "testsimule";
$username_testsimule = "root";
$password_testsimule = "";
$testsimule = mysql_pconnect($hostname_testsimule, $username_testsimule, $password_testsimule) or trigger_error(mysql_error(),E_USER_ERROR); 
?>