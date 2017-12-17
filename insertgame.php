<meta charset="UTF-8">
<?php

$con = mysql_connect("localhost","root","aiyi123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("AiYiWeiqi", $con);

$handivalue = round(($_POST[texthandicap] - ($_POST[textkomi]+7.5)/14),2);

echo "让子值是：" . $handivalue . "<br>";

$sql="INSERT INTO GameRecords (Date1, GameInfo, GameWeight, PlayerA, PlayerB, Result, HandiStones, HandiValue, Komi)
VALUES
('$_POST[textdate]','$_POST[textGameInfo]', '$_POST[textGameWeight]','$_POST[textbplayer]','$_POST[textwplayer]','$_POST[textresult]', '$_POST[texthandicap]'," . $handivalue . ",'$_POST[textkomi]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
//  echo $_POST[textinfo];
//echo "SQL 是：" . $sql. "<br>" ;
//echo "User Register Successed!" . "<br>";
//echo "ID number is: " . $_POST[textIDNumber] .$_POST[textAddress]. "<br>";

//echo  "<script> alert('Game Record added successfully!'); 
echo  "<script> 
window.history.go(-1);
</script>";


mysql_close($con)

?>