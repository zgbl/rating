<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>MatchArrangement</title>
</head>
<script type="text/javascript">
function popmore() {
	var opt = document.createElement("option");
	//var textnode1 = "whatever I add" ;
	//var tn1 = document.createTextNode("someth");
	var ttt = "JJJJ";
	opt.appendChild(document.createTextNode(ttt));
	opt.value="OptValue";
	
	var sel3 = document.getElementById("select3");
	sel3.appendChild(opt);
	}

</script>

<body>
<p>比赛对阵安排</p>
<p>先选取队名，然后下面下拉框中自动生成这个队的队员列表。队长在列表中选择这个台次的队员。</p>
<table width="402" border="1">
  <tbody>
    <tr>
      <td width="150" align="center"><label for="select">对阵A队:</label>
        <select name="select" id="select" onChange="popmore();">
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
      <td width="150" align="center"><label for="select2">对阵B队:</label>
        <select name="select2" id="select2">
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
      <td align="center"><label for="select3">A队1台:</label>
        <select name="select3" id="select3">
      </select></td>
      <td align="center"> Vs</td>
      <td align="center"><label for="select4">B队1台:</label>
        <select name="select4" id="select4">
      </select></td>
    </tr>
    <tr>
      <td align="center"><label for="select5">A队2台:</label>
        <select name="select5" id="select5">
      </select></td>
      <td>&nbsp;</td>
      <td align="center"><label for="select6">B队2台:</label>
        <select name="select6" id="select6">
      </select></td>
    </tr>
    <tr>
      <td align="center"><label for="select7">A队3台:</label>
        <select name="select7" id="select7">
      </select></td>
      <td>&nbsp;</td>
      <td align="center"><label for="select8">B队2台:</label>
        <select name="select8" id="select8">
      </select></td>
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
<p>
  <input type="button" name="btnAddTable" id="btnAddTable" value="添加台次">
</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>
