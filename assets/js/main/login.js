$(function(){
	// base url
	var base_url = $('.base_url').data('value');

	// set alert position
	alertify.set('notifier','position', 'top-right');

	// admin login validation
	$('#loginForm').validate({
        rules: {
            username: {
                required: true
            },
            password: {
                required: true
            },  
        },
        messages: {
            username: {
                required: "Please input username"
            },
            password: {
                required: "Please input password"
            }, 
        }
    });

	// admin login submit
	$('#loginForm').submit(function(e){
		e.preventDefault();
		if($(this).valid()){
			var logindata = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: base_url+'LoginController/login',
				data: logindata,
				dataType: 'json',
				beforeSend: function(){
					$('#login').html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
				},
				success: function(res){
					$('#login').html('<i class="fa fa-sign-in"></i> SIGN IN');
					if(res.error){
						alertify.error('<i class="fa fa-times-circle"></i> &nbsp; '+res.message);
					} else {
						location.href = base_url + res.user;
					}
				},
				error: function (request, status, error) {
					alertify.error(request.responseText);
			        $('#login').html('<i class="fa fa-sign-in"></i> SIGN IN');
			    }
			});
		}
	});
});