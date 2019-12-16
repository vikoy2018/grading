$(function(){
	// base url
	var base_url = $('.base_url').data('value');

	// set alert position
	alertify.set('notifier','position', 'top-right');

	// admin login validation
	$('#teacherloginForm').validate({
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
	$('#teacherloginForm').submit(function(e){
		e.preventDefault();
		if($(this).valid()){
			var logindata = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: base_url+'teacherLoginController/login',
				data: logindata,
				dataType: 'json',
				beforeSend: function(){
					$('#teacherlogin').html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
				},
				success: function(res){
					$('#teacherlogin').html('<i class="fa fa-sign-in"></i> SIGN IN');
					if(res.error){
						alertify.error('<i class="fa fa-times-circle"></i> &nbsp; '+res.message);
					} else {
						location.href = base_url + 'teacher/dashboard';
					}
				},
				error: function (request, status, error) {
					alertify.error(request.responseText);
			        $('#teacherlogin').html('<i class="fa fa-sign-in"></i> SIGN IN');
			    }
			});
		}
	});
});