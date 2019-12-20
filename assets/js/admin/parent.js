$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    var parenttable = $('#parentTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'asc']], 
 
        "ajax": {
            "url": base_url+"adminController/data_parent",
            "type": "POST",
        },

        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [1, 4, 5], 
	            "orderable": false,
	        },
        ],
        "columns": [
            { data: "username" },
            { data: "password",
                render: function (data, type, row) {
                    return '*****';
               }
            },
            { data: "firstname" },
            { data: "lastname" },
            { data: "phone" },
            { data: "photo",
                render: function (data, type, row) {
                    var link = '';
                    if (data == '') {
                        link = base_url+'assets/img/avatar.png';
                    } else {
                        link = base_url+'uploads/'+data;
                    }
                    return  '<img src="'+link+'" width="30px" height="30px">';
               }
            },
	        { data: "parent_id",
	         	render: function (data, type, row) {
                    return  '<button class="btn btn-success btn-sm btn-flat editparent" value="'+data+'" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm btn-flat deleteparent" value="'+data+'" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Delete</button> <a href="'+base_url+'admin/parents/students/'+data+'" class="btn btn-primary btn-sm btn-flat" target="_blank"><i class="fa fa-users"></i> Students</a>';
               }
	        },
 
       ],
    });

    //add admin form validation
	$('#parentForm').validate({
        rules: {
            username: {
                required: true
            },
            firstname: {
                required: true
            },
            lastname: {
                required: true
            }, 
            phone: {
                required: true
            },        
        },
        messages: {
        	username: {
                required: 'Please input username'
            },
            firstname: {
                required: 'Please input firstname'
            },
            lastname: {
                required: 'Please input lastname'
            },  
            phone: {
                required: 'Please input number'
            },   
        }
    });

	//add admin form submit
	$('#parentForm').submit(function(e){
		e.preventDefault();
		if($(this).valid()){
            var username = $('#username').val();
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();
            var phone = $('#phone').val();

            var formdata = new FormData();
            if (document.getElementById('photo').files.length > 0) {
                formdata.append('file', document.getElementById('photo').files[0]);
            }
            formdata.append('username', username);
            formdata.append('firstname', firstname);
            formdata.append('lastname', lastname);
            formdata.append('phone', phone);
			$.ajax({
				type: "POST",
				url: base_url+'adminController/addParent',
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
						$("#parentForm")[0].reset();
                        $('#addnew').modal('hide');
                        alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
						parenttable.ajax.reload();
					} else {
                        alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                    }
				}
			});
		}
	});

	//edit button
	$(document).on('click', '.editparent', function(){
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/getParentById',
			data: {id:id},
			dataType: "json",
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
                var data = data[0]; 
                $('#parentid').val(data.parent_id);
                $('#edit_username').val(data.username);
                $('#edit_firstname').val(data.firstname);
                $('#edit_lastname').val(data.lastname);
                $('#edit_phone').val(data.phone);
                $('#userid').val(data.user_id);
			}
		});
	});

	//edit event form submit
	$('#editParentForm').submit(function(e){
		e.preventDefault();
        var username = $('#edit_username').val();
        var firstname = $('#edit_firstname').val();
        var lastname = $('#edit_lastname').val();
        var phone = $('#edit_phone').val();
        var userid = $('input:hidden[name=userid]').val();
        var parentid = $('input:hidden[name=parentid]').val();

        var formdata = new FormData();
        if (document.getElementById('edit_photo').files.length > 0) {
            formdata.append('file', document.getElementById('edit_photo').files[0]);
        }
        formdata.append('username', username);
        formdata.append('firstname', firstname);
        formdata.append('lastname', lastname);
        formdata.append('phone', phone);
        formdata.append('userid', userid);
        formdata.append('parentid', parentid);
		$.ajax({
			type: "POST",
			url: base_url+'adminController/editParent',
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
                    $("#editParentForm")[0].reset();
                    $('#edit').modal('hide');
                    alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
                    parenttable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
		
    });
    
    //delete button click
    $(document).on('click', '.deleteparent', function(){
        var id = $(this).val();
		$('#deleteParent').val(id);
    });
    
    //confirm delete
    $('#deleteParent').click(function(){
        var id = $(this).val();
        $.ajax({
			type: "POST",
			url: base_url+'adminController/deleteParent',
            data: {id: id},
            dataType: 'json',
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
				if(!data.error){
                    $('#delete').modal('hide');
                    alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
                    parenttable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
    });
   
});