<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>AJAX Test 2</title>
<script type = "text/javascript">
//alert("window.XMLHttpRequest is: " + window.XMLHttpRequest);


function sayhello() {
xmlhttp_request = new XMLHttpRequest();

if (xmlhttp_request == null) {
	alert("XMLHttpRequest has problem.")
}
	else 
	{
//	alert("XMLHttpRequest is OK." + xmlhttp_request)
}

	
//	alert( "Hello!")
//var url = "test.txt";
var url = "test.txt";
var txt = document.getElementById("textfield");
var ddd2 = document.getElementById("Div1");
var ppp1 = document.createElement("p");
ppp1.innerHTML = "添加的内容";
ddd2.appendChild(ppp1);

//txt.value =  "我活着";
xmlhttp_request.open("POST", url,true)
xmlhttp_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

xmlhttp_request.onreadystatechange = function(){ //处理响应
txt.value =  xmlhttp_request.responseText;
alert("readystats is: " + xmlhttp_request.readyState );
alert("status is: " + xmlhttp_request.status );

}


}

xmlhttp_request.send(null);


</script>


</head>

<body>
<p>&nbsp;</p>
<p>AJAX Test2 </p>
<p>
  <label for="textarea">Text Area:</label>
</p>
<p>
  <input type="button" name="button" id="button" onClick="sayhello()" value="Say Hello">
</p>
<p>
  <textarea name="textarea" id="textarea"></textarea>
</p>
<p>
  <label for="textfield">Text Field:</label>
  <input name="textfield" type="text" id="textfield" value="value11">
</p>
<p>
  <input type="submit" name="submit" id="submit" value="Submit">
</p>
<div id="Div1">Content for  id "Div1" Goes Here</div>
<p>&nbsp;</p>


</body>
</html>