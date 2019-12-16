$(function(){
    // base url
    var base_url = $('.base_url').data('value');

    //alertify
    alertify.set('notifier','position', 'top-right');

    var teacher_id = $('#teacher_id').data('value');

    var subjecttable = $('#subjectTable').DataTable({
    	"processing": true, 
        "serverSide": true, 
        "order": [[1, 'desc']], 
 
        "ajax": {
            "url": base_url+"teacherController/data_subject",
            "type": "POST",
            "data": {teacher_id: teacher_id}
        },

        //Set column definition initialisation properties.
        "columnDefs": [
	        { 
	            "targets": [2], 
	            "orderable": false,
	        },
        ],
        "columns": [
            { data: "subject_name" },
            { data: "school_year" },
	        { data: "subject_teacher_id",
	         	render: function (data, type, row) {
                    return  '<a href="'+base_url+'teacher/subjects/criterias/'+data+'" class="btn btn-warning btn-sm btn-flat" target="_blank"><i class="fa fa-list-alt"></i> Criterias</a> <a href="'+base_url+'teacher/subjects/students/'+data+'" class="btn btn-primary btn-sm btn-flat" target="_blank"><i class="fa fa-users"></i> Students</a>';
               }
	        },
 
        ],
    });
   
});