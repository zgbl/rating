<meta charset="UTF-8">
<?php
//设置默认时区
date_default_timezone_set('Asia/Shanghai');

$con = mysql_connect("localhost","root","aiyi123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("AiYiWeiqi", $con);

mysql_query("set name gb2312");

$TeamName = $_POST[textTeamName];

if ($_POST[textTeamMember] != '' ) {
$MemberName = $_POST[textTeamMember];
}
else {
$MemberName = $_POST[selectMember];
}
$sqlMID = "select MemberID from UserInfo Where Name ='". $MemberName. "';" ;
//$myquery3 = @mysql_query($sqlMID)
$myquery3 = @mysql_query("select MemberID from UserInfo where Name ='". $MemberName. "';")
or die("SQL 失败!");

$MemberID = mysql_result($myquery3, 0, 0);
$Today = Date("Y-m-d");
//echo "今天是：". $Today . "<br>";
//echo "sqlMID is: " . $sqlMID . "<br>";

$sqlAddTeamMember = "INSERT INTO Teams (TeamName, TeamMembers, TeamMemberID, CreateDate) VALUES ('$_POST[textTeamName]', '".$MemberName . "', '" . $MemberID . "', '". $Today. "')";

//echo "SQL是：". $sqlAddTeamMember  . "<br>";

if (!mysql_query($sqlAddTeamMember,$con))
  {
  die('Error: ' . mysql_error());
  }

?>