$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    var yeartable = $('#yearTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'desc']], 
 
        "ajax": {
            "url": base_url+"adminController/data_year",
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
            { data: "school_year" },
	        { data: "id",
	         	render: function (data, type, row) {
                    return  '<button class="btn btn-success btn-sm btn-flat edityear" value="'+data+'" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm btn-flat deleteyear" value="'+data+'" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Delete</button>';
               }
	        },
 
       ],
    });

    //add admin form validation
	$('#yearForm').validate({
        rules: {
            school_year: {
                required: true
            },      
        },
        messages: {
        	school_year: {
                required: 'Please input school year'
            },   
        }
    });

	//add admin form submit
	$('#yearForm').submit(function(e){
        e.preventDefault();
        var year = $(this).serialize();
		if($(this).valid()){
			$.ajax({
				type: "POST",
				url: base_url+'adminController/addYear',
                data: year,
                dataType: 'json',
				beforeSend: function(){
                    $('#loader').show();
				},
				success: function(data){
                    $('#loader').hide();
					if(!data.error){
						$("#yearForm")[0].reset();
                        $('#addnew').modal('hide');
                        alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
						yeartable.ajax.reload();
					} else {
                        alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                    }
				}
			});
		}
	});

	//edit button
	$(document).on('click', '.edityear', function(){
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/getRowById',
			data: {
                id:id,
                table:'school_years'
            },
			dataType: "json",
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
                var data = data[0]; 
                $('#yearid').val(data.id);
                $('#edit_school_year').val(data.school_year);
			}
		});
	});

	//edit event form submit
	$('#editYearForm').submit(function(e){
		e.preventDefault();
        var year = $(this).serialize();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/editYear',
            data: year,
            dataType: 'json',
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
				if(!data.error){
                    $("#editYearForm")[0].reset();
                    $('#edit').modal('hide');
                    alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
                    yeartable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
		
    });
    
    //delete button click
    $(document).on('click', '.deleteyear', function(){
        var id = $(this).val();
		$('#deleteYear').val(id);
    });
    
    //confirm delete
    $('#deleteYear').click(function(){
        var id = $(this).val();
        $.ajax({
			type: "POST",
			url: base_url+'adminController/deleteYear',
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
                    yeartable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
    });
   
});