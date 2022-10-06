$(document).ready(function(){
    $(".PHPQuestion").hide();
    $(".mcqQuestion").click(function(e){
            e.preventDefault();
            $(".mcqQuestion").hide();
            $(".PHPQuestion").show();
            var technology_id = $('.mcqQuestion').data("id");
            //console.log(technology_id);

        $.ajax({
            method:"post",
            url:"/admin/mcq_frameworks",
            data:{technology_id:technology_id},
            dataType:"JSON",
            success:function(response){
               // console.log(response);
               if(response.status == 200){
                   var mcq_questions =' ';
                    let i=1;
                    $.each(response.technology_id, function(key,value){
                        mcq_questions += `<div class="col-lg-12 col-md-12">
                        <div id="white_boxx">
                        <div id="clicframework" data-id="`+ value.id + `" data-name="` + value.framework_name + `">
                            <h4 class="hii">`+ value.framework_name + ` &nbsp;<i class="bi bi-arrow-right-circle icon_hover"></i></h4>
                        </div>
                        </div>
                        </div>`;
                        i++; 
                    });
                    $("#mcq").append(mcq_questions);
                }
            }
        });
    });
    $(document).on("click","#clicframework", function(e){
        e.preventDefault();
        $(".hii").hide();
        var frameworkId = $(this).data('id');
        //console.log(frameworkId);
        $.ajax({
            method:"post",
            url:"/admin/mcq_questions",
            data:{frameworkId:frameworkId},
            dataType:"JSON",
            success:function(response){
               // console.log(response);
               if(response.status==200){
                var mcqQuestion = '';
                let i=1;
                $.each(response.mcqQuestion, function(key,value){
                    mcqQuestion += `<div class="row-lg-12">
                                        <div class="col" id="multipleChoice">
                                            <div id="quewstionId" data-id="`+value.id+`">
                                            <h4>Q.`+i+` `+value.mcq_questions+` </h4>                                        
                                            </div>
                                        </div>
                                    </div>` ;
                    i++;
                });
                $("#mcq_q").append(mcqQuestion);
               }

            }
        });
    });
});

