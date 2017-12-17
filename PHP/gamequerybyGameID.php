<meta charset="UTF-8">

<?php
@mysql_connect("localhost","root","aiyi123")
or die("DB Connection Failed...");

@mysql_select_db("AiYiWeiqi")
or die("AiYiWeiqi DB not working");

//echo "php is writing this."."<br> <br>";
mysql_query("set name gb2312");


$GameID=$_GET[GameID];

$strl=strlen($playername);


//if ($strl<3) {
if ( $GameID=="''" ) {
echo "清输入对局记录ID号！<br>";
}

else {
$myquery = @mysql_query("select PlayerA , PlayerB , PlayerAPreRating, PlayerBPreRating, Result, PlayerANewRating, PlayerBNewRating, Counted  from GameRecords where idGameRecords = ". $_GET[GameID]. ";")
or die("SQL 失败!");
}

$rowcount = mysql_num_rows($myquery);
$fieldscount = mysql_num_fields($myquery);
//if ($rowcount < 1) {
//echo "此用户没有对局记录。请重新输入。";
//}
//echo "Playername 长度是：". $strl . "<br>" ;
//echo "playername is:||" . $_GET[player] . "||<br>" ;
//echo "返回的行数是：". $rowcount."<br>"; 



echo "<table border=\"1\">";
echo "<tr><td>选手A </td> <td>选手B </td> <td>A旧等级分</td> <td>B旧等级分</td><td>结果 </td><td>A新等级分</td><td>B新等级分</td><td>已计算 </td> </tr>";
for ( $i = 0 ; $i < $rowcount; $i++) {
	echo "<tr><td>" . mysql_result( $myquery, $i, 0 ) . "</td>" ;
	for ( $j = 1; $j < ($fieldscount - 1); $j++) {
		if (mysql_result($myquery, $i, $j) == null) {
			echo "<td>" . "--" . "</td>" ;
		}
		else {
			echo "<td>" . mysql_result( $myquery, $i, $j ) . "</td>" ;
		}
	}
	echo "<td>" . mysql_result( $myquery, $i, $fieldscount-1 ) . "</td></tr>" ;
}
echo "</table>";

mysql_close();
?>

