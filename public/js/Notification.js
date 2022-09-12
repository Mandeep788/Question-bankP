$(document).ready(function(){

    count_notifications();

    function count_notifications(){
        let u_id=$('#user_id').val();
        $.ajax({
            type: "get",
            url: "/get_count_value",
            data: {
                u_id:u_id
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                $('.count').text(response);

            }
        });
    }
    $('#notification_value').click(function(){
      let u_id=$('#user_id').val();
    //   console.log(u_id);
    // $('#block_id').val(block_id);



    $('.modal-body').empty();
      $.ajax({
        type: "get",
        url: "/notification/"+u_id,

        success: function (response) {

            console.log(response);
            $notification_data="<span> ";
            $.each(response.notification,function(key,value){
                $notification_data+= '<p><a data-id= "'+value.id+'" href="#" id="start_quiz">'+ value.block_name + '</a></p>';

            });
            $notification_data += '</span>';
            $('.modal-body').append($notification_data);



        }
      });

    });

});
