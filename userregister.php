<?php

$con = mysql_connect("localhost","root","aiyi123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("AiYiWeiqi", $con);

$sql="INSERT INTO UserInfo (LastName, FirstName, Name, InitRank, InitialRating, Address, IDType, IDNumber)
VALUES
('$_POST[textLastName]','$_POST[textFirstName]', '$_POST[textName]','$_POST[textInitRank]', '$_POST[textInitRating]','$_POST[textAddress]','$_POST[RadioGroupID]','$_POST[textIDNumber]')";

if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
  
//  echo $_POST[textinfo];
  
//echo "User Register Successed!" . "<br>";
//echo "ID number is: " . $_POST[textIDNumber] .$_POST[textAddress]. "<br>";
echo " <script> alert('User register successed!'); 
window.history.go(-1);
</script>";


mysql_close($con)

?>
