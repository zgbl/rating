// JavaScript Document
function showgames(str) {
//	if (str=="")
//	{
//	}
	
	//if (window.XMLHttpRequest)
	//{
	//IE， Firefox, Chrome, Opera, Safari 浏览器执行代码
	var xmlhttp = new XMLHttpRequest();
	
	//}
	//else 
	//｛
	// IE6, IE5 浏览器执行代码 （其实基本已经没有必要)
	//xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	//}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState===4 && xmlhttp.status===200)
		{
		document.getElementById("showstatus").innerHTML=xmlhttp.readyState;
		alert(xmlhttp.status);
		document.getElementById("ShowGameList").innerHTML=xmlhttp.responseText;	
		//document.getElementById("ShowGameList").innerHTML="Gamelist will be here.";	
		}
	};
	xmlhttp.open("GET","gamequery.php", true);
	xmlhttp.send();

}

