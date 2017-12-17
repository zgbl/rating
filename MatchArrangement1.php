<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>MatchArrangement</title>
</head>
<script type="text/javascript">
function poptest() {
//alert("This is a test");
//var HHH = document.getElementById("select").value;
//alert("HHH是: ". HHH);
var KKK = document.getElementById("select").value;
alert (KKK);

}

function popmore() {
//	alert("开始了吗？");	
	xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange=function()
	{
//	alert( "在括号里，再显示一次：队名是：" + TeamNM);
//	alert ("readystats is: " + xmlhttp.readyState);
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		
	//	var RespText = xmlhttp.responseText;
	//	alert (JSON.TeamMembers);
	//	alert (RespText);
	//	var RespTextDC = JSON.parse(RespText);
	//	alert (RespTextDC);
	
	//	var KKK = RespText[0].TeamMemberID;
		
	//	alert (RespText[0]); 
		
		 document.getElementById("ShowMB").innerHTML= xmlhttp.responseText; 	
		 
	//	var HHH = eval(xmlhttp.responseText);
	//	var HHH = new Array();
	
	<?php
	
	//	echo $_POST[selTeamA];
	//	echo "UUUUUU";
	
	?>
		var arr1 = [
		<?php
		@mysql_connect("localhost","root","aiyi123")
		or die("DB Connection Failed...");

		@mysql_select_db("AiYiWeiqi")
		or die("AiYiWeiqi DB not working");

		mysql_query("set name gb2312");
	//尝试获取参数
	//	$TName = $_GET["selTeamA"];	
		$TName = $_GET["select2"];	
	//	$TName = "梅花";	
		
		
	//	$sql5 = "select TeamMemberID from Teams Where TeamName = '方块'; ";
		$sql5 = "select TeamMemberID from Teams Where TeamName = '".$TName . "'; ";
	//	print($sql5);
	//	$query = mysql_query("select TeamMemberID from Teams Where TeamName = '".$_POST[selTeamA]. "'; ");
		$query = mysql_query($sql5);
	//	$query = mysql_query("select TeamMemberID from Teams Where TeamName = '方块'; ");
		while ( $MDD = mysql_fetch_array($query)) {
		$MDD_ID = $MDD["TeamMemberID"];
		echo "'$MDD_ID',";	
		}
		?>	
		];
		
	//	 HHH = xmlhttp.responseText;
	//	 alert (arr1);
	//	 var TTT = JSON.parse(arr1);
	//	 alert (TTT[2]);
	//	 document.getElementById("ShowMB").innerHTML= RespTextDC.TeamMembers; 
	var opt1 = document.createElement("option");

	//var arraylen = array1.length  
	var sel3 = document.getElementById("select3");
	sel3.options.length = 0;
	for ( var i = 0; i < 3; i++)  {	
	//alert(TTT[i]);
	sel3.options.add(new Option(arr1[i],i));
	}
		}	
	}
	
var TeamNM = document.getElementById("selTeamA").value;
//	if (TeamNM =="") { 
//	alert("队名是空的");
//		}
		 
//	alert( "队名是：" + TeamNM);

//	var url = "PHP/QueryTeamMember.php?TeamNM='" + TeamNM + "'";
//	alert (url);
	
//	xmlhttp.open("POST", url, true);
	xmlhttp.open("POST","PHP/QueryTeamMember.php?TeamNM='" + TeamNM + "'", true);
//	xmlhttp.open("POST","PHP/QueryTeamMember1.php", true);
	xmlhttp.send();	
	
//	var opt = document.createElement("option");
	
//	var ttt = "JJJJ";
//	alert(ttt);
//	opt.appendChild(document.createTextNode(ttt));
//	opt.value="OptValue";
	
//	var sel3 = document.getElementById("select3");
//	sel3.appendChild(opt);
	
}

function popOptionTest() {
	var array1 = ["A11111", "A22222", "A33333"];
//	alert (array1[1]);
//	var opt = new Option("dahioa",3);  //如何声明一个新option?
	var opt1 = document.createElement("option");

	var arraylen = array1.length   // 试过了，没问题	
	var sel3 = document.getElementById("select3");
//	sel3.options.add(opt1);

	
	for ( var i = 0; i<arraylen; i++)  {
//	opt1.appendChild(document.createTextNode(array1[i]));	
	sel3.options.add(new Option(array1[i],i));
	}
//	alert (arraylen);
	
}

</script>




<body>
<p>比赛对阵安排</p>
<p>先选取队名，然后下面下拉框中自动生成这个队的队员列表。队长在列表中选择这个台次的队员。</p>
<form id="form1" name="form1" method="post">
  <table width="402" border="1">
    <tbody>
      <tr>
        <td width="150" align="center"><label for="selTeamA">对阵A队:</label>
          <select name="selTeamA" id="selTeamA" onChange="popmore();">
            <?php
$con = mysql_connect("localhost","root","aiyi123");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("AiYiWeiqi", $con);
mysql_query("set name gb2312");
$sqlselect = "select DISTINCT TeamName from Teams; ";
$rs =  mysql_query($sqlselect);
$rowcount = mysql_num_rows($rs);
$row = mysql_fetch_array($rs);
$i = 0;
while( $i < $rowcount)
{ 
echo "<option>". mysql_result($rs, $i, 0) . "</option>";
$i++;
}
?>
          </select></td>
        <td width="50">&nbsp;</td>
        <td width="150" align="center"><label for="selTeamB">对阵B队:</label>
          <select name="selTeamB" id="selTeamB">
            <?php
$sqlselect = "select DISTINCT TeamName from Teams; ";
$rs =  mysql_query($sqlselect);
$rowcount = mysql_num_rows($rs);
$row = mysql_fetch_array($rs);
$i = 0;
while( $i < $rowcount)
{ 
echo "<option>". mysql_result($rs, $i, 0) . "</option>";
$i++;
mysql_close();
}
?>
          </select></td>
      </tr>
      <tr>
        <td align="center"><label for="select3">A队队员:</label>
          <select name="select3" id="select3">
          </select></td>
        <td align="center">Vs</td>
        <td align="center"><label for="select4">B队队员:</label>
          <select name="select4" id="select4">
          </select></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </tbody>
  </table>
  <label for="select2">TestSel:</label>
  <select name="select2" id="select2" form="form1">
    <option>方块</option>
    <option>黑桃</option>
  </select>
  <input type="button" name="btnCheckTeamM" id="btnCheckTeamM" value="查队员" onClick="CheckTeamM();">
  <p>
    <input type="button" name="btnAddTable" id="btnAddTable" value="添加台次">
    <input type="button" name="button" id="button" value="ForTest" onClick="popOptionTest();" >
  </p>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>
  <label for="select">Select:</label>
  <select name="select" id="select" onChange="popmore();" >
    <option>AAA</option>
    <option>BBB</option>
    <option>CCC</option>
  </select>
</p>
<div id="ShowMB">Content for  id "ShowMB" Goes Here </div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
