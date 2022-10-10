$(document).ready(function () {
    $(".PHPQuestion").hide();
    $(".addTech").hide();
    $(".mcqQuestion").click(function (e) {
        e.preventDefault();
        $(".mcqQuestion").hide();
        $(".PHPQuestion").show();

        var technology_id = $(".mcqQuestion").data("id");
        //console.log(technology_id);

        $.ajax({
            method: "post",
            url: "/admin/mcq_frameworks",
            data: { technology_id: technology_id },
            dataType: "JSON",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    var mcq_questions = " ";
                    let i = 1;
                    $.each(response.technology_id, function (key, value) {
                        mcq_questions +=
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
                    $("#mcq").append(mcq_questions);
                }
            },
        });
    });
    $(document).on("click", "#clicframework", function (e) {
        e.preventDefault();
        $(".hii").hide();
        $(".addTech").show();
        var frameworkId = $(this).data("id");
        $("#mcq_frameworkid").val(frameworkId);
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
                            `</h4>  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mcqModal">
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
                    $("#mcq_q").append(
                        '<button type="button" class="btn btn-primary" id="submitt" value="submit">Send</button>'
                    );
                }
            },
        });
    });
    
});
