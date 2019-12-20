$(function(){
	// base url
	var base_url = $('.base_url').data('value');

	var student_id = $('#student_id').data('value');

	// set alert position
	alertify.set('notifier','position', 'top-right');

	$('#select_school_year').change(function(){
        var id = $(this).val();
        location.href = base_url + 'parent/grade/' + student_id + '/' + id;
    });
});