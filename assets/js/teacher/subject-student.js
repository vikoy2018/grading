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
	            "targets": [1, 2], 
	            "orderable": false,
	        },
        ],
        "columns": [
            { data: "lastname",
                render: function (data, type, row) {
                    return data+', '+row.firstname;
                }
            },
            { data: "grades",
                render: function (data, type, row) {
                    if (data != null) {
                        var classes = ['grade-primary', 'grade-secondary', 'grade-success', 'grade-info'];
                        var new_data = data.split(',');
                        var html = '';
                        var fail = '';
                        $.each(new_data, function(x, y){
                            if (y < 75) {
                                fail = 'grade-fail';
                            }
                            html += '<div class="student-grade '+classes[x]+' '+fail+'">'+y+'</div>';
                        });
                        return html;
                    } else {
                        return '';
                    }
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
        var gradinghtml = '<option value="" selected disabled>Select</option>';
        $.each(gradings, function(gra, grading){
            gradinghtml += '<option value="'+grading.id+'">'+grading.period+'</option>';
        });
        $('#grading_id').html(gradinghtml);
        $('#grading_id').select2();
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
        if($(this).valid()){
            var grading_id = $('#grading_id').val();
            var subject_student_id = $('input:hidden[name=subject_student_id]').val();

            window.open(base_url + 'teacher/subjects/students/sheet/'+subject_student_id+'/'+grading_id, '_blank');
        }
    });
   
});