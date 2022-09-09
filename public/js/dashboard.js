$(document).ready(function () {
    // $('#feedback_div').hide();
    $('.red_circle').hide();
    Fetch_Counts();
    Fetch_Notifications();
    function Fetch_Counts() {
        $.ajax({
            type: "get",
            url: "/admin/dashboard-data",
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response != null || response != undefined) {
                    if (response.technologies != null || response.technologies != undefined) {
                        $('#technologies_count').html(response.technologies);
                    }
                    if (response.users != null || response.users != undefined) {
                        $('#users_count').html(response.users);
                    }
                    if (response.questions != null || response.questions != undefined) {
                        $('#questions_count').html(response.questions);
                    }
                }
            }
        });
    }

    function Fetch_Notifications() {
        $.ajax({
            type: "get",
            url: "/admin/notifiications",
            dataType: "json",
            success: function (response) {
                // console.log(response.count_notifications);
                if (response.status == 200) {
                    $('.red_circle').show();
                    if (parseInt(response.count_notifications) < 10) {
                        $('.red_circle').text(response.count_notifications);
                    } else {
                        $('.red_circle').text('9+');
                    }
                    var notifications_desc = "";
                    $.each(response.notifications, function (key, value) {
                        notifications_desc += `<a href="/admin/userassessment/` + value.id + `" ><p>` + value.name + ` submitted ` + value.block_name + `</p></a><hr>`;
                    });
                    $('#notifications_desc').append(notifications_desc);
                } else if (response.status == 404) {
                    $('.red_circle').hide();
                }
            }
        });
    }

    $(document).on('click', '#show_submitted_block', function () {
        $('#feedback_div').show();
        $('#submitted_block').hide();


        let id = $(this).data('id');

        $.ajax({
            type: "get",
            url: "/admin/assessmentdata",
            data: {
                id: id,
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    let i = 1;
                    $submitted_data = '<div class="row justify-content-center">';
                    $.each(response.submitted_data, function (key, value) {
                        $submitted_data += `<div class="col-lg-12 col-md-12">
                                    <div id="white_boxes">
                                        <h4 data-id="`+value.question_id+`"><span>Q`+ i + `.</span>` + value.question + `</h4>
                                        <p><span>Ans.</span>&nbsp;&nbsp;&nbsp;`+ value.answer + `</p>
                                        <input type="text" id="assess_user" value="`+ value.users_id + `" hidden>
                                        <div class="d-flex">
                                            <div class="marks_on_each">
                                                <select class="form-select individual_marks assign_marks_btn">
                                                <option value="" selected disabled>Assign Marks</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                </select>
                                            </div>
                                            <div class="tick">
                                                <i class="bi bi-check-circle check_tick"> Uncheck</i>
                                            </div>
                                        </div>

                                    </div>


                                </div> `;

                        i++;
                    });

                    $submitted_data += `</div>`;

                    $('#dynamic_submitted_block').append($submitted_data);
                } else if (response.status == 404) {

                }
            }
        });


    });

    $(document).on('click','.check_tick', function () {
        
     let single_mark= $(this).parent().parent().find('.individual_marks').find(":selected").val();
     if(single_mark!=""){
        $(this).addClass('green');
        $(this).html('  Checked');
     }

    });

    $(document).on('change','.individual_marks', function () {
        // $(this).parent().find('.check_tick');
        // $(this).closest().find('.check_tick');
        $(this).parent().parent().find('.check_tick').removeClass('green');
        $(this).parent().parent().find('.check_tick').html('  Uncheck');

    //    console.log(check);

    });

    $('.test_marks_btn').click(function (e) {
            e.preventDefault();
            var marks='';
            var total=0;
            var i=0;
            $('.individual_marks').each(function () {
                marks = parseInt($(this).find(":selected").text());
                total = total + marks ;
                i++;
            });
            let aggergate=parseFloat(total/i);
            aggergate=aggergate.toFixed(2);
            // console.log(aggergate);
            $('#store_aggregate').val(aggergate);
            let users_id = $('#assess_user').val();
            let question = $('#question_id').val();
            let answer = $('#answer').val();
            // console.log(users_id, question, answer);
            // var parent_id = $(this).parent().parent().attr('id');
            // $.ajax({
            //     type: "POST",
            //     url: "/admin/asssignblock",
            //     // data:
            //     processData: false,
            //     contentType: false,
            //     dataType: "JSON",
            //     success: function (response) {
            //         // console.log(response);

            //         if (response.status == 200) {

            //             swal.fire({
            //                 title: 'Added',
            //                 text: 'Test Checked Sucessfully',
            //                 icon: 'success',
            //                 timer: 1000
            //             })
            //         }

            //     }
            // });
        });

    });
// });
