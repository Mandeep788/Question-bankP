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
                        <div id="clickframework" data-id="`+ value.id + `" data-name="` + value.framework_name + `">
                            <h4>`+ value.framework_name + ` &nbsp;<i class="bi bi-arrow-right-circle icon_hover"></i></h4>
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
});
