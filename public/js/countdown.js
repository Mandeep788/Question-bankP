$(document).ready(function () {

    $(function () {
        var timer = $('#quiz_timer').val();
        var quizStartTime = $('#quiz_started_at').val();
        // console.log(quizStartTime);
        if (timer == '') {
            $('#getting').hide();
        } else {
            if (quizStartTime == '') {
                var d2 = new Date();
                var cHour = d2.getHours();
                var cMin = d2.getMinutes();
                var cSec = d2.getSeconds();
                var d2sec = parseInt(cHour * 3600) + parseInt(cMin * 60) + parseInt(cSec);

                var d1 = new Date();
                var d1cHour = d1.getHours();
                var d1cMin = d1.getMinutes();
                var d1cSec = d1.getSeconds();
                var d1sec = parseInt(d1cHour * 3600) + parseInt(d1cMin * 60) + parseInt(d1cSec) + parseInt(timer * 60);
            } else {

                var d2 = new Date();
                var cHour = d2.getHours();
                var cMin = d2.getMinutes();
                var cSec = d2.getSeconds();
                var d2sec = parseInt(cHour * 3600) + parseInt(cMin * 60) + parseInt(cSec);

                var d1 = new Date(quizStartTime);
                var d1cHour = d1.getHours();
                var d1cMin = d1.getMinutes();
                var d1cSec = d1.getSeconds();
                var d1sec = parseInt(d1cHour * 3600) + parseInt(d1cMin * 60) + parseInt(d1cSec) + parseInt(timer * 60);
            }

            var diff = (parseInt(d1sec - d2sec));
            $('#getting').countdown({ until: diff, onExpiry: disableFunction });

            function disableFunction() {
                $('.enter').each(function () {
                    let answer = $(this).parent().find('.text-info').val();
                    let question_id = $(this).parent().find('input').val();
                    let quiz_id = $(this).parent().find('#quiz_id').val();;
                    let last_id = $(this).parent().find('.last_id').val();

                    if (last_id == '') {
                        if (answer == '') {
                            var ans ='Skipped Answer';
                        }else{
                            var ans =answer;
                        }
                        $.ajax({
                            type: "post",
                            url: "/insertanswer",
                            data: {
                                answer: ans,
                                question_id: question_id,
                                quiz_id: quiz_id
                            },
                            dataType: "json",
                            success: function (response) {
                                if (response.success == true) {
                                    $.toast({
                                        text: 'Yes! Inserted succesfully>.',
                                        hideAfter: 1000,
                                        icon: 'success',
                                        position: 'bottom-center',
                                        showHideTransition: 'slide'
                                    })
                                }
                            }
                        });
                    }
                });
                submitQuiz();
            }

            function submitQuiz() {
                $('#msg').show();
                let block_id = $(document).find('#block_id').val();
                $.ajax({

                    type: "put",
                    url: "/upatestatus",
                    data: {
                        block_id: block_id
                    },
                    dataType: "json",
                    success: function (response) {
                        $('#msg').empty();
                        if (response.status == 200) {
                            Swal.fire({
                                position: 'top-bottom',
                                icon: 'success',
                                title: 'Your work has been saved',
                                timer: 1500
                            }).then(function () {
                                window.location = "/dashboard";
                            })
                        }
                        else {
                            $.toast({
                                heading: 'Error',
                                text: 'Something Went Wrong',
                                showHideTransition: 'slide',
                                position: 'top-center',
                                icon: 'error',
                                show: 1000
                            })
                        }
                    }
                });
            }
        }
    });
});


