$(document).ready(function () {
    $(".addTech").hide();
    $(".mcqQuestion").click(function (e) {
        e.preventDefault();
        $(".mcqQuestion").hide();
        var technology_id = $(".mcqQuestion").data("id");
        //console.log(technology_id);
        $.ajax({
            method: "post",
            url: "/admin/mcq_frameworks",
            data: { technology_id: technology_id },
            dataType: "JSON",
            success: function (response) {
                console.log(response);
                if (response.status == 200) {
                    var mcqFrameworks = " ";
                    let i = 1;
                    $.each(response.technology_id, function (key, value) {
                        mcqFrameworks +=
                            `<div class="col-lg-12 col-md-12">
                        <div id="white_bo">
                        <div id="clicframework" data-id="` +
                            value.id +
                            `" data-name="` +
                            value.framework_name +
                            `">
                            <h4 class="hii">` +
                            value.framework_name +
                            ` &nbsp;<i class="bi bi-arrow-right-circle icon_hover"></i></h4>
                        </div>
                        </div>
                        </div>`;
                        i++;
                    });
                    $('.con').append(mcqFrameworks);
                }
            },
        });
    });
    $(document).on("click", "#clicframework", function (e) {
        e.preventDefault();
        $(".con").hide();
        $(".addTech").show();
        var frameworkId = $(this).data("id");
        $(".form3 #mcq_frameworkid").val(frameworkId);
        $(".formEdit #mcq_frameworkidEdit").val(frameworkId);
        //console.log(frameworkId);

        $.ajax({
            method: "post",
            url: "/admin/mcq_questions",
            data: { frameworkId: frameworkId },
            dataType: "JSON",
            success: function (response) {
                //console.log(response);
                if (response.status == 200) {
                    var mcqQuestion = "";
                    let i = 1;
                    $.each(response.mcqQuestions, function (key, value) {
                        mcqQuestion +=
                            `<div class="row-lg-12">
                                        <div class="col" id="multipleChoice">
                                            <div id="quewstionId" data-id="` +
                            value.id +
                            `">
                                            <h4>Q.` +
                            i +
                            ` ` +
                            value.question +
                            `</h4>  <button type="button" class="btn btn-primary" id="editMCQBtn" data-id="`+ value.id + `">
                            Edit
                          </button>`;
                        $.each(value.answer, function (key, value) {
                            mcqQuestion += `<div class="form-group">`;
                            if (value.status == 1) {
                                mcqQuestion +=
                                    `<input class="form-group-input" type="radio" name="flexRadioDefault` +
                                    i +
                                    `" id="flexRadioDefault1" checked>
                                     <label class="form-group-label" for="flexRadioDefault1">` +
                                    value.mcq_answers;
                            } else {
                                mcqQuestion +=
                                    `<input class="form-group-input" type="radio" name="flexRadioDefault` +
                                    i +
                                    `" id="flexRadioDefault1" disabled>
                                     <label class="form-group-label" for="flexRadioDefault1">` +
                                    value.mcq_answers;
                            }
                            mcqQuestion += ` </div> `;
                        });
                        `</div>
                         </div>
                        </div>`;
                        i++;
                    });
                    $("#mcq_q").append(mcqQuestion);
                }
            },
        });
    });


    $(document).on("click", ".remove", function (e) {
        $(this).parents(".control-group").remove();
    })
    $(document).on("click", ".add-more", function (e) {
        var counter = parseInt($('.counter').val());
        var html = '<div class="control-group input-group" style="margin-top:10px">\n' +
            '                            <input type="text" name="mcq_answer[' + counter +']" class="form-control mb-3 add-more-input" placeholder="Enter Answer Here"><br>\n' +
            '                            <div class="input-group-btn">\n' +
            '                                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>\n' +
            '                            </div>\n' +
            '                        </div>';
        var inputLength = $('.add-more-input').length;
        if(inputLength <= 5) {
            $(".after-add-more").append(html);
            $("#multipleAnswersDiv").append(html);
            $('.counter').val( counter + 1 );
        }

    })

    $('.form3').on('submit', function(event) {

        //Add validation rule for dynamically generated name fields
        $('.add-more-input').each(function() {
            $(this).rules("add",
                {
                    required: true,
                    messages: {
                        required: "Please Enter Answer",
                    }
                });
        });
    });
    $(".form3").validate({
        rules:{
            experience_id:{required:true},
            mcq_question:{required:true},
            correctAnswer:{required:true},


        },
        messages:{
            experience_id:{
                required:"Enter experience",
            },
            mcq_question:{
                required:"Please enter Question",
            },
            correctAnswer:{
                required:"Please enter correct answer",
            },
        }


    });
    $(document).on("click", "#editMCQBtn", function (e) {
        var id = $(this).attr('data-id');
        $("#mcqQuestionId").val(id);
        $("#mcqModal").modal('show');
        $.ajax({
            method: "get",
            url: "/admin/mcq_questions/getEditMcq",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function (response) {
                if(response.status==200){
                    var experience =response.mcqQuestions.experience_id;
                    var mcqQuestion =response.mcqQuestions.mcq_questions;
                    $('#experience option[value='+experience+']').attr("selected", "selected");
                    $("#mcq_question_edit").val(mcqQuestion);
                    $.each(response.mcqAnswers, function (key, value) {
                        var removeBtn ='<div class="input-group-btn"><button class="btn btn-danger removeDatabase" type="button" data-id="'+value.mcq_question_id+'"><i class="glyphicon glyphicon-remove"></i> Remove</button></div>';
                        var addBtn ='<div class="input-group-btn"><button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button></div>';
                        var html = '<div class="control-group input-group">\n' +
                            '<input type="text" name="mcq_answer[]" class="form-control mb-3 add-more-input" placeholder="Enter Name Here" value="'+value.mcq_answers+'"><br>';
                        if(key == 0){
                            html += addBtn;
                        }else{
                            html += removeBtn;
                        }
                        html +=  '</div>';
                        $('#multipleAnswersDiv').append(html);

                        if(value.status == 1){
                            $("#correctAnswerEdit").val(value.mcq_answers);
                        }
                    })

                }
            }
        });
    })

    $(document).on("click", ".removeDatabase", function (e) {
        var id = $(this).attr('data-id');
        var elem = $(this);
        $.ajax({
            method: "delete",
            url: "/admin/mcq_questions/removeAnswer",
            data: { id: id },
            dataType: "JSON",
            success: function (response) {
                if(response.status==200) {
                    elem.parents(".control-group").remove();
                    elem.parent().remove();
                }
            }
        })
    })
});

