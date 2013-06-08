/*
 JavaScript Ajax Document for searching lost items
 Entel limited all rights reserved
 */
function searchId(str) {	if(str!='' || str!=null){		$.post("search_locate.php", {		value : str	}, function(data) {		$("#livestreamcontent").hide();		$("#searchresult").html(data);		switches.liveboardswitch=false;	});	}	/*
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
}function Idspecify(v)//_api
{
	//var selected;
}var xmlHttp;
//main method
function showresult(str, script) {	xmlHttp = GetXmlHttpObject();
	if(xmlHttp == null) {
		alert("Browser does not support HTTP Request");
		return;
	}	script += "";	//converting to string
	var url = script;	url = url + "?q=" + str;	url = url + "&sid=" + Math.random();
	xmlHttp.onreadystatechange = stateChanged;
	xmlHttp.open("GET", url, true);
	xmlHttp.send(null);
}function stateChanged() {
	if(xmlHttp.readyState == 4 || xmlHttp.readyState == "complete") {
		document.getElementById("contentloader").innerHTML = xmlHttp.responseText;
	}
}function GetXmlHttpObject() {
	var xmlHttp = null;
	try {
		// Firefox, Opera 8.0+, Safari
		xmlHttp = new XMLHttpRequest();
	} catch (e) {
		//Internet Explorer
		try {			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e) {			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}