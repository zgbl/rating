<meta charset="UTF-8">

<?php
@mysql_connect("localhost","root","aiyi123")
or die("DB Connection Failed...");

@mysql_select_db("AiYiWeiqi")
or die("AiYiWeiqi DB not working");

mysql_query("set name gb2312");


$myquery = @mysql_query("SELECT DateTime,GameInfo, PlayerA, Result, PlayerB, PlayerAPreRating, PlayerBPreRating, APlayerAdjusting, BPlayerAdjusting, PlayerANewRating, PlayerBNewRating FROM AiYiWeiqi.GameRecords where PlayerA ='边雪松' OR PlayerB ='边雪松';")
or die("SQL1 失败!");

 
$rowcount = mysql_num_rows($myquery);
$fieldscount = mysql_num_fields($myquery);


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
echo "<br> Username is: ". $_SESSION['username']."<br>" ;
mysql_close();
?>

