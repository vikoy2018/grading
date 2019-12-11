$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    var subject_teacher_id = $('#subject_teacher_id').data('value');

    var criteriatable = $('#criteriaTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'asc']], 
 
        "ajax": {
            "url": base_url+"teacherController/data_criteria",
            "type": "POST",
            "data": {subject_teacher_id: subject_teacher_id}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [2], 
	            "orderable": false,
	        },
        ],
        "columns": [
            { data: "criteria" },
            { data: "percentage" },
	        { data: "id",
	         	render: function (data, type, row) {
                    return  '<button class="btn btn-success btn-sm btn-flat editcriteria" value="'+data+'" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm btn-flat deletecriteria" value="'+data+'" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Delete</button> <a href="'+base_url+'teacher/subjects/criterias/scores/'+data+'" class="btn btn-primary btn-sm btn-flat" target="_blank"><i class="fa fa-calculator"></i> Scores</a>';
               }
	        },
 
        ],
    });

    //add admin form validation
	$('#criteriaForm').validate({
        rules: {
            criteria: {
                required: true
            }, 
            percentage: {
                required: true
            },     
        },
        messages: {
        	criteria: {
                required: "Please input criteria"
            }, 
            percentage: {
                required: "Please input percentage"
            },  
        }
    });

	//add admin form submit
	$('#criteriaForm').submit(function(e){
        e.preventDefault();
        var criteria = $(this).serialize();
		if($(this).valid()){
			$.ajax({
				type: "POST",
				url: base_url+'teacherController/addCriteria',
                data: criteria,
                dataType: 'json',
				beforeSend: function(){
                    $('#loader').show();
				},
				success: function(data){
                    $('#loader').hide();
					if(!data.error){
						$("#criteriaForm")[0].reset();
                        $('#addnew').modal('hide');
                        alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
						criteriatable.ajax.reload();
					} else {
                        alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                    }
				}
			});
		}
	});

	//edit button
	$(document).on('click', '.editcriteria', function(){
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+'teacherController/getRowById',
			data: {
                id:id,
                table:'subject_criterias'
            },
			dataType: "json",
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
                var data = data[0]; 
                $('#criteria_id').val(data.id);
                $('#edit_criteria').val(data.criteria);
                $('#edit_percentage').val(data.percentage);
			}
		});
	});

	//edit event form submit
	$('#editCriteriaForm').submit(function(e){
		e.preventDefault();
        var criteria = $(this).serialize();
		$.ajax({
			type: "POST",
			url: base_url+'teacherController/editCriteria',
            data: criteria,
            dataType: 'json',
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
				if(!data.error){
                    $("#editCriteriaForm")[0].reset();
                    $('#edit').modal('hide');
                    alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
                    criteriatable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
		
    });
    
    //delete button click
    $(document).on('click', '.deletecriteria', function(){
        var id = $(this).val();
		$('#deleteCriteria').val(id);
    });
    
    //confirm delete
    $('#deleteCriteria').click(function(){
        var id = $(this).val();
        $.ajax({
			type: "POST",
			url: base_url+'teacherController/deleteCriteria',
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
                    criteriatable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
    });
   
});