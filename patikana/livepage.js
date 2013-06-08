jQuery(document).ready(function($) {
	$("#q").attr("autocomplete", "off");
	loadLiveStream();
	$('#register_form_link').click(function() {
		window.location = "Register_page.php";
	});
	$("#logoutlink").click(function() {
		$("#logout_dialogbox").dialog('open');
	});
	$("#report_id").click(function() {

		var a = $('#item_serial').val();

		var b = $('#item_name').val();

		var c = $('#announcer').val();

		var d = $('#phneno').val();

		var e = $('#email').val();

		$.post('save.php', {

			item_serial : a,

			item_name : b,

			announcer_name : c,

			phoneNo : d,

			emailAdd : e

		}, function(data) {

			if(data == 'sucess') {

				window.alert("Success your item has been saved");

			} else {

				window.alert("Fill all the fields and resubmit");

			}

		});
	});

	$("#login_user").click(function() {

		$(".login_dialog").dialog('open');

	});
	$(".login_dialog").dialog({

		autoOpen : false,

		height : 'auto',

		width : 'auto',

		show : 'fade',

		modal : true,

		overlay : {

			opacity : '0.5',

			background : '#6f9'

		},

		position : 'center',

		minWidth : '310',

		minHeight : '290',

		draggable : false,

		resizable : false,

		title : 'Log In',

		open : function() {

			$(".login_dialog").load('login_content.html').html();

		},
		buttons : {

			'Login' : function() {

				var username = $("#username").val();

				var password = $("#password").val();

				var rememberme = $("#rememberme").val();

				if(username == '' || password == '') {

					$("#loading").fadeTo(200, 0.1, function() {

						$(this).addClass('alert alert-warning').text('enter a username and password').fadeTo(900, 1);

					});
				} else if(username != '' && password != '') {

					var counter = 0;

					$.post('login.php', {

						username : username,

						password : password,

						counter : counter,

						rememberme : rememberme

					}, function(data) {

						if(data == 'yes') {

							$("#loading").fadeTo(200, 0.1, function() {

								$(this).removeClass().addClass('alert alert-success').html('logging in...').fadeTo(900, 1, function() {

									window.location = 'index.php';

								});
							});
						} else if(data == 'no') {

							$("#user_alert").fadeTo(200, 0.1, function() {
								$(this).removeClass().addClass('alert alert-error').text('incorrect username/password').fadeTo(900, 1);
							});
						} else if(data == 'max tries') {

							$(".login_dialog").html('YOU HAVE REACHED MAXIMUM TRIES');

						}

					});
				}

			},
			'Cancel' : function() {

				$(this).dialog('close');

				window.location = 'Home.php';

			}
		}

	});

	//LOGOUT DIALOG BOX
	$("#logout_dialogbox").dialog({

		autoOpen : false,

		draggable : false,

		show : 'fade',

		modal : true,

		resizable : false,

		overlay : {

			opacity : '0.5',

			background : '#6f9'

		},

		title : 'Logout',

		open : function() {

			$("#logout_dialogbox").html("ARE YOU SURE YOU WANT TO LOG OUT?");

		},
		buttons : {

			'Ok' : function() {

				$("#logout_dialogbox").dialog('close');

				window.location = 'logout.php';

			},
			'Cancel' : function() {

				$("#logout_dialogbox").dialog('close');

			}
		}

	});
	/*
	 * report found dialog
	 */
	$("#reportfound").click(function() {
		$(".reportfounddialog").dialog('open');
	});

	$(".reportfounddialog").dialog({
		autoOpen : false,
		title : "Found document",
		modal : true,
		overlay : {

			opacity : '0.5',

		},
		draggable : false,
		minWidth : '410',
		minHeight : '290',
		open : function() {
			$(".reportfounddialog").load("reportfound.php");
		},
		buttons : {
			"Save" : function() {

				var type = $('#itemtypesave').val();
				var names = $.trim($('#names').val());
				var itemnumber = $.trim($('#itemnumber').val());
				var locationfound = $.trim($('#locationfound').val());

				//Check validity of input
				if(type == "Click here to select:") {
					$('#notification').text("Select an item type").addClass("alert alert-warning").fadeTo(2000, 1).fadeOut(2000);
				}

				if(type == "National ID") {
					//Include some other in null check
					if(names == "" || itemnumber == "" || locationfound == "") {

						$('#notification').addClass("alert alert-warning").html("Fill in all fields").fadeTo(3000, 1).fadeOut(2000);
					} else {

						//Save the data -- Send post to request.php with rq_id of 5
						var type = $('#itemtypesave').val();
						var names = $.trim($('#names').val());
						var itemnumber = $.trim($('#itemnumber').val());
						var locationfound = $.trim($('#locationfound').val());

						$.post("reportfoundsave.php", {
							type : type,
							names : names,
							itemnumber : itemnumber,
							locationfound : locationfound
						}, function(returndata) {
							$("#notification").html(returndata).fadeTo(3000, 1).fadeOut(2000);
							//Empty input values

							//Restore button caption
						});
					}//End inner else -- if for null check with other inclusive
				}

				if(type == "School ID" || type == "ATM card" || type == "Driving licence" || type == "Passport" || type == "Some other") {
					var type = $('#itemtypesave').val();
					var other = $('#someother').val();
					var names = $.trim($('#names').val());
					var itemnumber = $.trim($('#itemnumber').val());
					var locationfound = $.trim($('#locationfound').val());

					if(other == "" || names == "" || itemnumber == "" || locationfound == "") {

						$('#notification').css({
							color : 'red',
							opacity : '0'
						}).html("Fill in all fields").fadeTo(3000, 1).fadeOut(2000);
					} else {

						$.post("reportfoundsave.php", {
							type : type,
							names : names,
							other : other,
							itemnumber : itemnumber,
							locationfound : locationfound
						}, function(data) {
							$("#notification").html(data).fadeTo(3000, 1).fadeOut(2000);
						});
					}//End inner else--if for null check without other
				}
				//End if for type check

				//alert(type+" "+other+" "+names+" "+itemnumber+" "+locationFound);

			},
			"close" : function() {
				$(this).dialog("close");
			}
		}
	});

	//ANNOUNCE LOST DIALOG

	$("#announcelost").click(function(e) {
		e.preventDefault();
		$("#announcelost_dialog").dialog('open');

	});

	$("#announcelost_dialog").dialog({

		autoOpen : false,

		width : 'auto',

		show : 'fade',

		modal : true,

		overlay : {

			opacity : '0.5',

		},

		position : 'center center',

		width : '500',

		minHeight : '290',

		draggable : false,

		resizable : false,

		title : 'Announce a Lost Item',

		open : function() {

			$("#announcelost_dialog").load('announce_lost_content.html').html();

		},
		buttons : {

			'Announce' : function() {

				var location = $("#locationlost").val();

				var phonenumber = $("#phoneno").val();

				var itemnames = $("#fullnames").val();

				var email = $("#emailadd").val();

				var itemnumber = $("#serialnumber").val();

				var itemtype = $("#announceitemtype").val();

				var other = $("#extrainfo").val();

				if(location == '') {

					$('#error').addClass('alert alert-error').html("please enter an location where the item was found");

				} else if(phonenumber == '') {

					$('#error').addClass('alert alert-error').html("please enter a phone number");

				} else if(itemnames == '') {

					$('#error').addClass('alert alert-error').html("please enter the names on the item");

				} else if(email == '') {

					$('#error').addClass('alert alert-error').html("please enter an email adress");

				} else if(itemnumber == '' || itemnumber == null) {

					$('#error').addClass('alert alert-error').html("please enter the identification number on the item");

				} else if(itemtype == 'Click to select:') {

					$('#error').addClass('alert alert-error').html("please select the type of document that you lost");

				} else {

					$.post('announcelost.php', {

						itemtype : itemtype,

						itemnumber : itemnumber,

						locationlost : location,

						phonenumber : phonenumber,

						names : itemnames, //names on the items

						other : other,

						email : email,

					}, function(data) {

						if(data == 'item announced') {

							$(this).dialog("close");

							$("#confirmannounce").dialog('open');

						} else if(data == 'not announced') {

							$('#notannounced').dialog('open');

						} else if(data == 'document already announced lost') {

							$("#alreadyannounced").dialog('open');

						}

					});
					//end of $.post();

				}

				//end of else

			},
			'Close' : function() {

				$(this).dialog('close');

			}
		}

	});

	$("#confirmannounce").dialog({
		autoOpen : false,
		title : "item announced",
		modal : true,
		buttons : {

			'Ok' : function() {

				$("#confirmannounce").dialog('close');

			}
		},

		show : 'fade',

		open : function() {

			$(this).html("Thank you for notifying us on youy lost Document,You will be alerted when its located");

		}
	});

	$("#notannounced").dialog({

		autoOpen : false,

		title : "Error",

		buttons : {

			'Ok' : function() {

				$("#announcelost_dialog").dialog('close');

			}
		},

		show : 'fade',

		open : function() {

			$(this).html("an error has occurred acessing the liveboard,please try again later");

		}
	});

	$("#alreadyannounced").dialog({

		autoOpen : false,

		title : "ATTENTION",

		show : 'fade',

		open : function() {

			$(this).html("It seems that item has already been announced lost");

		},
		buttons : {

			"I agree" : function() {

				$(this).dialog('close');

			}
		}

	});

	//login dialog box

	$(".login_dialog").dialog({

		autoOpen : false,

		height : 'auto',

		width : 'auto',

		show : 'fade',

		modal : true,

		overlay : {

			opacity : '0.5',

			background : '#6f9'

		},

		position : 'center',

		minWidth : '310',

		minHeight : '290',

		draggable : false,

		resizable : false,

		title : 'Log In',

		open : function() {

			$(".login_dialog").load('login_content.html').html();

		},
		buttons : {

			'Login' : function() {

				var username = $("#username").val();

				var password = $("#password").val();

				var rememberme = $("#rememberme").val();

				if(username == '' || password == '') {

					$("#loading").fadeTo(200, 0.1, function() {

						$(this).addClass('alert alert-error').text('enter a username and password').fadeTo(900, 1);

					});
				} else if(username != '' && password != '') {

					var counter = 0;

					$.post('login.php', {

						username : username,

						password : password,

						counter : counter,

						rememberme : rememberme

					}, function(data) {

						if(data == 'yes') {

							$("#loading").fadeTo(200, 0.1, function() {

								$(this).addClass('loginok').html('logging in...').fadeTo(900, 1, function() {

									window.location = 'index.php';

								});
							});
						} else if(data == 'no') {

							$("#loading").fadeTo(200, 0.1, function() {

								$(this).removeClass().addClass('alert alert-error').text("Username/Password incorrect").fadeTo(900, 1);
								counter = counter + 1;

							});
						} else if(data == 'max tries') {

							$(".login_dialog").html('YOU HAVE REACHED MAXIMUM TRIES');

						}

					});
				}

			},
			'Cancel' : function() {

				$(this).dialog('close');

				window.location = 'index.php';

			}
		}

	});

});
/********************************************************
 LIVESTREAM
 ********************************************************/
var switches = {
	//CONTROL VARIABLE THAT ENSURES THAT RECORDS ARE FETCHED IF THERE NEW RECORDS ONLY
	valve : false,
	//CONTROL VARIABLE THAT STARTS AND STOPS THE CHECKING OF NEW RECORDS.
	liveboardswitch : true
}
window.onload = function() {
	if(switches.liveboardswitch == true) {
		window.setInterval("getRecentActivities()", 6000);
	}
}

$(window).scroll(function() {
	var scrollHeight=$(window).scrollTop();
	var windowHeight=$(window).height();
	var documentHeight=$(document).height();
	
	if((scrollHeight+windowHeight)>documentHeight-200){
		loadOnScroll();
	}else{
		loadOnScroll();
	}
});
//get the intital stream activity
function loadLiveStream() {
	$.get("livestream_init.php", {
		starter : "1"
	}, function(data) {
		var mix = data.split("*");
		var d = mix[0];
		//the data to be displayed
		var params = mix[1].split("#");
		var count = params[0];
		var pointer = params[1];

		//where the pointer is.
		$("#last_count").val(count);
		$("#id").val(count);
		//the total number of records
		$("#livestreamcontent").html(d);

	});
}

//get the activities in real time.
function getRecentActivities() {

	//check first if the database has new records
	$.get('livestream.php', {
		flag : "check",
		oldrecords : $("#last_count").val()
	}, function(data) {
		//$("#resp").attr("value", data);
		if(data == "new records") {
			switches.valve = true;
			fetchNewRecords();
		} else {
			switches.valve = false;
		}
	});
}

function fetchNewRecords() {
	if(switches.valve == true) {
		$.post("livestream.php", {
			last_count : $("#last_count").val()
		}, function(data) {
			if(data != "" || data != null) {
				var mix = data.split(".");
				//data from livestream.php
				var d = mix[0];
				//the row to be displayed

				var latestcount = mix[1];
				//new number of rows
				var lastcount = $("#last_count").val();
				var diff = parseInt(latestcount) - parseInt(lastcount);
				if(parseInt(latestcount) > parseInt(lastcount)) {
					$("#last_count").val(latestcount);

					//format the data for viewing
					var elems = d.split("&nbsp;");

					var action = elems[0];
					var time = elems[1];
					var person = elems[2];
					var location = elems[3];
					var item = elems[4];
					var face = '';
					if(action == "Searched") {
						face = "<div  style='overflow:hidden;' class='livestream_tile'><img src='images/users.png' width='30' height='30'/>" + person + " has " + action + " for their " + item + "near" + location + "<div class='clock'><small><cite>" + time + " ago</cite></small></div></div>";
					}
					if(action == "found") {
						face = "<div  style='overflow:hidden;' class='livestream_tile'><img src='images/users.png' width='30' height='30'/>" + " a " + item + " has been " + action + "near" + location + "<div class='clock'><small><cite>" + time + " ago</cite></small></div></div>";
					}
					$("#livestreamcontent").fadeTo(200, 0.1, function() {
						$(this).fadeTo(900, 1, function() {
							$(this).prepend(face);
						});
					});
				}
			}

		});
	} else {

	}

}

function loadOnScroll() {
	var displayed = $("#recordsdisplayed").val();
	// var pointer=$("#pointer")
	//$("#livestreamcontent").children().length;
	$.get('loadonscroll.php', {
		displayed : displayed
		// pointer : pointer
	}, function(data) {
		//data from livestream.php
		var mix = data.split(".");
		//the row to be displayed
		var d = mix[0];

		var diplayedrecords = mix[1];
		var newrecordpointer = mix[2];
		var elems = d.split("&nbsp;");
		var action = elems[0];
		var time = elems[1];
		var person = elems[2];
		var location = elems[3];
		var item = elems[4];
		if(action == "Searched") {
			face = "<div  style='overflow:hidden;' class='livestream_tile'><img src='images/users.png' width='30' height='30'/>" + person + " has " + action + " for their " + item + "near" + location + "<div class='clock'><small><cite>" + time + " ago</cite></small></div></div>";
			$("#livestreamcontent").append(face);
		}
		if(action == "found") {
			face = "<div style='overflow:hidden; margin-top:2%' class='livestream_tile'><img src='images/users.png' width='30' height='30'/>" + " a " + item + " has been " + action + "near" + location + "<div class='clock'><small><cite>" + time + " ago</cite></small></div></div>";
			$("#livestreamcontent").append(face);
		}
		$("#loadscrollpointer").attr("value", diplayedrecords);
		$("#recordsdisplayed").attr("value", diplayedrecords);
	});
}

/*****************************************************************************

 ****************************************************************************/