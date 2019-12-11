$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    var studenttable = $('#studentTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'asc']], 
 
        "ajax": {
            "url": base_url+"adminController/data_student",
            "type": "POST",
        },

        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [1, 4, 6], 
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
            { data: "student_firstname" },
            { data: "student_lastname" },
            { data: "photo",
                render: function (data, type, row) {
                    var link = '';
                    if (data == '') {
                        link = base_url+'assets/img/avatar.png';
                    } else {
                        link = base_url+'uploads/'+data;
                    }
                    return '<img src="'+link+'" width="30px" height="30px">';
               }
            },
            { data: "parent_firstname",
                render: function (data, type, row) {
                    if (data == '' || data == null) {
                        return '';
                    } else {
                        return data+' '+row.parent_lastname;
                    }   
               }
            },
	        { data: "student_id",
	         	render: function (data, type, row) {
                    return  '<button class="btn btn-success btn-sm btn-flat editstudent" value="'+data+'" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm btn-flat deletestudent" value="'+data+'" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Delete</button>';
               }
	        },
 
       ],
    });

    //add admin form validation
	$('#studentForm').validate({
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
        }
    });

	//add admin form submit
	$('#studentForm').submit(function(e){
		e.preventDefault();
		if($(this).valid()){
            var username = $('#username').val();
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();

            var formdata = new FormData();
            if (document.getElementById('photo').files.length > 0) {
                formdata.append('file', document.getElementById('photo').files[0]);
            }
            formdata.append('username', username);
            formdata.append('firstname', firstname);
            formdata.append('lastname', lastname);
			$.ajax({
				type: "POST",
				url: base_url+'adminController/addStudent',
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
						$("#studentForm")[0].reset();
                        $('#addnew').modal('hide');
                        alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
						studenttable.ajax.reload();
					} else {
                        alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                    }
				}
			});
		}
	});

	//edit button
	$(document).on('click', '.editstudent', function(){
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/getStudentById',
			data: {id:id},
			dataType: "json",
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
                var data = data[0]; 
                $('#studentid').val(data.student_id);
                $('#edit_username').val(data.username);
                $('#edit_firstname').val(data.firstname);
                $('#edit_lastname').val(data.lastname);
                $('#userid').val(data.user_id);
			}
		});
	});

	//edit event form submit
	$('#editStudentForm').submit(function(e){
		e.preventDefault();
        var username = $('#edit_username').val();
        var firstname = $('#edit_firstname').val();
        var lastname = $('#edit_lastname').val();
        var userid = $('input:hidden[name=userid]').val();
        var studentid = $('input:hidden[name=studentid]').val();

        var formdata = new FormData();
        if (document.getElementById('edit_photo').files.length > 0) {
            formdata.append('file', document.getElementById('edit_photo').files[0]);
        }
        formdata.append('username', username);
        formdata.append('firstname', firstname);
        formdata.append('lastname', lastname);
        formdata.append('userid', userid);
        formdata.append('studentid', studentid);
		$.ajax({
			type: "POST",
			url: base_url+'adminController/editStudent',
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
                    $("#editStudentForm")[0].reset();
                    $('#edit').modal('hide');
                    alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
                    studenttable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
		
    });
    
    //delete button click
    $(document).on('click', '.deletestudent', function(){
        var id = $(this).val();
		$('#deleteStudent').val(id);
    });
    
    //confirm delete
    $('#deleteStudent').click(function(){
        var id = $(this).val();
        $.ajax({
			type: "POST",
			url: base_url+'adminController/deleteStudent',
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
                    studenttable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
    });
   
});