$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    $('#profileForm').validate({
        rules: {
            username: {
                required: true
            },  
            password: {
                required: true
            },   
            firstname: {
                required: true
            },  
            lastname: {
                required: true
            },     
        },
        messages: {
        	username: {
                required: 'Please input username'
            },  
            password: {
                required: 'Please input password'
            },   
            firstname: {
                required: 'Please input firstname'
            },  
            lastname: {
                required: 'Please input lastname'
            },   
        }
    });

    $('#profileForm').submit(function(e){
        e.preventDefault();
        var password = $(this).serialize();
		if($(this).valid()){
			$('#passwordCheck').modal('show');
		}
	});

    $('#passwordForm').validate({
        rules: {
            prof_password: {
                required: true
            },      
        },
        messages: {
            prof_password: {
                required: 'Please input password'
            },   
        }
    });

	$('#passwordForm').submit(function(e){
        e.preventDefault();
        var password = $(this).serialize();
		if($(this).valid()){
			$.ajax({
				type: "POST",
				url: base_url+'adminController/checkPassword',
                data: password,
                dataType: 'json',
				beforeSend: function(){
                    $('#loader').show();
				},
				success: function(data){
                    $('#loader').hide();
					if(!data.error){
                        updateProfile();
					} else {
                        alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                    }
				}
			});
		}
	});

});

function updateProfile() {
    var base_url = $('.base_url').data('value');
    var username = $('#username').val();
    var password = $('#password').val();
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var user_id = $('input:hidden[name=user_id]').val();
    var admin_id = $('input:hidden[name=admin_id]').val();

    var formdata = new FormData();
    if (document.getElementById('photo').files.length > 0) {
        formdata.append('file', document.getElementById('photo').files[0]);
    }
    formdata.append('username', username);
    formdata.append('password', password);
    formdata.append('firstname', firstname);
    formdata.append('lastname', lastname);
    formdata.append('admin_id', admin_id);
    formdata.append('user_id', user_id);

    $.ajax({
        type: "POST",
        url: base_url+'adminController/updateProfile',
        contentType: false,
        cache: false,
        processData: false,
        data: formdata,
        dataType: 'json',
        beforeSend: function(){
            $('#loader').show();
        },
        success: function(data){
            $('#loader').hide();
            if(!data.error){
                location.href = base_url + 'admin';
            } else {
                alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
            }
        }
    });
}