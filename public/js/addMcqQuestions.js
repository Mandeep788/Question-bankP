$(document).ready(function(){
    //validation on add technology
    $(".form3").validate({
        rules:{
            experience_name:{required:true,},
            mcq_question:{required:true,},
            mcq_answer:{required:true,},
        }
        messages:{
            experience_name:{
                required:"Enter your Experience",
            },
            mcq_question:{
                required:"Enter Question",                
            },
            mcq_answer:{
                required:"Enter answer",
            },
        }
    });


});