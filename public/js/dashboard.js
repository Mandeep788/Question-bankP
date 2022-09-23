$(document).ready(function () {
    $("#popupImage").hide();
    $('#userBlockStatus').DataTable();

    $('#feedbackForm').validate({
        rules: {
            feedbackInput: {
                required: true,

            },
        },
        messages: {
            feedbackInput: {
                required: "Please enter Feedback",
            }
        },errorPlacement: function(error, element) {
            error.appendTo('#feedbackError');
          }
    });

    $(document).on('click','.feedbackIcon',function(){
        $('#feedbackFormModal').modal('show');
        let quizId=$(this).data('id');
        // console.log(quizId);
        $('#feedbackQuizId').val(quizId);
    });
    $('#feedbackFormBtn').click(function(e){
        e.preventDefault();
        $('#feedbackForm').valid();
        let feedback=$('#feedbackInput').val();
        let quizId=$('#feedbackQuizId').val();
        // console.log(feedback, quizId);
        $.ajax({
            type: "post",
            url: "/admin/feedback",
            data: {
                feedback:feedback,
                quizId:quizId
            },
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    swal.fire({
                        title: 'Success!!',
                        text: 'Feedback Successfully Inserted!',
                        icon: 'success',
                        timer: 1000
                    }).then(function () {
                        location.reload(true);
                    });
                }
            }
        });

    });

    $('.test_marks_btn').click(function (e) {
        e.preventDefault();

        var TickElement = $(this).parents().find('.check_tick').text();
        var str2 = "Uncheck";
        if (TickElement.indexOf(str2) != -1) {
            $.toast({
                heading: 'Error',
                text: 'Please Assign Marks!!',
                showHideTransition: 'fade',
                position: {
                    right: 60,
                    bottom: 80
                },
                icon: 'error'
            })

        } else {
            $("#popupImage").show();
            var marks = '';
            var total = 0;
            var totalQues=$('#store_count_questions').val();
            $('.individual_marks').each(function () {
                marks = parseInt($(this).find(":selected").val());
                total = total + marks;
            });
            let aggergate = "";
            if (total == 0) {
                aggergate = 0;
            } else {
                aggergate = parseFloat(total / totalQues);
                aggergate = aggergate.toFixed(2);
            }
            let QuizId = $('#store_quiz_id').val();
            $('#store_aggregate').val(aggergate);
            $('.individual_marks').prop('disabled', true);
            $('#AggergateMarks').val(aggergate);
            $.ajax({
                type: "POST",
                url: "/admin/assessmentfeedback",
                data: {
                    QuizId: QuizId,
                    Aggergate: aggergate
                },
                dataType: "JSON",
                success: function (response) {
                    // console.log(response);
                    $('#popupImage').delay(1000).hide(500, function(){
                        if (response.status == 200) {
                            swal.fire({
                                title: 'Success!!',
                                icon: 'success',
                                html: "<p><b>Aggregate Marks</b>: "+aggergate+"</p>",
                                timer: 2000
                            }).then(function () {
                                window.location.href='/admin/notificationPanel';
                            });
                        }
                    });


                }
            });

        }
    });

    $('#feedback_div').hide();
    $('.red_circle').hide();
    Fetch_Counts();
    Fetch_Notifications();
    function Fetch_Counts() {
        $.ajax({
            type: "get",
            url: "/admin/dashboard-data",
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response != null || response != undefined) {
                    if (response.technologies != null || response.technologies != undefined) {
                        $('#technologies_count').html(response.technologies);
                    }
                    if (response.users != null || response.users != undefined) {
                        $('#users_count').html(response.users);
                    }
                    if (response.questions != null || response.questions != undefined) {
                        $('#questions_count').html(response.questions);
                    }
                }
            }
        });
    }

    function Fetch_Notifications() {
        $.ajax({
            type: "get",
            url: "/admin/notifiications",
            dataType: "json",
            success: function (response) {
                // console.log(response.count_notifications);
                if (response.status == 200) {
                    $('.red_circle').show();
                    var countNotification=parseInt(response.count_notifications);
                    if (countNotification < 10) {
                        if(countNotification==0){
                            $('.red_circle').hide();
                        }else{
                            $('.red_circle').text(response.count_notifications);
                        }
                    } else {
                        $('.red_circle').text('9+');
                    }
                    var notifications_desc = "";

                    $.each(response.notifications, function (key, value) {
                        // $('.notication_heading').show();
                        if(value.status=='S'){
                        notifications_desc += `<a class="notification_div" href="/admin/userassessment/` + value.id + `" ><p> <b>` + value.name + `</b> submitted ` + value.block_name + `</p></a><hr>`;
                        }else if(value.status=='U'){
                            notifications_desc += `<a class="notification_div" href="/admin/userassessment/` + value.id + `" ><p> <b>` + value.name + `</b> under review ` + value.block_name + `</p></a><hr>`;
                        }
                    });
                    $('#notifications_desc').append(notifications_desc);
                } else if (response.status == 404) {
                    $('.red_circle').hide();
                    $('.notication_heading').hide();
                }
            }
        });
    }

    $(document).on('click', '#show_submitted_block', function () {
        $('#feedback_div').show();
        $('#submitted_block').hide();


        let id = $(this).data('id');

        $.ajax({
            type: "get",
            url: "/admin/assessmentdata",
            data: {
                id: id,
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    let i = 1;
                    var submitted_data = '<div class="row justify-content-center">';
                    var store_quiz_id = "";
                    var store_count_questions='';
                    $.each(response.submitted_data, function (key, value) {
                        submitted_data += `<div class="col-lg-12 col-md-12">
                                    <div id="white_boxes">
                                        <h4 data-id="`+ value.question_id + `"><span>Q` + i + `.</span>` + value.question + `</h4>
                                        <p><span>Ans.</span>&nbsp;&nbsp;&nbsp;`+ value.answer + `</p>
                                        <input type="text" id="assess_user" value="`+ value.users_id + `" hidden>
                                        <div class="d-flex">`
                                        if(value.answer == '0' || value.answer == ''){
                                            submitted_data += `<div class="marks_on_each">
                                            <select class="form-select individual_marks assign_marks_btn" disabled>
                                            <option value="" disabled>Assign Marks</option>
                                                <option value="0" selected>0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                        <div class="tick">
                                        <i class="bi bi-check-circle check_tick" data-id="`+ value.id + `" data-quesid="` + value.question_id + `"> Uncheck</i>
                                        </div>`
                                        }else{
                                            submitted_data +=`<div class="marks_on_each">
                                            <select class="form-select individual_marks assign_marks_btn">
                                            <option value="" selected disabled>Assign Marks</option>
                                                <option value="0">0</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                            </select>
                                        </div>
                                        <div class="tick">
                                        <i class="bi bi-check-circle check_tick" data-id="`+ value.id + `" data-quesid="` + value.question_id + `"> Uncheck</i>
                                        </div>`
                                        }

                                        submitted_data += `</div>

                                    </div>
                                </div> `;
                        store_quiz_id = value.id;
                        store_count_questions=value.question_count;
                        i++;
                    });

                    submitted_data += `</div>`;
                    $('#store_quiz_id').val(store_quiz_id);
                    $('#store_count_questions').val(store_count_questions);
                    $('#dynamic_submitted_block').append(submitted_data);
                } else if (response.status == 404) {

                }
            }
        });


    });

    $(document).on('click', '.check_tick', function () {
        $('.CheckUncheck').html('');

        let single_mark = $(this).parent().parent().find('.individual_marks').find(":selected").val();
        if (single_mark != "") {
            let quiz_id = $(this).data('id');
            let ques_id = $(this).data('quesid');

            //    console.log(quiz_id);
            //    console.log(ques_id);
            $.ajax({
                type: "post",
                url: "/admin/userassessment",
                data: {
                    quiz_id: quiz_id,
                    ques_id: ques_id,
                    single_mark: single_mark
                },
                dataType: "json",
                success: function (response) {
                }
            });
            $(this).addClass('green');
            $(this).html('  Checked');
        }

    });

    $(document).on('change', '.individual_marks', function () {
        $(this).parent().parent().find('.check_tick').removeClass('green');
        $(this).parent().parent().find('.check_tick').html('  Uncheck');
    });


        
           
  

});
function set_all()
{
	days = parseInt($("#days_in").val());
	if(days < 10)
		{$('.days').html('0'+days);}
	else
		{$('.days').html(days);}
	
	
	hr = parseInt($("#hr_in").val());
	if(hr < 10)
		{$('.hr').html('0'+hr);}
	else
		{$('.hr').html(hr);}
	
	min = parseInt($("#min_in").val());
	if(min < 10)
		{$('.min').html('0'+min);}
	else
		{$('.min').html(min);}
	
	sec = parseInt($("#sec_in").val());
	if(sec < 10)
		{$('.sec').html('0'+sec);}
	else
		{$('.sec').html(sec);}
	
}

function dec_date()
{
	days = parseInt($('.days').html());
	if(days !== 0)
	{
		if((days - 1) < 10)
			{ $('.days').html('0'+(days - 1)); }
		else
			{ $('.days').html(days - 1); }
		
		$('.hr').html(23);
		$('.min').html(59);
		$('.sec').html(59);
	}
	else
	{
		pass;
	}
	
}

function dec_hr()
{
	hr = parseInt($('.hr').html());
	if(hr !== 0)
	{
		if((hr - 1) < 10)
			{ $('.hr').html('0'+(hr - 1)); }
		else
			{ $('.hr').html(hr - 1); }
		
		$('.min').html(59);
		$('.sec').html(59);
	}
	else
	{
		dec_date();
	}
}
function dec_min()
{
	min = parseInt($('.min').html());
	if(min !== 0)
	{
		if((min - 1) < 10)
			{ $('.min').html('0'+(min - 1)); }
		else
			{ $('.min').html(min - 1); }
		
		$('.sec').html(59);
	}
	else
	{
		dec_hr();
	}
}
$(document).ready(function()
{
	var Update = function()
	{
		$('.sec').each(function()
		{
			var count = parseInt($(this).html());
			if(count !== 0)
			{
				if((count - 1) < 10)
					{ $(this).html('0'+(count - 1)); }
				else
					{ $(this).html(count - 1); }
			}
			else
			{
				dec_min();
			}
		});	
	};
	setInterval(Update, 1000);
});