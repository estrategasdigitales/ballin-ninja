<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_trivia_2011 = "localhost";
$database_trivia_2011 = "decuiaco_trivia2012";
$username_trivia_2011 = "decuiaco";
$password_trivia_2011 = "DEC2010";
$trivia_2011 = mysql_pconnect($hostname_trivia_2011, $username_trivia_2011, $password_trivia_2011) or trigger_error(mysql_error(),E_USER_ERROR); 
?>