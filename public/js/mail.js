$(document).ready(function () {
// 
    $(document).on('click', '.sendMail', function (e) {


         var $userquizId=$(this).data("id");
         $.ajax({
            type: "get",
            url: "/mail/"+$userquizId,
            dataType: "json",
            success: function (response) {
                var data='<span>';
                if(response.status==200){
                    $.each(response.details, function (key, value)
                    {
                        $('#mail_id').val(value.id);
                        $('#mail_name').val(value.name);
                        $('#mail_blockname').val(value.block_name);
                        $('#mail_email').val(value.email);

                  });
                }
                else if(response.status==404)
                {
                    $.each(response.message, function (key, value)
                    {
                      maildetails=+'<span>'+value.message+ '</span>';
                  });

                }
            }
         });
    });

    //MAIL VALIDATION CODE******************************************

    $('#mail_data').validate({
        rules: {
            subject: {
                required: true,
            },
            name:{
                required:true,
            },
            email:{
                required:true,
                email: true
            },
            block_name:{
                required:true,
            }

        },
        messages: {
            subject: {
                required: "Please enter your  subject",
            },
            name:{
                required :"Please enter your name ",
            },
            block_name:{
                required: "Please enter your title",
            },
            email:{

                required: "Please enter your email ",
                email: "incorrect email format"

            }


        }

    // $('#mail_data').submit(function(e)
    // {

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //         e.preventDefault();
    //         var id= $('#mail_id').val();

    //         var name= $('#mail_name').val();
    //         // console.log(name);
    //         var block_name=$('#mail_blockname').val();
    //         var email= $('#mail_email').val();
    //         var subject= $('#mail_subject').val();
    //         if((name.length)==0)
    //         {
    //             var msg="you can not empty that field";
    //             $('#msg').html(msg);
    //         }
    //         else if((block_name.length)==0)
    //         {
    //             var msg="you can not empty that field";
    //             $('#msg').html(msg);
    //         }
    //         else if((email.length)==0)
    //         {
    //             var msg="you can not empty that field";
    //             $('#msg').html(msg);
    //         }
    //         else if((subject.length)==0)
    //         {
    //              var msg="you can not empty that field";
    //             $('#msg').html(msg);
    //         }

    //         else{

    //             $.ajax({
    //                 type: "post",
    //                 url: "/mail",
    //                 data:{
    //                     id:id,
    //                     name:name,
    //                     block_name:block_name,
    //                     email:email,
    //                     subject:subject
    //                 },
    //                 dataType: "json",
    //                 success: function (response) {

    //                 }
    //             });
    //         }







     });


});
