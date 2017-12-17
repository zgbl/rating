<?php
$con = mysql_connect("localhost","root","aiyi123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("AiYiWeiqi", $con);

$sql="INSERT INTO GameRecords (Datetime, Gameinfo, BlackPlayer, WhitePlayer, Result, Handicap, Komi )
VALUES
('$_POST[textdate]','$_POST[textinfo]','$_POST[textbplayer]', '$_POST[textwplayer]', '$_POST[textwinner]', '$_POST[texthandicip]', '$_POST[textkomi]' )";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
//  echo $_POST[textinfo];
  
echo "1 record added";

mysql_close($con)
?>