$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    var subject_teacher_id = $('#subject_teacher_id').data('value');

    var studenttable = $('#studentTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[0, 'asc']], 
 
        "ajax": {
            "url": base_url+"teacherController/data_subject_student",
            "type": "POST",
            "data": {subject_teacher_id: subject_teacher_id}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [1], 
	            "orderable": false,
	        },
        ],
        "columns": [
            { data: "lastname",
                render: function (data, type, row) {
                    return data+', '+row.firstname;
                }
            },
	        { data: "subject_student_id",
	         	render: function (data, type, row) {
                    return  '<button class="btn btn-primary btn-sm btn-flat subjectsheet" value="'+data+'" data-toggle="modal" data-target="#sheet"><i class="fa fa-file"></i> Score Sheet</button>';
                }
	        },
 
        ],
    });

    $(document).on('click', '.subjectsheet', function(){
        var id = $(this).val();
        $('#subject_student_id').val(id);
        var gradings = $.ajax({
            type: 'GET',
            url: base_url+'teacherController/getGradings',
            async: false,
            dataType: 'json'
        }).responseJSON;
        var gradinghtml = '';
        $.each(gradings, function(gra, grading){
            gradinghtml += '<option value="'+grading.id+'">'+grading.period+'</option>';
        });
        $('#grading_id').html(gradinghtml);
    });

    //add admin form validation
    $('#sheetForm').validate({
        rules: {
            grading_id: {
                required: true
            },      
        },
        messages: {
            grading_id: {
                required: "Please select period"
            }, 
        }
    });

    //add admin form submit
    $('#sheetForm').submit(function(e){
        e.preventDefault();
        var grading_id = $('#grading_id').val();
        var subject_student_id = $('input:hidden[name=subject_student_id]').val();

        window.open(base_url + 'teacher/subjects/students/sheet/'+subject_student_id+'/'+grading_id, '_blank');
    });
   
});