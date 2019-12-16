$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    var subject_criteria_id = $('#subject_criteria_id').data('value');

    var scoretable = $('#scoreTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'asc']], 
 
        "ajax": {
            "url": base_url+"teacherController/data_score",
            "type": "POST",
            "data": {subject_criteria_id: subject_criteria_id}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [2], 
	            "orderable": false,
	        },
        ],
        "columns": [
            { data: "period" },
            { data: "total_score" },
	        { data: "score_id",
	         	render: function (data, type, row) {
                    return  '<button class="btn btn-success btn-sm btn-flat editscore" value="'+data+'" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm btn-flat deletescore" value="'+data+'" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Delete</button>';
               }
	        },
 
        ],
    });

    $('#addScore').click(function(){
        var gradings = $.ajax({
            type: 'GET',
            url: base_url+'teacherController/getGradings',
            async: false,
            dataType: 'json'
        }).responseJSON;
        var gradinghtml = '<option value="" selected disabled>Select</option>';
        $.each(gradings, function(gra, grading){
            gradinghtml += '<option value="'+grading.id+'">'+grading.period+'</option>';
        });
        $('#grading_id').html(gradinghtml);
        $('#grading_id').select2();
    });

    //add admin form validation
	$('#scoreForm').validate({
        rules: {
            grading_id: {
                required: true
            }, 
            total_score: {
                required: true
            },     
        },
        messages: {
        	grading_id: {
                required: "Please select period"
            }, 
            total_score: {
                required: "Please input total score"
            },  
        }
    });

	//add admin form submit
	$('#scoreForm').submit(function(e){
        e.preventDefault();
        var score = $(this).serialize();
		if($(this).valid()){
			$.ajax({
				type: "POST",
				url: base_url+'teacherController/addScore',
                data: score,
                dataType: 'json',
				beforeSend: function(){
                    $('#loader').show();
				},
				success: function(data){
                    $('#loader').hide();
					if(!data.error){
						$("#scoreForm")[0].reset();
                        $('#addnew').modal('hide');
                        alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
						scoretable.ajax.reload();
					} else {
                        alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                    }
				}
			});
		}
	});

	//edit button
	$(document).on('click', '.editscore', function(){
		var id = $(this).val();
        var gradings = $.ajax({
            type: 'GET',
            url: base_url+'teacherController/getGradings',
            async: false,
            dataType: 'json'
        }).responseJSON;
		$.ajax({
			type: "POST",
			url: base_url+'teacherController/getScoreById',
			data: {id:id},
			dataType: "json",
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
                var data = data[0]; 
                $('#score_id').val(data.score_id);
                $('#edit_total_score').val(data.total_score);
                var gradinghtml = '<option value="'+data.grading_id+'" selected>'+data.period+'</option>';
                $.each(gradings, function(gra, grading){
                    if (data.grading_id !== grading.id) {
                        gradinghtml += '<option value="'+grading.id+'">'+grading.period+'</option>';
                    }
                });
                $('#edit_grading_id').html(gradinghtml);
                $('#edit_grading_id').select2();
			}
		});
	});

	//edit event form submit
	$('#editScoreForm').submit(function(e){
		e.preventDefault();
        var score = $(this).serialize();
		$.ajax({
			type: "POST",
			url: base_url+'teacherController/editScore',
            data: score,
            dataType: 'json',
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
				if(!data.error){
                    $("#editScoreForm")[0].reset();
                    $('#edit').modal('hide');
                    alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
                    scoretable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
		
    });
    
    //delete button click
    $(document).on('click', '.deletescore', function(){
        var id = $(this).val();
		$('#deleteScore').val(id);
    });
    
    //confirm delete
    $('#deleteScore').click(function(){
        var id = $(this).val();
        $.ajax({
			type: "POST",
			url: base_url+'teacherController/deleteScore',
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
                    scoretable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
    });
   
});