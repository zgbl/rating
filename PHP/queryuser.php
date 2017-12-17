<meta charset="UTF-8">

<?php

@mysql_connect("localhost","root","aiyi123")
or die("DB Connection Failed...");

@mysql_select_db("AiYiWeiqi")
or die("AiYiWeiqi DB not working");

echo "会员等级分排行";

mysql_query("set name gb2312");

if ($_POST[textminigame]=='') {
	
	$myquery = @mysql_query("select MemberID, Name, InitialRating, CurrentRating , TotalGames from UserInfo order by CurrentRating desc")
	or die("SQL 失败!");
}

else {
$myquery = @mysql_query("select MemberID, Name, InitialRating, CurrentRating , TotalGames from UserInfo where TotalGames >=$_POST[textminigame] order by CurrentRating desc")


//$myquery = @mysql_query("select MemberID, Name, InitialRating, CurrentRating, TotalGames from UserInfo order by CurrentRating desc")
or die("SQL 失败!");
}

$rowcount = mysql_num_rows($myquery);
$fieldscount = mysql_num_fields($myquery);

echo "<table border=\"1\">";
echo "<tr> </td><td>会员ID</td> <td>姓名 </td> <td>初始等级分 </td> <td>当前等级分</td> <td>总对局数</td> <td>排名</td> </tr>";
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
	echo "<td>" . mysql_result( $myquery, $i, $fieldscount-1 ) . "</td> <td>". ($i + 1). "</td> </tr>" ;
}
echo "</table>";

mysql_close();

?>