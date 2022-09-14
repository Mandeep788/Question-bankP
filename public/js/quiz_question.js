$(document).ready(function () {

    $('.update').hide();
    $('.edit').hide();


        // **********************************for okk to start quiz code area****************
        $(document).on('click', "#start_quiz", function (e) {
            e.preventDefault();
            let u_id = $('#user_id').val();
            console.log(u_id);
            let block_id = $(this).data("id");
            $('#block_id').val(block_id);
            console.log(block_id);
            $('#myModal').hide();

            // console.log("hello");
            swal("Start your quiz").then(function () {
                // get_question(block_id);
                window.location = "/quiz/" + block_id + "/" + u_id;
            })

        });
        // ***********************************end area ******************************************


        // insert and getb  value of txt area and question id******************

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(document).on('click', ".enter", function (e) {
            e.preventDefault();
            // console.log("hello");
            let parent = $(this).parent().find('.text-info');
            let answer=parent.val();
            $(parent).attr("disabled", true)
            let question_id = $(this).parent().find('input').val();
            let block_id = $(this).parent().find('#block_id').val();
            let quiz_id = $(this).parent().find('#quiz_id').val();
            $(this).hide();
            $(this).parent().find('.edit').show();



            console.log(answer);

            console.log(question_id);
            console.log(block_id);
            console.log(quiz_id);
            var last_id = $(this).parent().find('.last_id');
    // console.log(last_id);


            $.ajax({
                type:"post",
                url:"/insertanswer",
                data:{
                    answer:answer,
                    question_id:question_id,
                    // block_id:block_id,
                    quiz_id:quiz_id
                },
                dataType: "json",
                success:function(response)
                {
                    console.log(response);

                    $(last_id).val(response.id);
                }
            });


        });

        $(document).on('click', ".edit", function (e) {
            e.preventDefault();
            let parent = $(this).parent().find('.text-info');
            $(parent).attr("disabled", false) ;
            $(this).parent().find('.update').show();
            // $().show();
            $(this).hide();

        });

        $(document).on('click','.update', function (e) {
            e.preventDefault();
            let last=$(this).parent().find('.last_id').val();
            console.log(last);
            let parent = $(this).parent().find('.text-info');
            let answer=parent.val();
            $(parent).attr("disabled", true) ;
            $(this).parent().find('.edit').show();
            $(this).hide();

            $.ajax({
                type:"put",
                url:"/updateanswer",
                data:{
                    last_id:last,
                    answer:answer,
                    // question_id:question_id,
                    // block_id:block_id,
                    // quiz_id:quiz_id
                },
                dataType: "json",
                success:function(response)
                {
                    console.log(response);


                    // $(last_id).val(response.id);
                }
            });

        });

    // update status of block to done;
    $(document).on('click','#submit',function(){
        // alert("hello");

  let block_id = $(this).parent().find('#block_id').val();
  console.log(block_id);
        $.ajax({

            type:"put",
            url:"/upatestatus",
            data:{
                block_id:block_id
            },
            dataType:"json",
            success:function(response)
            {
                console.log(response);
            }
        });
    });


        // ********************end code area**************************************


    });
