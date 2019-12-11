$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    var subjecttable = $('#subjectTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'asc']], 
 
        "ajax": {
            "url": base_url+"adminController/data_subject",
            "type": "POST",
        },

        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [1], 
	            "orderable": false,
	        },
        ],
        "columns": [
            { data: "subject_name" },
	        { data: "id",
	         	render: function (data, type, row) {
                    return  '<button class="btn btn-success btn-sm btn-flat editsubject" value="'+data+'" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm btn-flat deletesubject" value="'+data+'" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Delete</button>';
               }
	        },
 
        ],
    });

    //add admin form validation
	$('#subjectForm').validate({
        rules: {
            subject_name: {
                required: true
            },      
        },
        messages: {
        	subject_name: {
                required: 'Please input subject'
            },   
        }
    });

	//add admin form submit
	$('#subjectForm').submit(function(e){
        e.preventDefault();
        var subject = $(this).serialize();
		if($(this).valid()){
			$.ajax({
				type: "POST",
				url: base_url+'adminController/addSubject',
                data: subject,
                dataType: 'json',
				beforeSend: function(){
                    $('#loader').show();
				},
				success: function(data){
                    $('#loader').hide();
					if(!data.error){
						$("#subjectForm")[0].reset();
                        $('#addnew').modal('hide');
                        alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
						subjecttable.ajax.reload();
					} else {
                        alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                    }
				}
			});
		}
	});

	//edit button
	$(document).on('click', '.editsubject', function(){
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/getRowById',
			data: {
                id:id,
                table:'subjects'
            },
			dataType: "json",
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
                var data = data[0]; 
                $('#subjectid').val(data.id);
                $('#edit_subject_name').val(data.subject_name);
			}
		});
	});

	//edit event form submit
	$('#editSubjectForm').submit(function(e){
		e.preventDefault();
        var subject = $(this).serialize();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/editSubject',
            data: subject,
            dataType: 'json',
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
				if(!data.error){
                    $("#editSubjectForm")[0].reset();
                    $('#edit').modal('hide');
                    alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
                    subjecttable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
		
    });
    
    //delete button click
    $(document).on('click', '.deletesubject', function(){
        var id = $(this).val();
		$('#deleteSubject').val(id);
    });
    
    //confirm delete
    $('#deleteSubject').click(function(){
        var id = $(this).val();
        $.ajax({
			type: "POST",
			url: base_url+'adminController/deleteSubject',
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
                    subjecttable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
    });
   
});