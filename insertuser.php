<?php

@mysql_connect("localhost","root","aiyi123")
or die("DB Connection Failed...");

@mysql_select_db("AiYiWeiqi")
or die("AiYiWeiqi DB not working");

$myquery = @mysql_query("INSERT INTO 'UserInfo' ('MemberID', 'Surname', 'GiveName', 'InitRank') VALUES('AY0002', 'Yang', 'Yang', '5D')")
or die("SQL not working!");

echo "UserInfo Table Results:";
while ($row = mysql_fetch_array($myquery, MYSQL_BOTH)){
	
echo "<tr><td>". $row[0] . "</td>";
echo "<td>". $row[1] . "</td>";
echo "<td>". $row["MemberID"] . "</td>";

}
echo "</table>";
mysql_close();

?>