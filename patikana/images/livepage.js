//live page
jQuery(document).ready(function($) {
	$('#addmoreradio').hide();
	$('#more').click(function() {
		if($('#addmoreradio').is(':hidden')) {
			$('#addmoreradio').slideDown('slow').show('slow');
			$('#more').text('<<less');
		} else {
			$('#addmoreradio').slideUp('slow').hide('slow');
			$('#more').text('more >>');
		}

	});
	$(":input").keydown(function(event) {
		var keycode = event.keyCode ? event.keyCode : (event.which ? event.which : event.charCode);
		if(keycode == 13) {
			$("#searchbutton").click();
			return false;
		} else {
			return true;
		}
	});

	$('#register_form_link').click(function() {
		window.location = "Register_page.php";
	});

	$("#logoutlink").click(function() {
		$("#logout_dialogbox").dialog('open');
	});

	$('.account').hide();
	//Switch the status on and off
	$('#icon').click(function() {
		$('.account').toggle(350);
	});
	//Hide status if logout is clicked
	$('#logout').click(function() {
		$('.account').slideUp(350);
	});
	//Hide status if change settings is clicked
	$('#changesettings').click(function() {
		$('.account').slideUp(350);
		window.location = 'accountsettings.php';
	});

	$('.account').change(function() {
		$('.account').slideUp(350);
	});
	//login operations
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

	//ANNOUNCE LOST DIALOG
	$("#announcelostdialog").click(function() {
		$("#announcelost_dialog").dialog('open');
	});
	$("#announcelost_dialog").dialog({
		autoOpen : false,
		width : 'auto',
		show : 'explode',
		modal : true,
		overlay : {
			opacity : '0.5',
			background : '#6f9'
		},
		position : 'center center',
		minWidth : '310',
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
				var email = $("#email").val();
				var school = $("#school").val();
				var itemnumber = $("#itemnumber").val();
				var itemtype = $("#hiddentype").attr("value");
				if(location == '') {
					$('#error').addClass('error').html("please enter an location where the item was found");
				} else if(phonenumber == '') {
					$('#error').addClass('error').html("please enter a phone number");
				} else if(itemnames == '') {
					$('#error').addClass('error').html("please enter the names on the item");
				} else if(email == '') {
					$('#error').addClass('error').html("please enter an email adress");
				} else if(itemnumber == '') {
					$('#error').addClass('error').html("please enter the identification number on the item");
				} else if(itemtype == '') {
					$('#error').addClass('error').html("please select the type of document that you lost");
				} else if(location !== '' || phonenumber !== '' || itemnames !== '' || email !== '' || itemnumber !== '' || itemtype !== '') {
					$.post('announcelost.php', {
						itemtype : itemtype,
						itemnumber : itemnumber,
						locationlost : location,
						phonenumber : phonenumber,
						itemnames : itemnames, //names on the items
						email : email,
						school : school
					}, function(data) {
						if(data == '1') {
							$('#announcelost_dialog').dialog("close");
							$("#confirmannounce").dialog('open');
						} else if(data == '0') {
							$('#notannounced').dialog('open');
						}else if(data=='2'){
							$("#alreadyannounced").dialog('open');
						}
					});	//end of $.post();
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
		buttons : {
			'Ok' : function() {
				$("#confirmannounce").dialog('close');
			}
		},
		show : 'fade',
		open : function() {
			$(this).html("the item has been added to the live board");
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
		autoOpen:false,
		title:"ATTENTION",
		show:'fade',
		open:function(){
			$(this).html("It seems that item has already been announced lost");
		},
		buttons:{
			"I agree":function(){
				
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
				var rememberme=$("#rememberme").val();
				if(username == '' || password == '') {
					$("#loading").fadeTo(200, 0.1, function() {
						$(this).addClass('loginerror').text('enter a username and password').fadeTo(900, 1);
					});
				} else if(username != '' && password != '') {
					var counter = 0;
					$.post('login.php', {
						username : username,
						password : password,
						counter : counter,
						rememberme:rememberme
					}, function(data) {
						if(data == 'yes') {
							$("#loading").fadeTo(200, 0.1, function() {
								$(this).addClass('loginok').html('logging in...').fadeTo(900, 1, function() {
									window.location = 'Home.php';
								});
							});
						} else if(data == 'no') {
							$("#loading").fadeTo(200, 0.1, function() {
								$(this).removeClass().addClass('loginerror').text('login failure' + counter).fadeTo(900, 1);
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
				window.location = 'Home.php';
			}
		}

	});
	$(".create_account").click(function() {
		$(".create_account_dialog").dialog('open');
		$(".login_dialog").dialog('close');
	});
	//register account dialog
	$(".create_account_dialog").dialog({

		autoOpen : false,
		height : '500',
		width : '700',
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
		title : 'Account',
		open : function() {
			$(".create_account_dialog").load('register_content.html');
		},
		buttons : {
			'Create' : function() {
				function isValidEmailAddress(emailAddress) {
					var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
					return pattern.test(emailAddress);
				}

				var names = $('#names').val();
				var location = $('#location').val();
				var age = $('#age').val();
				var gender = $('#gender').val();
				var phoneno = $("#phoneno_id").val();
				var email = $('#email_id').val();
				var question = $('#question_id').val();
				var answer = $('#answer_id').val();
				var username = $('#username').val();
				var password = $('#password').val();
				var password1 = $('#password1').val();
				//function to check null values in the fields on button click
				var passone = document.getElementById('password').value;
				var passtwo = document.getElementById('password1').value;
				passone.parseInt
				passtwo.parseInt
				if(names == '') {
					$('.alerterror').addClass('error').html('enter your names seperated by spaces names').show();
					$('#names').addClass('bordered');
				} else if(location == '') {
					$('.alerterror').addClass('error').html('enter your current location').show();
					$('#location').addClass('bordered');
				} else if(age == '') {
					$('.alerterror').addClass('error').html('enter your current age');
					$('#age').addClass('bordered');
				} else if(username == '') {
					$('.alerterror').addClass('error').html('enter your preferred username').show();
					$('#username').addClass('bordered');
				} else if(password == '') {
					$('.alerterror').addClass('error').html('enter your preferred password').show();
					$('#password').addClass('bordered');
				} else if(password1 == '') {
					$('.alerterror').addClass('error').html('re-enter your preferred password').show();
					$('#password1').addClass('bordered');
				} else if(passone != passtwo) {
					$('.alerterror').addClass('error').html('password not matching').show();
					$('#password').addClass('bordered');
					$('#password1').addClass('bordered');

				} else if(email == '') {
					$(".alerterror").addClass('bordered').html('please enter an email adress');

				} else if(phoneno == '') {
					$('.alerterror').addClass('bordered').html("please enter a phone number");
				} else if(question == '') {
					$('.alerterror').addClass('bordered').html("please enter a question to help you recover your account");
				} else if(answer == '') {
					$('.alerterror').addClass('bordered').html('please enter an answer to the question above');
				}// else if(avalilability) {
				//$('.alerterror').addClass('bordered').html('please select another username');
				//}
				else if(!isValidEmailAddress(email)) {
					$('#alerterror').addClass('error').html('enter a valid email adress').show();
					$('#email').addClass('bordered');
				} else {
					//register using ajax
					$.post('register.php', {
						names : names,
						username : username,
						location : location,
						gender : gender,
						age : age,
						phoneno : phoneno,
						email : email,
						question : question,
						answer : answer,
						password : password

					}, function(data) {
						if(data == "1") {
							$(".create_account_dialog").dialog('close');
							$("#sucess_dialog").dialog('open');
						} else {
							$("#fail_dialog").dialog('open');
							$(".create_account_dialog").dialog('close');
						}
					});
				}

			},
			'Cancel' : function() {
				$(this).dialog('close');
			}
		}
	});

	$("#sucess_dialog").dialog({
		autoOpen : false,
		title : "Account",
		show : 'fade',
		draggable : false,
		modal : true,
		overlay : {
			background : '#6f9',
			opacity : '0.5'
		},
		open : function() {
			$(this).html("you have sucessfully setup an account an Account will enable you to report lost documents found.<p/>Please login");
		},
		buttons : {
			'Login' : function() {
				$(this).dialog("close");
				$(".login_dialog").dialog("open");
			}
		}
	});
	$("#fail_dialog").dialog({
		autoOpen : false,
		title : "Account",
		show : 'fade',
		draggable : false,
		modal : true,
		overlay : {
			background : '#6f9',
			opacity : '0.5'
		},
		open : function() {
			$(this).html("Oops! looks we have a problem creating the account.Please try again later");
		},
		buttons : {
			'Close' : function() {
				$(this).dialog("close");
			}
		}
	});

	/*
	$.post('ads/ads_fetcher.php', {
			r : "set"
		}, function(data) {
			var adsdata = data.split(".");
			var ad1 = adsdata[0].toString();
			var ad2 = adsdata[1].toString();
			$.get("ads/ads_fetcher.php", {
				ad1 : ad1,
				ad2 : ad2
			}, function(data) {
				$("#ad_panel").html(data);
			});
		});*/
	$(window).resize(function(){
					var width=$(this).width();
					var height=$(this).height();			
					$("#parameter").val(width+"px");
					
				});
});
