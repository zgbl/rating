<meta charset="UTF-8">

<?php
 
 include 'showunprocess2.php';
//测试是否 include 成功
echo "SQL查询结果行数是：". $rowcount . "<br>" ;
echo "查询结果中有：" . mysql_result( $myquery, 1, 1 ) . "<br>";

$con = mysql_connect("localhost","root","aiyi123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("AiYiWeiqi", $con);

echo "<br> Username is: ". $_SESSION['username']."<br>" ;

//echo "php is writing this."."<br> <br>";
mysql_query("set name gb2312");

$GameID=$_GET[GameID];

//$strl=strlen($GameID);

$sqlCount = "select Counted from GameRecords where idGameRecords = " . $GameID . ";" ;
//echo $sqlCount . "<br>";
$queryCount = @mysql_query($sqlCount)
or die ("SQL查询Counted失败");
$CountorNot = mysql_result($queryCount, 0, 0);
echo "Counted is: ". $CountorNot . "<br>" ;
//if ($CountorNot == 1) {
//echo "本条记录已经计算过等级分，不能重复计算。" ; 
////下面需要终止这个php程序的执行。调试期间暂时关闭这个判断。
//return;
//}

$sql = "select BlackRating WhiteRating from GameRecords where idGameRecords = " . $GameID . ";" ;

$myquery = @mysql_query("select PlayerA , PlayerB , PlayerAPreRating, PlayerBPreRating from GameRecords where idGameRecords = ". $GameID. ";")
or die("SQL 失败!");

$PlayerA = mysql_result( $myquery, 0, 0 ) ;
$PlayerB = mysql_result( $myquery, 0, 1 ) ;
$PlayerAPreGameRating = mysql_result( $myquery, 0, 2 ) ;
$PlayerBPreGameRating = mysql_result( $myquery, 0, 3 ) ;
//$Winner = mysql_result( $myquery, 0, 2 ) ;
//$PlayerA = mysql_result( $myquery, 0, 3 ) ;
//$PlayerB = mysql_result( $myquery, 0, 4 ) ;
//$fieldscount = mysql_num_fields($myquery);

$PlayerAPower = pow(10,($PlayerAPreGameRating / 400)) ;
$PlayerBPower = pow(10,($PlayerBPreGameRating / 400)) ;
$singleGameWeight = 10 ;
$PlayerALikely = $PlayerAPower / ($PlayerAPower + $PlayerBPower) ;
$PlayerBLikely = $PlayerBPower / ($PlayerAPower + $PlayerBPower) ;
 
if ($Winner==$PlayerA ) {
$Result = 1	;
}

else {
$Result = 0	;
}

$PlayerAAjusting = round(($singleGameWeight * ($Result - $PlayerALikely)),2) ;

echo "$PlayerAAjusting is: ". $PlayerAAjusting . " <br> ";

$PlayerBAjusting = $PlayerAAjusting * (-1) ;

$PlayerAAftRating = round(($PlayerAPreGameRating + $PlayerAAjusting), 2 ) ;
$PlayerBAftRating = round(($PlayerBPreGameRating + $PlayerBAjusting), 2 ) ;

$Counted = 1;

//$sql2 = "Update AiYiWeiqi.GameRecords set PlayerANewRating ='" . $PlayerAAftRating . "' where idGameRecords = ". $GameID . ";" ;
$sql3 = "Update AiYiWeiqi.GameRecords set PlayerANewRating ='" . $PlayerAAftRating ."', PlayerBNewRating ='" . $PlayerBAftRating. "' , Counted = ". $Counted. ", APlayerAdjusting = " . $PlayerAAjusting . ", BPlayerAdjusting = " . $PlayerBAjusting . " where idGameRecords = ". $GameID . ";" ;

$sql4 = " Update UserInfo set CurrentRating =" . $PlayerAAftRating . " Where Name = '" . $PlayerA . "';" ;
$sql5 = " Update UserInfo set CurrentRating =" . $PlayerBAftRating . " Where Name = '" . $PlayerB . "';" ;
echo "SQL3 is: " . $sql3 . "<br>";

//if (!mysql_query($sql2,$con))
//  {
//  die('Error: ' . mysql_error());
//  }
  
if (!mysql_query($sql3,$con))
  {
  die('Error: ' . mysql_error());
  }
if (!mysql_query($sql4,$con))
  {
  die('Error: ' . mysql_error());
  }
if (!mysql_query($sql5,$con))
  {
  die('Error: ' . mysql_error());
  }

echo "对局记录的ID是：". $GameID ."<br>";
echo "SQL是：". $sql . "<br>";
echo "A方对局前等级分为：" . $PlayerAPreGameRating . "<br>";
echo "B方对局前等级分为：" . $PlayerBPreGameRating . "<br>";
echo "A方对局后等级分为：" . $PlayerAAftRating . "<br>";
echo "B方对局后等级分" . $PlayerBAftRating . "<br>";
//echo "结果列数：" . $fieldscount . "<br>";
echo "BlackLikely is: " . $BlackPower . "<br>";
echo "SQL3 is: " . $sql3 . "<br>";


mysql_close();
?>