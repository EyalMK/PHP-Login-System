
$(document)
.on("submit", "form.js-register", function(event) {

	event.preventDefault();

	var _form = $(this);

	var _error = $(".js-error", _form);

	var dataObj = {
		email: $("input[type='email']", _form).val(),
		password: $("input[type='password']", _form).val()
	}


	if(dataObj.email.length < 6) {
		_error
			.text("Please enter a valid E-Mail address")
			.show();
		return false;
	} else if (dataObj.password.length < 8) {
		_error
			.text('Please enter a passphrase that is at least 8 characters long.')
			.show();
		return false;
	}

	// AJAX process

	_error.hide();


	$.ajax ({
		type: 'POST',
		url: '/ajax/register.php',
		data: dataObj,
		dataType: 'json',
		async: true,
	})
	.done(function ajaxDone(data) {
		if(data.redirect !== undefined) {
			window.location = data.redirect;
		} else if (data.error !== undefined) {
			_error
				.text(data.error)
				.show();
		}
	})
	.fail(function ajaxFailed(e){

	})
	.always(function ajaxAlwaysDoThis(data) {

	})



	return false;
});




$(document).on("submit", "form.js-login", function(event) {

	event.preventDefault();

	var _form = $(this);

	var _error = $(".js-error", _form);

	var dataObj = {
		email: $("input[type='email']", _form).val(),
		password: $("input[type='password']", _form).val()
	}


	if(dataObj.email.length < 6) {
		_error
			.text("Please enter a valid E-Mail address")
			.show();
		return false;
	} else if (dataObj.password.length < 8) {
		_error
			.text('Please enter a passphrase that is at least 8 characters long.')
			.show();
		return false;
	}

	// AJAX process

	_error.hide();


	$.ajax ({
		type: 'POST',
		url: '/ajax/login.php',
		data: dataObj,
		dataType: 'json',
		async: true,

		/* 
		statusCode: {
			403: function () {
				alert('Access forbidden.'); 
			}
		} */
	}) 
	.done(function ajaxDone(data) {
		if(data.redirect !== undefined) {
			window.location = data.redirect;
		} else if (data.error !== undefined) {
			_error
				.html(data.error)
				.show();
		}
	})
	.fail(function ajaxFailed(e){

	})
	.always(function ajaxAlwaysDoThis(data) {
		
	})



	return false;
});