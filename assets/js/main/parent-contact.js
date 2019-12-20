$(function(){
	// base url
	var base_url = $('.base_url').data('value');

	// set alert position
	alertify.set('notifier','position', 'top-right');

	// admin login validation
	$('#contactForm').validate({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            }, 
            message: {
                required: true
            },   
        },
        messages: {
            name: {
                required: "Please input name"
            },
            email: {
                required: "Please input email",
                email: "Invalid email format"
            },  
            message: {
                required: "Please input message"
            }, 
        }
    });

	// admin login submit
	$('#contactForm').submit(function(e){
		e.preventDefault();
		if($(this).valid()){
			var contact = $(this).serialize();
			$.ajax({
				type: 'POST',
				url: base_url+'parentController/submitContact',
				data: contact,
				dataType: 'json',
				beforeSend: function(){
					$('#contactBtn').html('<i class="fa fa-spinner fa-spin"></i> PROCESSING');
				},
				success: function(res){
					$('#contactBtn').html('Send Message');
					if(res.error){
						alertify.error('<i class="fa fa-times-circle"></i> &nbsp; '+res.message);
					} else {
						alertify.success('<i class="fa fa-check-circle"></i> &nbsp; Message submitted');
					}
					$('#contactForm')[0].reset();
				},
				error: function (request, status, error) {
					alertify.error(request.responseText);
			        $('#contactBtn').html('Send Message');
			    }
			});
		}
	});
});