
<?php

@mysql_connect("localhost","root","aiyi123")
or die("DB Connection Failed...");

@mysql_select_db("AiYiWeiqi")
or die("AiYiWeiqi DB not working");

mysql_query("set name gb2312");

$sqlTeamMember = "select TeamMemberID from Teams Where TeamName = " . $_GET[TeamNM]. ";";
//$sqlTeamMember = "select TeamMemberID from Teams;";
//echo $sqlTeamMember. "<br>";
$rs = mysql_query($sqlTeamMember);
$rowcount = mysql_num_rows($rs);
//echo "行数是：". $rowcount . "<br>";
//$members = mysql_fetch_array($rs);
//$MID = array_column($members,"TeamMemberID");

//echo json_encode($MID);
//echo json_encode($rs);
//echo $members;
//echo "我显示回来东西了";

echo '["';
$fieldscount = mysql_num_fields($rs );
  for ( $i = 0 ; $i < ($rowcount-1); $i++) {
			echo  mysql_result( $rs, $i, 0 ) . '", ' ;
		}
echo mysql_result($rs, $rowcount-1, 0) . '"]';
mysql_close();

?>