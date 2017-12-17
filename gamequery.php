<meta charset="UTF-8">

<?php
@mysql_connect("localhost","root","aiyi123")
or die("DB Connection Failed...");

@mysql_select_db("AiYiWeiqi")
or die("AiYiWeiqi DB not working");

echo "php is writing this."."<br> <br>";
mysql_query("set name gb2312");
//$myquery = @mysql_query("select * from GameRecords")

$playername=$_GET[player];

$strl=strlen($playername);
//$myquery = @mysql_query("select * from GameRecords;")
//$myquery = @mysql_query("select * from GameRecords where BlackPlayer ='王朝辉';")
//$myquery = @mysql_query("select * from GameRecords where BlackPlayer = ". $playername . ";")

//if ($strl<3) {
if ( $playername=="''" ) {
//if ($playname="'ajaijdj'") {
//	var sql="select * from GameRecords;";
	$myquery = @mysql_query("select idGameRecords, PlayerA , PlayerB , PlayerAPreRating, PlayerBPreRating, Result, PlayerANewRating, PlayerBNewRating, Counted, GameWeight, HandiValue from GameRecords;")
or die("SQL 失败!");
echo "返回全部对局记录！<br>";
}

else {
//var sql2 = "select * from GameRecords where BlackPlayer = ". $_GET[player] . " OR WhitePlayer = ".$_GET[player]. ";";
//$myquery = @mysql_query(sql2)

$sql3 = "select idGameRecords, PlayerA , PlayerB , PlayerAPreRating, PlayerBPreRating, Result, PlayerANewRating, PlayerBNewRating, Counted, GameWeight, HandiValue from GameRecords where PlayerA = ". $_GET[player] . " OR PlayerB = ".$_GET[player]. ";";

//echo "sql3 is: ". $sql3. "<br>";

$myquery = @mysql_query($sql3)
//$myquery = @mysql_query("select * from GameRecords where BlackPlayer = ". $_GET[player] . " OR WhitePlayer = ".$_GET[player]. ";")
or die("SQL 失败!");
//$myquery = @mysql_query("select * from GameRecords where BlackPlayer = '王朝辉';")
//or die("SQL 失败!");

}

$rowcount = mysql_num_rows($myquery);
$fieldscount = mysql_num_fields($myquery);
echo "SQL Query 成功!";
//if ($rowcount < 1) {
//echo "此用户没有对局记录。请重新输入。";
//}
//echo "Playername 长度是：". $strl . "<br>" ;
//echo "playername is:||" . $_GET[player] . "||<br>" ;
echo "返回的行数是：". $rowcount."<br>"; 
//echo $myquery . "<br>";
//echo $_POST[textMemberID] . "<br>";
//echo "对局者名字是: " . $_GET[player];
echo "<table border=\"1\">";
echo "<tr> <td>GameID</td> <td>选手A </td> <td>选手B </td> <td>A旧等级分</td> <td>B旧等级分</td><td>结果 </td><td>A新等级分</td><td>B新等级分</td><td>已计算</td> <td>对局权重</td> <td>让子让目值</td> <td> 选取区 </td></tr>";
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
	echo "<td>" . mysql_result( $myquery, $i, $fieldscount-1 ) . "</td> <td><input type='checkbox' name='checkbox" . $i. "' id='checkbox" . $i .  "'></td> </tr>" ;
}
echo "</table>";

mysql_close();
?>

