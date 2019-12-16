$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    var subjectteachertable = $('#subjectteacherTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'asc']], 
 
        "ajax": {
            "url": base_url+"adminController/data_subjectTeacher",
            "type": "POST",
        },

        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [3], 
	            "orderable": false,
	        },
        ],
        "columns": [
            { data: "subject_name" },
            { data: "firstname",
                render: function (data, type, row) {
                    return row.firstname+' '+row.lastname;
                }
            },
            { data: "school_year" },
	        { data: "subject_teacher_id",
	         	render: function (data, type, row) {
                    return  '<button class="btn btn-success btn-sm btn-flat editsubjectteacher" value="'+data+'" data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i> Edit</button> <button class="btn btn-danger btn-sm btn-flat deletesubjectteacher" value="'+data+'" data-toggle="modal" data-target="#delete"><i class="fa fa-trash"></i> Delete</button> <a href="'+base_url+'admin/subject-teachers/students/'+data+'" class="btn btn-primary btn-sm btn-flat" target="_blank"><i class="fa fa-users"></i> Students</a>';
                }
	        },
 
       ],
    });

    $('#addSubjectTeacher').click(function(){
        var teachers = $.ajax({
            type: 'GET',
            url: base_url+'adminController/getTeachers',
            async: false,
            dataType: 'json'
        }).responseJSON;
        var subjects = $.ajax({
            type: 'GET',
            url: base_url+'adminController/getSubjects',
            async: false,
            dataType: 'json'
        }).responseJSON;
        var school_years = $.ajax({
            type: 'GET',
            url: base_url+'adminController/getSchoolYears',
            async: false,
            dataType: 'json'
        }).responseJSON;
        var subjecthtml = '<option value="" selected disabled>Select</option>';
        $.each(subjects, function(sub, subject){
            subjecthtml += '<option value="'+subject.id+'">'+subject.subject_name+'</option>';
        });
        $('#subject_id').html(subjecthtml);
        $('#subject_id').select2();
        var teacherhtml = '<option value="" selected disabled>Select</option>';
        $.each(teachers, function(tea, teacher){
            teacherhtml += '<option value="'+teacher.id+'">'+teacher.firstname+' '+teacher.lastname+'</option>';
        });
        $('#teacher_id').html(teacherhtml);
        $('#teacher_id').select2();
        var yearhtml = '<option value="" selected disabled>Select</option>';
        $.each(school_years, function(ye, year){
            yearhtml += '<option value="'+year.id+'">'+year.school_year+'</option>';
        });
        $('#school_year_id').html(yearhtml);
        $('#school_year_id').select2();
    });

    //add admin form validation
	$('#subjectTeacherForm').validate({
        rules: {
            subject_id: {
                required: true
            },  
            teacher_id: {
                required: true
            }, 
            school_year_id: {
                required: true
            },     
        },
        messages: {
        	subject_id: {
                required: 'Please select subject'
            }, 
            teacher_id: {
                required: 'Please select teacher'
            }, 
            school_year_id: {
                required: 'Please select school year'
            },  
        }
    });

	//add admin form submit
	$('#subjectTeacherForm').submit(function(e){
        e.preventDefault();
        var subjectteacher = $(this).serialize();
		if($(this).valid()){
			$.ajax({
				type: "POST",
				url: base_url+'adminController/addSubjectTeacher',
                data: subjectteacher,
                dataType: 'json',
				beforeSend: function(){
                    $('#loader').show();
				},
				success: function(data){
                    $('#loader').hide();
					if(!data.error){
						$("#subjectTeacherForm")[0].reset();
                        $('#addnew').modal('hide');
                        alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
					    subjectteachertable.ajax.reload();
					} else {
                        alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                    }
				}
			});
		}
	});

	//edit button
	$(document).on('click', '.editsubjectteacher', function(){
		var id = $(this).val();
        var teachers = $.ajax({
            type: 'GET',
            url: base_url+'adminController/getTeachers',
            async: false,
            dataType: 'json'
        }).responseJSON;
        var subjects = $.ajax({
            type: 'GET',
            url: base_url+'adminController/getSubjects',
            async: false,
            dataType: 'json'
        }).responseJSON;
        var school_years = $.ajax({
            type: 'GET',
            url: base_url+'adminController/getSchoolYears',
            async: false,
            dataType: 'json'
        }).responseJSON;
		$.ajax({
			type: "POST",
			url: base_url+'adminController/getSubjectTeacherById',
			data: {id:id},
			dataType: "json",
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
                var data = data[0]; 
                $('#subjectteacherid').val(id);
                var subjecthtml = '<option value="'+data.subject_id+'" selected>'+data.subject_name+'</option>';
                $.each(subjects, function(sub, subject){
                    if (data.subject_id !== subject.id) {
                        subjecthtml += '<option value="'+subject.id+'">'+subject.subject_name+'</option>';   
                    }
                });
                $('#edit_subject_id').html(subjecthtml);
                $('#edit_subject_id').select2();
                var teacherhtml = '<option value="'+data.teacher_id+'" selected>'+data.firstname+' '+data.lastname+'</option>';
                $.each(teachers, function(tea, teacher){
                    if (data.teacher_id !== teacher.id) {
                        teacherhtml += '<option value="'+teacher.id+'">'+teacher.firstname+' '+teacher.lastname+'</option>';
                    }
                });
                $('#edit_teacher_id').html(teacherhtml);
                $('#edit_teacher_id').select2();
                var yearhtml = '<option value="'+data.school_year_id+'" selected>'+data.school_year+'</option>';
                $.each(school_years, function(ye, year){
                    if (data.school_year_id !== year.id) {
                        yearhtml += '<option value="'+year.id+'">'+year.school_year+'</option>';
                    }
                });
                $('#edit_school_year_id').html(yearhtml);
                $('#edit_school_year_id').select2();
			}
		});
	});

	//edit event form submit
	$('#editSubjectTeacherForm').submit(function(e){
		e.preventDefault();
        var subjectteacher = $(this).serialize();
		$.ajax({
			type: "POST",
			url: base_url+'adminController/editSubjectTeacher',
            data: subjectteacher,
            dataType: 'json',
			beforeSend: function(){
                $('#loader').show();
			},
			success: function(data){
                $('#loader').hide();
				if(!data.error){
                    $("#editSubjectTeacherForm")[0].reset();
                    $('#edit').modal('hide');
                    alertify.success('<i class="fa fa-check-circle"></i> &nbsp; '+data.message);
                    subjectteachertable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
		
    });
    
    //delete button click
    $(document).on('click', '.deletesubjectteacher', function(){
        var id = $(this).val();
		$('#deleteSubjectTeacher').val(id);
    });
    
    //confirm delete
    $('#deleteSubjectTeacher').click(function(){
        var id = $(this).val();
        $.ajax({
			type: "POST",
			url: base_url+'adminController/deleteSubjectTeacher',
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
                    subjectteachertable.ajax.reload();
                } else {
                    alertify.error('<i class="fa fa-info-circle"></i> &nbsp; '+data.message);
                }
			}
		});
    });
   
});