jQuery(document).ready(function() {

	function isValidEmailAddress(emailAddress) {

		var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);

		return pattern.test(emailAddress);

	}


	$("#create_account").click(function() {

		var names = $('#names').val();

		var location = $('#location').val();

		var idnumber = $('#idnumber').val();

		var gender = $('#gender').val();

		var code = $("#countrycode").val();

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

			$('#alertinfo').addClass('alert alert-error').html('enter your names seperated by spaces names').show().scrollTop();

			$('#names').addClass('bordered');

		} else if(location == '') {

			$('#alertinfo').addClass('alert alert-error').html('enter your current location').show().scrollTop();

			$('#location').addClass('bordered');

		} else if(idnumber == '') {

			$('#alertinfo').addClass('alert alert-error').html('enter your ID Number').scrollTop();

			$('#age').addClass('bordered');

		} else if(username == '') {

			$('#alertinfo').addClass('alert alert-error').html('enter your preferred username').show().scrollTop();

			$('#username').addClass('bordered');

		} else if(password == '') {

			$('#alertinfo').addClass('alert alert-error').html('enter your preferred password').show().scrollTop();

			$('#password').addClass('bordered');

		} else if(password1 == '') {

			$('#alertinfo').addClass('alert alert-error').html('re-enter your preferred password').show().scrollTop();

			$('#password1').addClass('bordered');

		} else if(passone != passtwo) {

			$('#alertinfo').addClass('alert alert-error').html('password not matching').show().scrollTop();

			$('#password').addClass('bordered');

			$('#password1').addClass('bordered');

		} else if(email == '') {

			$("#alertinfo").addClass('alert alert-error').html('please enter an email adress').scrollTop();

		} else if(phoneno == '') {

			$('#alertinfo').addClass('bordered').html("please enter a phone number");

		} else if(question == '') {

			$('#alertinfo').addClass('alert alert-error').html("please enter a question to help you recover your account");

		} else if(answer == '') {

			$('#alertinfo').addClass('bordered').html('please enter an answer to the question above');

		}// else if(avalilability) {

		//$('.alerterror').addClass('bordered').html('please select another username');

		//}

		else if(!isValidEmailAddress(email)) {

			$('#alertinfo').addClass('alert alert-error').html('enter a valid email adress').show();

			$('#email').addClass('bordered');
		} else {
			$("#register_form").submit();
		}

	});

	
});
