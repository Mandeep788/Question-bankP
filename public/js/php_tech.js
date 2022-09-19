$(document).ready(function () {
    $('#icon-back').click(function () {
        $('#tech_question_display').hide();
        $('.div1').show();
    });
    var limit = 10;
    var count = 0;
    var onuserchange=0;

    $('#tech_question_display').hide();


    function FetchUserQuestions(fid,tech_id,experience_id,limit,count){
        // delete window.count;
        // clearTimeout(count);
        // $.removeData(count);
        console.log(onuserchange);
        count=0;
        $.ajax({
            method: "get",
            url: "/core_php",
            data: {
                fid: fid,
                tech_id: tech_id,
                experience_id: experience_id,
                limit: limit,
                count:count
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    $question_data = '';
                    let i = 1;
                    $.each(response.ques, function (key, value) {
                        $question_data += `<div class="col-lg-12 col-md-12">
                        <h4 class="mb-4 fw-bold"><span>Q`+ i + `.</span>` + value.question + `</h4>
                        <p><span>Ans.</span>&nbsp;&nbsp;&nbsp;`+ value.answer + `</p>
                        </div><hr>`;
                        i++;

                    });
                    $('#ques').append($question_data);
                    $('#page_loader_image').hide();
                    let total = parseInt(count * limit) + parseInt(limit);

                    let totalrecord = parseInt(count * limit) + parseInt(response.ques.length);

                    if (total == totalrecord) {
                        $('#pageloader_button').show();
                    } else {
                        $('#pageloader_button').hide();
                    }

                }else if(response.status==404){
                    $('#pageloader_button').hide();
                    $('#page_loader_image').hide();
                    var url = '/user_img/img/100465-no-data-found.gif';
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No record Found!',
                        timer:1000
                    })

                    $('#ques').append('<img src="'+url+'" style="width:90%; height:400px;">');
                    
                
                }

            }
        });
    }

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
        $('#ques').empty();
        FetchUserQuestions(fid,tech_id,experience_id,limit,count);


    });






    // ***************experience fetching code********************************



    $('#experience_id').on('change', function () {

        let experience_id = $('#experience_id').find(":selected").val();
        onuserchange=1;
        // console.log( experience_id);

        var tech_id = $('#tech_id').val();
        var fid = $('#frame_id').val();
        $('#tech_id').val(tech_id);
        $('#frame_id').val(fid);
        $('#experiance_id').val(experience_id);
        // console.log(fid);
        // console.log( tech_id);
         $('#ques').empty();
         FetchUserQuestions(fid,tech_id,experience_id,limit,count);



    });

    // console.log(onuserchange);


    $('#page_loader_image').hide();
    $('#pageloader_button').click(function() {
        if(onuserchange==1){
            count=0;
            onuserchange=0;
        }
        count++;
        $('#page_loader_image').show();
        $('#pageloader_button').hide();
        let experience_id = $('#experience_id').find(":selected").val();
        // console.log( experience_id);

        var tech_id = $('#tech_id').val();
        var fid = $('#frame_id').val();


        $.ajax({
            method: "get",
            url: "/core_php",
            data: {
                fid: fid,
                tech_id: tech_id,
                experience_id: experience_id,
                limit: limit,
                count:count
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
                if (response.status == 200) {
                    $question_data = '';
                    let i = (count * limit) + 1;
                    $.each(response.ques, function (key, value) {
                        $question_data += `<div class="col-lg-12 col-md-12">
                        <h4 class="mb-4 fw-bold"><span>Q`+ i + `.</span>` + value.question + `</h4>
                        <p><span>Ans.</span>&nbsp;&nbsp;&nbsp;`+ value.answer + `</p>
                        </div><hr>`;
                        i++;

                    });
                    $('#ques').append($question_data);
                    $('#page_loader_image').hide();
                    let total = parseInt(count * limit) + parseInt(limit);

                    let totalrecord = parseInt(count * limit) + parseInt(response.ques.length);

                    if (total == totalrecord) {
                        $('#pageloader_button').show();
                    } else {
                        $('#pageloader_button').hide();
                    }

                 }

            }
        });
    });


});


