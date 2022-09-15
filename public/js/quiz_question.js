$(document).ready(function () {

    $('.edit').hide();
    $('.enter').show();
    $('#msg').hide();
    $('.update').hide();
    function checkAnswerValue() {
        let answerElement = $(document).find('.text-info');
        $(answerElement).each(function () {
            if (($.trim($(this).val())) != '') {
                // console.log(this);
                $(this).parent().find('.enter').hide();
                $(this).parent().find('.edit').show();
                $(this).attr("disabled", true);
            }
        });
    }
    checkAnswerValue();

    // **********************************for okk to start quiz code area****************
    $(document).on('click', "#start_quiz", function (e) {
        e.preventDefault();
        let u_id = $('#user_id').val();
        console.log(u_id);
        let block_id = $(this).data("id");
        $('#block_id').val(block_id);
        console.log(block_id);
        $('#myModal').hide();

        swal.fire("Start your quiz").then(function () {
            // get_question(block_id);
            window.location = "/quiz/" + block_id + "/" + u_id;
        })

    });
    $(document).on('click', "#checked_quiz", function (e) {

        e.preventDefault();
        var checked = $(this).data("aggregate");
        var feedback = $(this).data("feedback");

        // console.log(checked);
        // console.log(feedback);
        $('#check_details').modal('show');
        $('#myModal').hide();

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
        // $('.update').show();
        // console.log(answer);
        // console.log(question_id);
        // console.log(block_id);
        // console.log(quiz_id);
        // console.log(last_id);
        $.ajax({
            type: "post",
            url: "/insertanswer",
            data: {
                answer: answer,
                question_id: question_id,
                // block_id:block_id,
                quiz_id: quiz_id
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if(response.success==true)
                {
                    $.toast({
                        text: 'Yes! Inserted succesfully>.',
                        hideAfter: 1000 ,
                        icon: 'success',
                        position: 'bottom-center',
                        showHideTransition: 'slide'
                    })
                }
                //  $(last).val(response.id);

            }
        });


    });
    // insert anser code area end*************************************************************


    // edit answer code******************************************************

    $(document).on('click', ".edit", function (e) {
        e.preventDefault();
        let parent = $(this).parent().find('.text-info');
        $(parent).attr("disabled", false);
        $(this).parent().find('.update').show();
        var last_id = $(this).parent().find('.last_id');
        $(this).hide();
        // console.log(last_id);
        $(this).parent().find('.enter').hide();
        //  $('.update').show();
        $(this).parent().find('.update').show();


    });
    // ******************************UPDATE ANSWER******************************************

    $(document).on('click', '.update', function (e) {
        e.preventDefault();
        let last = $(this).parent().find('.last_id').val();
        console.log(last);
        let parent = $(this).parent().find('.text-info');
        let answer = parent.val();
        $(parent).attr("disabled", true);
        $(this).parent().find('.edit').show();
        $(this).hide();
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
                $.toast({
                    text: 'Yes! update succesfully>.',
                    hideAfter: 1000 ,
                    icon: 'success',
                    position: 'bottom-center',
                    showHideTransition: 'slide'
                })

                // $(last_id).val(response.id);
            }
        });

    });
    //************************UODATE ANSWER END******************************************* */

    //**********************************update status of block to SUBMITTED***************************;

    $(document).on('click', '#submit', function () {
        // alert("hello");
        $('#msg').show();
        let block_id = $(this).parent().find('#block_id').val();
        console.log(block_id);
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
                var msg = response.message;
                $("#msg").append(msg).fadeOut(9000);

                // console.log(msg);

            }
        });
    });


    // ********************end code area**************************************


});
