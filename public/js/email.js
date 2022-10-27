$(document).ready(function(){
    $(document).on('click','.sendEmail',function(){

    $('#sendEmailModal').modal('show');
       var id = $(this).attr("data-id");
       $("#email-box").val(id);
       var id =  $("#email-box").val();

       $.ajax({
        type: "get",
        url: "/admin/show-data",
        data: {
            id:id
        },
        dataType: "json",
        success: function (response) {
            if (response.status == 200)
            {
                $("#name").val(response.data[0]['name']);
                $("#blockname").val(response.data[0]['block_name']);
                $("#email").val(response.data[0]['email']);

            }
        }
    });

    });

});


$("form#sendDataInEmailForm").validate({
    rules: {
        subject: {
                required: true,
            },
        message: {
            required: true,
        }
    },
    messages: {
        first: {
                required: "Please enter Subject",
            },
        middle: {
            required: "Please enter Message",
        }
    },
});



