

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>对局结果提交PHP版</title>
<script type="text/javascript">


function insertgame(){
//var url = "http://localhost:80";   //这句不知道对不对。URL的格式怎么也查不到。
 var url = "test.php";
 
//xmlHttpRequest = createxmlHttpRequest();
varable = new XMLHttpRequest();
//var ttt = textkomi.value;
alert("varable.readyState is: " + varable.readyState);	
alert("varable.status is: " + varable.status);
alert("url is "+ url);
varable = false;
//alert("varable is" + varable);
//varable.onreadystatechange = dosomething();
varable.open("POST", url , true);
varable.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
varable.onreadystatechange = doit();
//{
//	if(varable.readyState==4 && varable.status == 200) {
//	btn-submit.value = varable.responseText;
//	alert(varable.responseText);
//	alert(varable.readyState);
//	}
	
varable.send(null);

//xmlHttpRequest.send(null);

//document.write("textkomi is: " + ttt);
}

function doit() {
alert("varable.readyState is: "+ varable.readyState);	
alert("varable.status is: "+ varable.status);
}

function dosomething(){
alert("返回信息为：" + varable.responseText);	
//alert("AJAX is going to work.");
}


</script>

</head>

<body>
<p>&nbsp;</p>
<p><strong>对局结果报告</strong>PHP版</p>

<form name="frmInsertGame" id="frmInsertGame" action="insertgame.php" method="post">
<p>
  <label for="textdate">对局日期:</label>
  <input name="textdate" type="text" required="required" id="textdate">
(输入格式为：YYYY-MM-DD, 2016-10-08） </p>
<p>
  <label for="textfGmaeInfo">比赛名称:</label>
  <input type="text" name="textGameInfo" id="textGameInfo">
  （可选） </p>
<p>对局权重
  <label for="textfGmaeWeight">:</label>
  <input type="text" name="textGameWeight" id="textGameWeight"> 
  (比赛对局和带彩15，卫生棋10)
</p>
<p>
  <label for="textresult">A方:</label>
  <input type="text" name="textbplayer" id="textbplayer">
（必填）</p>
<p>
  <label for="textwplayer">B方:</label>
  <input type="text" name="textwplayer" id="textwplayer">
  （必填）</p>
<p>
  <label for="textresult	">结果（胜利方）:</label>
  <input type="text" name="textresult" id="textresult">
（A方赢填1, B方赢填0） </p>
<p>
  <label for="texthandicap">让子:</label>
  <input type="text" name="texthandicap" id="texthandicap">
（默认为0，让子时，A是必须是上手白棋让B，填正数） </p>
<p>
  <label for="textkomi">贴目:</label>
  <input type="text" name="textkomi" id="textkomi">
（默认7.5, A为白棋，B贴A填正数，A贴B填负数。）</p>
<p>让子让目均为A让B填正数，B让A填负数。系统自动换,算。</p>
<p>
  <input name="btn-submit" type="submit" id="btn-submit" value="提交对局结果">
</p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>



</body>
</html>