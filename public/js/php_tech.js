$(document).ready(function () {
    $('#icon-back').click(function () {
        $('#tech_question_display').hide();
        $('.div1').show();
    });
    $('#tech_question_display').hide();
    $('.link').click(function () {
        var fid = $(this).data("id");
        var tech_id = $(this).data("techid");
        $('#tech_id').val(tech_id);
        $('#frame_id').val(fid);

        var experience_id =0;
        // console.log(fid);
        // console.log(tech_id);
        $('#tech_question_display').toggle();
        $('.div1').hide();
        $('.question_display').empty();

        $.ajax({
            method: "get",
            url: "/core_php",
            data: {
                fid: fid,
                tech_id: tech_id,
                experience_id: experience_id
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.status == 200) {

                    $question_data = '<div class="row justify-content-center p-5" id="ques">';
                    let i = 1;
                    $.each(response.ques, function (key, value) {
                        $question_data += `<div class="col-lg-12 col-md-12">
                        <h4 class="mb-4 fw-bold"><span>Q`+ i + `.</span>` + value.question + `</h4>
                        <p><span>Ans.</span>&nbsp;&nbsp;&nbsp;`+ value.answer + `</p>
                        </div><hr>`;
                        i++;

                    });
                    $question_data += '</div>';
                    $('.question_display').append($question_data);
                  
                 }

            }
        });

    });






    // ***************experience fetching code********************************



    $('#experience_id').on('change', function () {

        let experience_id = $('#experience_id').find(":selected").val();
        // console.log( experience_id);

        var tech_id = $('#tech_id').val();
        var fid = $('#frame_id').val();
        $('#tech_id').val(tech_id);
        $('#frame_id').val(fid);
        $('#experiance_id').val(experience_id);
        // console.log(fid);
        // console.log( tech_id);
         $('.question_display').empty();
        $.ajax({
            method: "get",
            url: "/core_php",
            data: {
                fid: fid,
                tech_id: tech_id,
                experience_id: experience_id
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.status == 200) {
                    $question_data = '<div class="row justify-content-center p-5">';
                    let i = 1;
                    $.each(response.ques, function (key, value) {
                        $question_data += `<div class="col-lg-12 col-md-12">
                        <div id="white_boxes">
                        <h4 class="mb-4 fw-bold"><span>Q`+ i + `.</span>` + value.question + `</h4>
                        <p><span>Ans.</span>&nbsp;&nbsp;&nbsp;`+ value.answer + `</p>
                        </div>
                        </div><hr>`;
                        i++;

                    });
                    $question_data += '</div>';
                    $('.question_display').append($question_data);

                }
            }
        });


    });

    // var id = $('.link').data("id");
    // var tech_id = $('.link').data("techid");


});


// });
