
<?php
//<meta charset="UTF-8">

//ob_start();
//session_start();
//$_SESSION['username'] = "flyer";
@mysql_connect("localhost","root","aiyi123")
or die("DB Connection Failed...");

@mysql_select_db("AiYiWeiqi")
or die("AiYiWeiqi DB not working");

mysql_query("set name gb2312");


//$myquery = @mysql_query("select PlayerA , PlayerB , PlayerAPreRating, PlayerBPreRating, Result, PlayerANewRating, PlayerBNewRating, Counted, idGameRecords  from GameRecords where Counted = 0;")
//or die("SQL 失败!");
$myquery = @mysql_query("select idGameRecords, PlayerA , PlayerB , PlayerAPreRating, PlayerBPreRating, Result, PlayerANewRating, PlayerBNewRating, Counted, GameWeight, HandiStones, Komi from GameRecords where Counted = 0;")
or die("SQL 失败!");


$rowcount = mysql_num_rows($myquery);
$fieldscount = mysql_num_fields($myquery);

mysql_close();

?>