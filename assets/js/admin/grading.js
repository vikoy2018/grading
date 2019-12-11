$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    var gradingtable = $('#gradingTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'asc']], 
 
        "ajax": {
            "url": base_url+"adminController/data_grade",
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
            { data: "period" },
	        { data: "id",
	         	render: function (data, type, row) {
                    return  '<button class="btn btn-success btn-sm btn-flat editperiod" value="'+data+'" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm btn-flat deleteperiod" value="'+data+'" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Delete</button>';
               }
	        },
 
       ],
    });

    //add admin form validation
	$('#periodForm').validate({
        rules: {
            period: {
                required: true
            },      
        },
        messages: {
        	period: {
                required: 'Please input period'
            },   
        }
    });

	//add admin form submit
	$('#periodForm').submit(function(e){
        e.preventDefault();
        var period = $(this).serialize();
		if($(this).valid()){
			$.ajax({
				type: "POST",
				url: base_url+'adminController/addPeriod',
                data: period,
                dataType: 'json',
				beforeSend: function(){
                    $('#loader').show();
				},
				success: function(data){
                    $('#loader').hide();
					if(!data.error){
						$("#periodForm")[0].reset();
                        $('#addnew').modal('hide');
                        alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
						gradingtable.ajax.reload();
					} else {
                        alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                    }
				}
			});
		}
	});

	//edit button
	$(document).on('click', '.editperiod', function(){
		var id = $(this).val();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/getRowById',
			data: {
                id:id,
                table:'gradings'
            },
			dataType: "json",
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
                var data = data[0]; 
                $('#periodid').val(data.id);
                $('#edit_period').val(data.period);
			}
		});
	});

	//edit event form submit
	$('#editPeriodForm').submit(function(e){
		e.preventDefault();
        var period = $(this).serialize();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/editPeriod',
            data: period,
            dataType: 'json',
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
				if(!data.error){
                    $("#editPeriodForm")[0].reset();
                    $('#edit').modal('hide');
                    alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
                    gradingtable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
		
    });
    
    //delete button click
    $(document).on('click', '.deleteperiod', function(){
        var id = $(this).val();
		$('#deletePeriod').val(id);
    });
    
    //confirm delete
    $('#deletePeriod').click(function(){
        var id = $(this).val();
        $.ajax({
			type: "POST",
			url: base_url+'adminController/deletePeriod',
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
                    gradingtable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
    });
   
});