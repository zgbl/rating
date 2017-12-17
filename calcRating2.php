<meta charset="UTF-8">

<?php
 // 此PHP文件用于批量处理全部未提交的对局结果
 //在计算某一条对局记录时，查询UserInfo表，把双方赛前的等级分prerating填进去
 //本版本是为了改进计算过程，加入让子让目情况下等级分的计算。
 
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

$WinSector = 200;
$singleGameWeight = 15 ;

for ( $i=0; $i < $rowcount; $i++) {
echo "<br>";
echo "--------------------------新对局纪录----------------------------- <br>";
//echo "查询结果列数是：". $fieldscount.  "<br>" ;
$PlayerA = mysql_result( $myquery, $i, 1 ); 
echo "PlayerA是：" .  $PlayerA . "<br>"  ;
$PlayerB = mysql_result( $myquery, $i, 2 );
echo "PlayerB是：" .  $PlayerB . "<br>" ;
$GameID = mysql_result( $myquery, $i, 0 );
echo "Game ID是：". $GameID. "<br>" ;
$CountorNot  = mysql_result( $myquery, $i, 8 );
echo "CountorNot 是：". $CountorNot. "<br>";
$singleGameWeight  = mysql_result( $myquery, $i, 9 );
echo "对局权重是：". $singleGameWeight. "<br>";
$handistones = mysql_result( $myquery, $i, 10 );
echo "让子数是：". $handistones . "<br>";
$Komi = mysql_result( $myquery, $i, 11 );
echo "贴目是：". $Komi. "<br>";
//$Result = 1, 表示PlayerA赢了，0 表示PlayerB 赢
$Result = mysql_result( $myquery, $i, 5 ) ;
echo "结果是：". $Result . "<br>" ;

if ($handistones >=2 ) {
	$handivalue = round(($handistones - ($Komi+7.5)/14),2);
}
else {
	$handivalue = round((7.5 - $Komi)/14,2);
}

 echo "让子让目值是：". $handivalue . "<br>" ;
 
 //在计算某一条对局记录时，查询UserInfo表，把双方赛前的等级分prerating填进去
//$queryPreRatingA = "select CurrentRating from UserInfo where name = ". $PlayerA . ";" ;
//$queryPreRatingB = "select CurrentRating from UserInfo where name = ". $PlayerB . ";" ;

 $playerRating = @mysql_query("select CurrentRating, TotalGames, TotalWinGames from UserInfo where name = '". $PlayerA . "';")
 or die("SQL 失败!");
 //echo "select CurrentRating from UserInfo where name = '". $PlayerA . "'; <br>" ;
 
 $PlayerAPreGameRating = mysql_result( $playerRating, 0, 0 );
 $PlayerATotalGames = mysql_result( $playerRating, 0, 1 );
 $PlayerATotalWinGames = mysql_result( $playerRating, 0, 2 );
 echo " PlayerAPreGameRating is: ".  $PlayerAPreGameRating. "<br>" ;
 
 $playerRating = @mysql_query("select CurrentRating, TotalGames, TotalWinGames  from UserInfo where name = '". $PlayerB . "';")
 or die("SQL 失败!");
 //echo "select CurrentRating from UserInfo where name = '". $PlayerB . "'; <br>";
 
 $PlayerBPreGameRating = mysql_result( $playerRating, 0, 0 );
 echo " PlayerBBPreGameRating is: ".  $PlayerBPreGameRating. "<br>" ;
 $PlayerBTotalGames = mysql_result( $playerRating, 0, 1 );
 $PlayerBTotalWinGames = mysql_result( $playerRating, 0, 2 );
 
 //为把让子让目棋通行计算，用让子数得出一个选手B的临时经过调整的等级分, 下手必须放在B位置，负负得正，下手调整等级分是被提高了的
 $PlayerBAdjustedPreRating = $PlayerBPreGameRating + 100 * $handivalue ;
 echo "B方调整等级分是：" . $PlayerBAdjustedPreRating . "<br>";
 
 
// $sql6 = "Update AiYiWeiqi.GameRecords set PlayerAPreRating ='" . $PlayerAPreGameRating ."', PlayerBPreRating  ='" . $PlayerBPreGameRating. "' where idGameRecords = ". $GameID . ";" ;
 
// echo "SQL6 is: ". $sql6 . "<br>";
/*
$sqlCount = "select Counted from GameRecords where idGameRecords = " . $GameID . ";" ;
$queryCount = @mysql_query($sqlCount)
or die ("SQL查询Counted失败");
$CountorNot = mysql_result($queryCount, 0, 0);
echo "Counted is: ". $CountorNot . "<br>" ;
*/

//if ($CountorNot == 1) {
//echo "本条记录已经计算过等级分，不能重复计算。" ; 
////下面需要终止这个php程序的执行。调试期间暂时关闭这个判断。
//return;
//}

/*
$sql = "select BlackRating WhiteRating from GameRecords where idGameRecords = " . $GameID . ";" ;

$myquery = @mysql_query("select PlayerA , PlayerB , PlayerAPreRating, PlayerBPreRating from GameRecords where idGameRecords = ". $GameID. ";")
or die("SQL 失败!");

$PlayerA = mysql_result( $myquery, 0, 0 ) ;
$PlayerB = mysql_result( $myquery, 0, 1 ) ;
$PlayerAPreGameRating = mysql_result( $myquery, 0, 2 ) ;
$PlayerBPreGameRating = mysql_result( $myquery, 0, 3 ) ;

*/
//$Winner = mysql_result( $myquery, 0, 2 ) ;
//$PlayerA = mysql_result( $myquery, 0, 3 ) ;
//$PlayerB = mysql_result( $myquery, 0, 4 ) ;
//$fieldscount = mysql_num_fields($myquery);

$PlayerAPower = pow(10,($PlayerAPreGameRating / $WinSector)) ;
$PlayerBPower = pow(10,($PlayerBAdjustedPreRating / $WinSector)) ;

$PlayerALikely = $PlayerAPower / ($PlayerAPower + $PlayerBPower) ;
$PlayerBLikely = $PlayerBPower / ($PlayerAPower + $PlayerBPower) ;


$PlayerAAjusting = round(($singleGameWeight * ($Result - $PlayerALikely)),2) ;

$PlayerBAjusting = $PlayerAAjusting * (-1) ;
echo "PlayerAAjusting is: ". $PlayerAAjusting . "， PlayerBAjusting is" . $PlayerBAjusting ." <br> ";

$PlayerAAftRating = round(($PlayerAPreGameRating + $PlayerAAjusting), 2 ) ;
$PlayerBAftRating = round(($PlayerBPreGameRating + $PlayerBAjusting), 2 ) ;

$PlayerATotalGames++ ;
$PlayerBTotalGames++;

if ($Result == 1) {
	$PlayerATotalWinGames++;
	echo $PlayerA. "赢棋数增加一盘。<br>";
}
else if ($Result == 0){
	$PlayerBTotalWinGames++;
	echo $PlayerB. "赢棋数增加一盘。<br>";
}

$Counted = 1;

//$sql2 = "Update AiYiWeiqi.GameRecords set PlayerANewRating ='" . $PlayerAAftRating . "' where idGameRecords = ". $GameID . ";" ;
$sql3 = "Update AiYiWeiqi.GameRecords set PlayerAPreRating ='" . $PlayerAPreGameRating ."', PlayerBPreRating  ='" . $PlayerBPreGameRating.   "', PlayerANewRating ='" . $PlayerAAftRating ."', PlayerBNewRating ='" . $PlayerBAftRating. "' , Counted = ". $Counted. ", APlayerAdjusting = " . $PlayerAAjusting . ", BPlayerAdjusting = " . $PlayerBAjusting . " where idGameRecords = ". $GameID . ";" ;

$sql4 = " Update UserInfo set CurrentRating =" . $PlayerAAftRating . ", TotalGames = ". $PlayerATotalGames. ", TotalWinGames = ". $PlayerATotalWinGames . " Where Name = '" . $PlayerA . "';" ;
$sql5 = " Update UserInfo set CurrentRating =" . $PlayerBAftRating . ", TotalGames = ". $PlayerBTotalGames. ", TotalWinGames = ". $PlayerBTotalWinGames . " Where Name = '" . $PlayerB . "';" ;

//echo "SQL3 is: " . $sql3 . "<br>";


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
/*
echo "对局记录的ID是：". $GameID ."<br>";
echo "SQL是：". $sql . "<br>";
echo "A方对局前等级分为：" . $PlayerAPreGameRating . "<br>";
echo "B方对局前等级分为：" . $PlayerBPreGameRating . "<br>";
echo "A方对局后等级分为：" . $PlayerAAftRating . "<br>";
echo "B方对局后等级分" . $PlayerBAftRating . "<br>";
//echo "结果列数：" . $fieldscount . "<br>";
echo "BlackLikely is: " . $BlackPower . "<br>";
echo "SQL3 is: " . $sql3 . "<br>";
*/
echo $PlayerA. "总对局数局是：". $PlayerATotalGames . " 总胜局是：" . $PlayerATotalWinGames . "<br>";
echo $PlayerB. "总对局数局是：". $PlayerBTotalGames . " 总胜局是：" . $PlayerBTotalWinGames . "<br>";
}
echo "等级分处理成功！";

mysql_close();


function calcrating($PlayerAPreGameRating, $PlayerBPreGameRating, $Result) {



//把两个新等级分放进一个数组返回
$newRatingSet = array (0 => $PlayerAAftRating, 1 => $PlayerBAftRating);
return $newRatingSet ;	
}





?>