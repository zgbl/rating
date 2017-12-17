<?php
$con = mysql_connect("localhost","root","aiyi123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("AiYiWeiqi", $con);

$sql="INSERT INTO UserInfo (SurName, GiveName, InitRank)
VALUES
('$_POST[GiveName]','$_POST[SurName]','$_POST[InitRank]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";

mysql_close($con)
?>