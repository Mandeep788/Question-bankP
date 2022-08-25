$(document).ready(function(){
  
    $("#back_btn").click(function(){
        $(".framework_content").attr('style', 'display: none');
        $("#load_technologies_data").removeAttr('style', 'display: none');
    });

    $("#back_btnn").click(function(){
        $(".experience_content").attr('style', 'display: none');
        $("#load_frameworks_data").removeAttr('style', 'display: none');
    });


    $("#back_btnnn").click(function(){
        $(".ques_ans_content").attr('style', 'display: none');
        $("#load_experience_data").removeAttr('style', 'display: none');
    });




    
    // $(".framework_content").attr('style', 'display: none');
    // $('#clickable').click(function(){
    //     $(".tech_content").attr('style', 'display: none');
    //     $(".framework_content").removeAttr('style', 'display: none');
    // });

    // $(".add_frameworks_content").attr('style', 'display:none');
    // $("#add_frameworks").click(function(){
    //     $(".tech_content").attr('style', 'display: none');
    //     $(".framework_content").attr('style', 'display: none');
    //     $(".add_frameworks_content").removeAttr('style', 'display:none');
    // });

    // $("#back_to_framework").click(function(){
    //     $(".add_frameworks_content").attr('style', 'display:none');
    //     $(".framework_content").removeAttr('style', 'display: none');
    // });

    // $(".add_tech_content").attr('style', 'display:none');
    // $("#add_tech").click(function(){
    //     $(".tech_content").attr('style', 'display: none');
    //     $(".add_tech_content").removeAttr('style', 'display:none');
    // })

    // $("#back_to_tech").click(function(){
    //     $(".add_tech_content").attr('style', 'display:none');
    //     $(".tech_content").removeAttr('style', 'display:none');
    // });

         // $(".ques_ans_content").attr('style', 'display: none');
    // $("#white_boxx").click(function(){
    //     $(".tech_content").attr('style', 'display: none');
    //     $(".framework_content").attr('style', 'display: none');
    //     $(".ques_ans_content").removeAttr('style', 'display: none');
    // });



});
