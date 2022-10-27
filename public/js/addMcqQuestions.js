$(document).ready(function(){
    //validation on add technology
    $(".form3").validate({
        rules:{
            experience_id:{required:true},
            mcq_question:{required:true},
           'mcq_answer[]':{required:true},
            correctAnswer:{required:true},
        },
        messages:{
            experience_id:{
                required:"Enter experience",
            },
            mcq_question:{
                required:"Please enter Question",
            },
            'mcq_answer[]':{
                required:"Please enter answer",
            },
            correctAnswer:{
                required:"Please enter correct answer",
            },
        }

    });


});
