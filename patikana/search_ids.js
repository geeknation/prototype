/*
 JavaScript Ajax Document for searching lost items
 Entel limited all rights reserved
 */
		// var str=$("#q").val();
		// searchId(str);
	// });
	 var selected=Idspecify();
	 if(selected=='nationalid')
	 {
	 showresult(str,'search_ids.php');
	 }
	 else if(selected=='schoolid')
	 {
	 showresult(str,'search_school_ids.php');
	 }
	 else if(selected=='atm')
	 {
	 showresult(str,'search_atm.php');
	 }
	 else if(selected=='passport')
	 {
	 showresult(str,'search_passport.php');
	 }
	 else if(selected=='otheritems')
	 {
	 showresult(str,'search_otheritems.php');
	 }
	 else
	 {
	 return false;
	 }
	 */

{
	//var selected;
}
//main method
function showresult(str, script) {
	if(xmlHttp == null) {
		alert("Browser does not support HTTP Request");
		return;
	}
	var url = script;
	xmlHttp.onreadystatechange = stateChanged;
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
}
	if(xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
		document.getElementById("contentloader").innerHTML = xmlHttp.responseText;
	}
}
	var xmlHttp = null;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp = new XMLHttpRequest();
	} catch (e) {
		//Internet Explorer
		try {
		} catch (e) {
		}
	}
	return xmlHttp;
}