$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    var parent_id = $('#parent_id').data('value');

    var parentstudenttable = $('#parentstudentTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'asc']], 
 
        "ajax": {
            "url": base_url+"adminController/data_parentStudent",
            "type": "POST",
            "data": {parent_id: parent_id}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [2], 
	            "orderable": false,
	        },
        ],
        "columns": [
            { data: "lastname" },
            { data: "firstname" },
	        { data: "parent_student_id",
	         	render: function (data, type, row) {
                    return  '<button class="btn btn-danger btn-sm btn-flat deleteparentstudent" value="'+data+'" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Delete</button>';
                }
	        },
 
       ],
    });

    $('#addParentStudent').click(function(){
        var students = $.ajax({
            type: 'GET',
            url: base_url+'adminController/getStudents',
            async: false,
            dataType: 'json'
        }).responseJSON;
        var studenthtml = '';
        $.each(students, function(stu, student){
            studenthtml += '<option value="'+student.id+'">'+student.lastname+', '+student.firstname+'</option>';
        });
        $('#student_id').html(studenthtml);
    });

    //add admin form validation
	$('#parentStudentForm').validate({
        rules: {
            student_id: {
                required: true
            },      
        },
        messages: {
        	student_id: {
                required: 'Please select student'
            },  
        }
    });

	//add admin form submit
	$('#parentStudentForm').submit(function(e){
        e.preventDefault();
        var parentstudent = $(this).serialize();
		if($(this).valid()){
			$.ajax({
				type: "POST",
				url: base_url+'adminController/addParentStudent',
                data: parentstudent,
                dataType: 'json',
				beforeSend: function(){
                    $('#loader').show();
				},
				success: function(data){
                    $('#loader').hide();
					if(!data.error){
						$("#parentStudentForm")[0].reset();
                        $('#addnew').modal('hide');
                        alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
					    parentstudenttable.ajax.reload();
					} else {
                        alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                    }
				}
			});
		}
	});

    //delete button click
    $(document).on('click', '.deleteparentstudent', function(){
        var id = $(this).val();
		$('#deleteParentStudent').val(id);
    });
    
    //confirm delete
    $('#deleteParentStudent').click(function(){
        var id = $(this).val();
        $.ajax({
			type: "POST",
			url: base_url+'adminController/deleteParentStudent',
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
                    parentstudenttable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
    });
   
});