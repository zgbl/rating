<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>AJAX Example</title>


<script>
function ajax_post(){
    // Create our XMLHttpRequest object
    var hr = new XMLHttpRequest();
    // Create some variables we need to send to our PHP file
    var url = "my_parse_file.php";
	//var url = "test.php";
	
    var fn = document.getElementById("first_name").value;
    var ln = document.getElementById("last_name").value;
    var vars = "firstname="+fn+"&lastname="+ln;
    hr.open("POST", url, true);
	
    // Set content type header information for sending url encoded variables in the request
    hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
	
	
    hr.onreadystatechange = function() {
	    if(hr.readyState == 4 && hr.status == 200) {
		    var return_data = hr.responseText;
		//	document.getElementById("status").innerHTML = return_data;
			document.writeln(return_data);
			alert("responseText is: " + return_data);
		//	alert("readystats is: " + hr.readyState );
		//	alert("status is: " + hr.status );
	    }
    }
    // Send the data to PHP now... and wait for response to update the status div
    //hr.send(vars); // Actually execute the request
	hr.send(null);
    document.getElementById("status").innerHTML = "processing...";
	
}
</script>
</head>
<body>
<h2>Ajax Post to PHP and Get Return Data</h2>
<p><br>
</p>
<form id="form1" name="form1" method="post" action="">
  <p>First Name:
  <input id="first_name" name="first_name" type="text"/>
    <br>
    <br>
    Last Name:
  <input id="last_name" name="last_name" type="text">
  <br>
  <br>
  <input name="myBtn" type="submit" value="Submit Data" onClick="ajax_post();">
    <input type="button" name="button" id="button" value="提交2" onClick="ajax_post();">
  </p>
  <p>&nbsp;</p>
  <p>
    <label for="textfield">Text Field:</label>
    <input type="text" name="textfield" id="textfield"/>
  </p>
  <p>&nbsp;</p>
</form>
<p><br>
</p>
<div id="status"></div>
</body>
</html>