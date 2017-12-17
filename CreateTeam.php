<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Create Team</title>
</head>


<body>
<p>创建比赛队伍</p>
<form id="form1" name="form1" action="PHP/AddTeamMember.php" method="post">
  <p>
    <label for="textTeamName">队名:</label>
    <input type="text" name="textTeamName" id="textTeamName">
  </p>
  <p>
    <label for="textTeamMember">队员:</label>
    <input type="text" name="textTeamMember" id="textTeamMember">
  </p>
  <p>
    <label for="selectMember">选取队员:</label>
    <select name="selectMember" id="selectMember">
<?php
date_default_timezone_set('Asia/Shanghai');
$con = mysql_connect("localhost","root","aiyi123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("AiYiWeiqi", $con);
mysql_query("set name gb2312");
$sqlselect = "select Name from UserInfo; ";
$rs =  mysql_query($sqlselect);
$rowcount = mysql_num_rows($rs);
$row = mysql_fetch_array($rs);
$i = 0;
while( $i < $rowcount)
{ 
echo "<option>". mysql_result($rs, $i, 0) . "</option>";
$i++;
}
mysql_close();
?>
    </select>
  (当上面有手动填入的队员名时，选取框无效)</p>
  <p>
    <input type="submit" name="smtAddMember" id="smtAddMember" value="添加队员">
  </p>
  <p>&nbsp; </p>
</form>
<div id="showmembers"></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>;
</html>
