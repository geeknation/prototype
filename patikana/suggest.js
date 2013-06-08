jQuery(document).ready(function($){
	$('.link:odd').addClass("stripe");
});
function getSuggestions(value) {
	if(value != "") {
		//specifying the script and posting data to the script
		var option;
		$.get('suggest.php', {
			value : value
		}, function(data) {
			if(data.length > 5) {
				$(".suggestions").html(data);
			} else {
				$(".suggestions").html("<div id='tellus'>Seems we have not yet found your item<br/><input type='button' class='button btn-large' id='s_announce' value='Tell us you lost your item' onclick='_announceUI()'/></div>");
			}
		});
		/*
		 if (option == 'nationalid') {
		 main('national_ids', value);
		 } else if (option == 'schoolid') {
		 main('school_ids', value);
		 } else if (option == 'passport') {
		 main('passports', value);
		 } else if ( option = 'atm') {
		 main('atm_cards', value);

		 }
		 */
	} else {
		removeSuggestions();
	}
}

function removeSuggestions() {
	$('.suggestions').html("");
	undoCss();
}

function addText(value) {
	$('#q').val(value);
	$("#search_button").click();
}

function doCss() {
	$('.suggestions').css({
		'border' : 'solid #f1f1f1',
		'border-width' : '1px',
		'border-top' : 'none'
	});
}

function undoCss() {
	$('.suggestions').css({
		'border' : '',
		'border-width' : '0px'
	});
}


function _closes(a, b) {
	$(a).click(function() {
		$(b).hide();
	});
}//End function closes

function _announceUI() {
	$("#announcelost_dialog").dialog('open');
}//End function announceItem

function _saveAnnounce() {
	$('table tr td span input#save').click(function() {
		//Get values from announce
		var type = $('table tr td select#itemtype').val();
		var names = $('table tr td input#fullnames').val();
		var other = $('table tr td input#other').val();
		var serial = $('table tr td input#serial').val();
		var phoneno = $('table tr td input#phoneno').val();
		var emailadd = $('table tr td input#emailadd').val();

		//Check for null entries
		if(type == "Click here to select:") {
			//Show notification of no item selected
			$('div span#notification').css({
				color : 'red',
				opacity : '0'
			}).html("Select an item type").fadeTo(3000, 1).fadeOut(5000);
		} else if(type == "School ID" || type == "ATM card" || type == "Some other" || type == "Passport") {
			//Include other in null check
			if(names == "" || serial == "" || phoneno == "" || emailadd == "" || other == "") {
				$('div span#notification').css({
					color : 'red',
					opacity : '0'
				}).html("Fill in all fields").fadeTo(3000, 1).fadeOut(5000);
			} else if(_emailValid(emailadd) == false) {
				$('div span#notification').css({
					color : 'red',
					opacity : '0'
				}).html("Email format incorrect").fadeTo(3000, 1).fadeOut(5000);
			} else {
				//Post the data with other
				$.post("request.php", {
					rq_id : 3,
					type : type,
					names : names,
					other : other,
					serial : serial,
					phoneno : phoneno,
					emailadd : emailadd
				}, function(data) {
					//Show notification of successful save
					$("#confirmannounce").dialog("open");
					//Empty input values
					$('input[type=text]').val("");

					//Restore button caption
					//$('table tr td span input#save').val("Announce");
				});
				//alert(type+" "+names+" "+serial+" "+lostLocation+" "+phoneno+" "+emailadd);
			}
			//End inner else for null and email check

		} else {
			//Don't include other in null check
			if(names == "" || serial == "" || phoneno == "" || emailadd == "") {
				$('div span#notification').css({
					color : 'red',
					opacity : '0'
				}).html("Fill in all fields").fadeTo(3000, 1).fadeOut(5000);
			} else if(_emailValid(emailadd) == false) {
				$('div span#notification').css({
					color : 'red',
					opacity : '0'
				}).html("Email format incorrect").fadeTo(3000, 1).fadeOut(5000);
			} else {
				//Post the data with no other
				$.post("request.php", {
					rq_id : 3,
					type : type,
					names : names,
					serial : serial,
					phoneno : phoneno,
					emailadd : emailadd
				}, function(data) {
					//Show notification of successful save
					$("#confirmannounce").dialog("open");

					//Empty input values
					$('input[type=text]').val("");


					//Restore button caption
					//$('table tr td span input#save').val("Announce");
				});
				//alert(type+" "+names+" "+serial+" "+lostLocation+" "+phoneno+" "+emailadd);
			}
			//End inner else for null and email check

		}
		//End checks for select
	});
}//End function _saveAnnounce
function _emailValid(emailadd) {
	var emailRegx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return emailRegx.test(emailadd);
}//End function validate email

function _help() {
	$('span.help').click(function() {
		//Post this id to help function to get item specific help
		$.post("request.php", {
			rq_id : 6,
			help : $(this).attr("id")
		}, function(data) {
			$('div div#help').html(data).show();

			//Agree to policy
			$('table tr td input#gotit').click(function() {
				gotit = true;
			});
			//close help dialog box -- What is click and what to close is passed
			_closes($('span#close'), $('div div#help'));
		});
	});
}//End function help