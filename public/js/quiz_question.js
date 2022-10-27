$(document).ready(function () {

    $('.edit').hide();
    $('.enter').show();
    $('#msg').hide();
    $('.update').hide();
    $('.skipText').hide();
    $('#submit').hide();
    checkSubmit();
    function checkSubmit(){
        let last_id_get=$(document).find('.last_id');
        var last_id_count=0;
        $(last_id_get).each(function (){
            if(($(this).val())==''){

            }else{
                last_id_count++;
                // console.log($(this).val());
            }
        });
        let last_id_total=$(document).find('.last_id').length;
        if(last_id_count == last_id_total){
            $('#submit').show();
        }
        // console.log(last_id_total);
    }
    $(this).parent().find('#skipText').hide();
    function checkAnswerValue() {
        let answerElement = $(document).find('.text-info');
        $(answerElement).each(function () {
            if (($.trim($(this).val())) != '') {
                // console.log(this);
                $(this).parent().find('.enter').hide();
                $(this).parent().find('.edit').show();
                $(this).parent().find('#skipAnswer').hide();
                $(this).attr("disabled", true);
            }
            else if (($.trim($(this).val())) == "0") {
                $(this).parent().find('#skipAnswer').show();
            }
        });
    }
    checkAnswerValue();

    // **********************************for okk to start quiz code area****************
    $(document).on('click', "#start_quiz", function (e) {
        e.preventDefault();
        let u_id = $('#user_id').val();
        // console.log(u_id);
        let block_id = $(this).data("id");
        $('#block_id').val(block_id);
        let block_type = $(this).data('type');
        // console.log(block_id);
        $('#exampleModal').hide();
        $.ajax({
            type: "get",
            url: "/quiz",
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    swal.fire("Start your quiz").then(function () {
                        // get_question(block_id);
                        if(block_type == 'MCQ'){
                            window.location = "/mcq/" + block_id + "/" + u_id;
                        }else{
                            window.location = "/quiz/" + block_id + "/" + u_id;
                        }
                    })
                }

            }
        });



    });
    $(document).on('click', "#checked_quiz", function (e) {

        e.preventDefault();
        var checked = $(this).data("aggregate");
        var feedback = $(this).data("feedback");

        // console.log(checked);
        // console.log(feedback);
        $('#check_details').modal('show');
        $('#exampleModal').hide();

        $('#aggregate').val(checked);
        $('#feedback').val(feedback);
        $(document).on('click', "#close", function () {
            window.location = "/dashboard";

        });
    });
    // ***********************************end area ******************************************


    // insert and get  value of txt area and question id******************

    $.ajaxSetup({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('click', ".enter", function (e) {
        e.preventDefault();
        // console.log("hello");
        let parent = $(this).parent().find('.text-info');
        let answer = parent.val();
        $(parent).attr("disabled", true)
        let question_id = $(this).parent().find('input').val();
        let block_id = $(this).parent().find('#block_id').val();
        let quiz_id = $(this).parent().find('#quiz_id').val();
        $(this).hide();
        $(this).parent().find('.edit').show();
        $(this).parent().find('#skipAnswer').hide();
        // $('.update').show();
        let last_id=$(this).parent().find('.last_id').val();
        if(last_id == ''){
            if(answer == ''){
                var ans_value = 'Skipped Answer';
            }else{
                var ans_value = answer;
            }
            $.ajax({
                type: "post",
                url: "/insertanswer",
                context: this,
                data: {
                    answer: ans_value,
                    question_id: question_id,
                    // block_id:block_id,
                    quiz_id: quiz_id
                },
                dataType: "json",
                success: function (response) {
                    // console.log(response);
                    if (response.success == true) {
                        $(this).parent().find('.last_id').val(response.id);
                        $.toast({
                            text: 'Yes! Inserted succesfully>.',
                            hideAfter: 1000,
                            icon: 'success',
                            position: 'bottom-center',
                            showHideTransition: 'slide'
                        })
                    }
                    checkSubmit();
                }
            });
        }else{
            let last =last_id;

            updateAnswer(last,answer);
        }
    });
    //******************** */ insert anser code area END*************************************************************

    // ***************************SKIP ANSWER**********************************************************

    $(document).on('click', "#skipAnswer", function () {
        let parent = $(this).parent().find('.text-info');
        let question_id = $(this).parent().find('input').val();
        // console.log(question_id);
        let block_id = $(this).parent().find('#block_id').val();
        // console.log(block_id);
        let quiz_id = $(this).parent().find('#quiz_id').val();
        // console.log(quiz_id);
        $(this).parent().find('.skipText').show();
        $(this).hide();
        $(this).parent().find('.enter').hide();
        $(this).parent().find('.edit').show();
        $(parent).attr("disabled", true);

        $.ajax({

            type: "post",
            url: "/skipAnswer",
            context: this,
            data: {
                question_id: question_id,
                // block_id:block_id,
                quiz_id: quiz_id

            },
            dataType: "json",
            success: function (response) {
                $(this).parent().find('.last_id').val(response.id);

                $.toast({
                    text: 'You skipped question>.',
                    hideAfter: 1000,
                    icon: 'success',
                    position: 'bottom-center',
                    showHideTransition: 'slide'
                })
                checkSubmit();
            }

        });



    });
    // **************************SKIP ANSWER END*********************************************************



    //***************************edit answer code******************************************************

    $(document).on('click', ".edit", function (e) {
        e.preventDefault();
        let parent = $(this).parent().find('.text-info');
        $(parent).attr("disabled", false);
        $(this).parent().find('.update').show();
        var last_id = $(this).parent().find('.last_id').val();
        $(this).hide();
        // console.log(last_id);
        $(this).parent().find('.enter').hide();
        //  $('.update').show();
        $(this).parent().find('.update').show();
        $(this).parent().find('.skipText').hide();



    });
    // ******************************UPDATE ANSWER******************************************

    $(document).on('click', '.update', function (e) {
        e.preventDefault();
        let last = $(this).parent().find('.last_id').val();
        // console.log(last);
        let parent = $(this).parent().find('.text-info');
        let answer = parent.val();
        if (answer == '') {
            $.toast({
                heading: 'Error',
                text: ' You can not Insert Empty field',
                showHideTransition: 'slide',
                position: 'bottom-center',
                icon: 'error'
            })
            return false;
        }
        $(parent).attr("disabled", true);
        $(this).parent().find('.edit').show();
        $(this).hide();
        updateAnswer(last,answer);

    });
    function updateAnswer(last,answer){
        // $('.enter').hide();

        $.ajax({
            type: "put",
            url: "/updateanswer",
            data: {
                last: last,
                answer: answer,
                // question_id:question_id,
                // block_id:block_id,
                // quiz_id:quiz_id
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                $.toast({
                    text: 'Yes! update succesfully>.',
                    hideAfter: 1000,
                    icon: 'success',
                    position: 'bottom-center',
                    showHideTransition: 'slide'
                })

                // $(last_id).val(response.id);
            }
        });
    }
    //************************UODATE ANSWER END******************************************* */

    //**********************************UPDATE STATUS OF BLOCK TO SUBMITTED***************************;

    $(document).on('click', '#submit', function () {
        $('.enter').each(function () {
            let answer = $(this).parent().find('.text-info').val();
            let question_id = $(this).parent().find('input').val();
            let quiz_id = $(this).parent().find('#quiz_id').val();
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
                        // console.log(response);
                        if (response.success == true) {
                            // $(this).parent().find('.last_id').val(response.id);
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
    });

    function submitQuiz() {
        $('#msg').show();
        let block_id = $(document).find('#block_id').val();
        // console.log(block_id);
        $.ajax({

            type: "put",
            url: "/upatestatus",
            data: {
                block_id: block_id
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                $('#msg').empty();
                if (response.status == 200) {
                    Swal.fire({
                        position: 'bottom',
                        icon: 'success',
                        title: 'Your work has been saved',
                        timer: 1500
                    }).then(function () {
                        // get_question(block_id);
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


    // ********************end code area**************************************


});
