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
                if(response=="")
                {
                    $('.count').hide();
                }
                else{
                $('.count').text(response);
                }
            }
        });
    }
    $('#notification_value').click(function(){
      let u_id=$('#user_id').val();
      $('.count').hide();


    $('.modal-body').empty();
      $.ajax({
        type: "put",
        url: "/notification/"+u_id,
        success: function (response) {

            //  console.log(response);
            var notification_data="<span> ";
            if((response.notification.length)==0){
                $('#exampleModal').modal('hide');

            }else{
                $('#exampleModal').modal('show');
                $('.modal-backdrop').removeClass("modal-backdrop");
            $.each(response.notification,function(key,value){
                if(value.status=='P'){
                notification_data+= '<p><a class="notification_design" data-id= "'+value.id+'" href="#" id="start_quiz">Pending ' + value.block_name + '</a></p><hr>';

                }else if(value.status=='C'){
                    notification_data+= '<p><a class="notification_design" data-aggregate= "'+value.block_aggregate+'" data-feedback="'+value.feedback+'" href="#" id="checked_quiz">Reviwed ' + value.block_name + '</a></p><hr>';

                }
                else if(value.status=='I')
                {
                    notification_data+= '<p><a class="notification_design" data-id= "'+value.id+'" href="#" id="start_quiz"><b>Initiated </b> ' + value.block_name + '</a></p><hr>';
                }


            });
            notification_data += '</span>';
            $('#notification').append(notification_data);

        }

        }
      });

    });

});
