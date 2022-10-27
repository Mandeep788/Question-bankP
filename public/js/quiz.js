$(document).ready(function () {

    //JqValidation for Create  quiz block
    $('#testDescriptionForm').validate({
        rules: {
            test_description: {
                required: true,
            },
            test_timer: {
                required: true,
                digits:true
            }
        },
        messages: {
            test_description: {
                required: "Please add description",
            },
            test_timer: {
                required: "Please add timer",
                digits: "Timer must be in digits"
            }
        }
    });

    $('#testRandomDescriptionForm').validate({
        rules: {
            testRandomDescription: {
                required: true,
            },
            randomTestTimer: {
                required: true,
                digits:true
            }
        },
        messages: {
            testRandomDescription: {
                required: "Please add description",
            },
            randomTestTimer: {
                required: "Please add timer",
                digits: "Timer must be in digits"
            }
        }
    });
    $('#load_frameworks_quiz').hide();
    $('#load_question_quiz').hide();

    $('.bread_home').click(function (e) {
        e.preventDefault();
        $('#load_frameworks_quiz').hide();
        $('#load_question_quiz').hide();
        $('#load_technologies_quiz').show();
    });
    $('.bread_technology').click(function (e) {
        e.preventDefault();
        $('#load_frameworks_quiz').show();
        $('#load_question_quiz').hide();
        $('#load_technologies_quiz').hide();
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var quiz_count = 0;   //Global Variable

    //Fetch Frameworks of a Technology
    $(document).on('click', '#techGoBtn', function (e) {
        e.preventDefault();
        // alert();
        // let id = $(this).data('id');
        $('#load_technologies_quiz').hide();
        $('#load_frameworks_quiz').show();
        $('#dynamic_frameworks_quiz').empty();
        $('.spinner-grow').show();
        let technology_id = [];
        $('.technology_check').each(function () {
            if ($(this).is(":checked")) {
                technology_id.push($(this).data('id'));
            }
        });
        technology_id = technology_id.toString();
        $('#quiz_technology_id').val(technology_id);
        // console.log(technology_id);
        $.ajax({
            type: "get",
            url: "/admin/quiz/frameworks",
            data: {
                technology_id: technology_id
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                // window.history.pushState('new','title','/admin/frameworks/'+id);
                if (response.status == 200) {
                    $frame_data = '<div class="row justify-content-left">';
                    // console.log(response);
                    $.each(response.frameworks, function (key, value) {
                        $frame_data += `<div class="col-lg-4 col-md-12">
                                        <div id="white_boxx">
                                            <div id="clickframeworkquiz" data-id="`+ value.id + `" data-name="` + value.framework_name + `">
                                                <h4>`+ value.framework_name + `</h4>
                                            </div>
                                            <div id="icons_gap">
                                    <input type="checkbox" data-id="`+ value.id + `" class="frameworks_check">
                                </div>
                                        </div>
                                    </div>`;

                        // $('#quiz_technology_name').val(value.technology_name);

                        // $('.bread_tech').text(value.technology_name);

                    });
                    $frame_data += `</div><div>
                    <button id="frameGoBtn" class="btn btn-success">Next </button>
                </div>`;
                    $('.spinner-grow').hide();
                    $('#dynamic_frameworks_quiz').append($frame_data);

                } else if (response.status == 404) {
                    $.each(response.technology, function (key, value) {
                        // $('#quiz_technology_id').val(value.id);
                        // $('#quiz_technology_name').val(value.technology_name);
                        // $('.bread_tech').text(value.technology_name);

                        $('.spinner-grow').hide();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No record Found!',
                        }).then(function () {
                            location.reload(true);
                        });

                    });
                }


            }
        });
    });

    //Function for Fetching Questions
    function FetchQuizQuestion(frameworks_id, exp_id, limit) {
        // $('#test_table').html('');
        $("#test_table > tbody").empty();
        quiz_count = 0;
        $.ajax({
            type: "get",
            url: "/admin/quiz/questions",
            data: {
                frameworks_id: frameworks_id,
                exp_id: exp_id,
                limit: limit,
                quiz_count: quiz_count
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    $('.addQuesForQues').hide();
                    let i = 1;
                    var questions_data = "";
                    $.each(response.questions, function (key, value) {
                        questions_data += `<tr>
                                            <td><input type="checkbox" class="ques_checkbox" data-id="`+ value.id + `"></td>
                                            <td>`+ i + `</td>
                                            <td>`+ value.question + `</td>
                                         </tr>`;
                        i++;
                    });
                    $('#totalQues').val(response.countQuestions);
                    $('#test_table').append(questions_data);
                    // $('#pageloader_quiz_button').show();
                    if (response.questions.length == limit) {
                        $('#pageloader_quiz_button').show();
                    } else {
                        $('#pageloader_quiz_button').hide();

                    }
                }
                else
                    if (response.status == 404) {
                        $('#pageloader_quiz_button').hide();
                        $("#test_table > thead").empty();
                        $("#test_table > tbody").empty();
                        $("#test_table > tfoot").empty();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No record Found!',
                        })
                        $('.addQuesForQues').show();
                        $(".addQuesForQues").click(function (e) {
                            e.preventDefault();
                            window.location = "/admin/technologies";
                        });
                        $('.noDataFound').html('<img src="/img/No data-cuate.png" width=50% height=50%; style="margin-left:25%">');


                    }
            }
        });
    }

    //Click Event for Fetching Questions
    $(document).on('click', '#frameGoBtn', function (e) {
        e.preventDefault();
        let frameworks_id = [];
        $('.frameworks_check').each(function () {
            if ($(this).is(":checked")) {
                frameworks_id.push($(this).data('id'));
            }
        });
        frameworks_id = frameworks_id.toString();
        // console.log(frameworks_id);
        $('#load_frameworks_quiz').hide();
        $('#load_question_quiz').show();
       
        let exp_id = 0;
        let limit = $('#quiz_page_limit').find(":selected").text();
        $('#quiz_framework_id').val(frameworks_id);
      
        FetchQuizQuestion(frameworks_id, exp_id, limit);

    });

    //Select all Functionality
    $(document).on('click', '#select-all-ques', function (event) {
        var $that = $(this);
        $('.ques_checkbox').each(function () {
            this.checked = $that.is(':checked');
        });
    });

    //Page Loader
    $('#pageloader_quiz_button').click(function () {
        let frameworks_id = $('#quiz_framework_id').val();
        // let tech_id = $('#quiz_technology_id').val();
        let experience_id = $('#quiz_experience').find(":selected").val();
        let limit = $('#quiz_page_limit').find(":selected").text();
        quiz_count++;
        // alert(count);
        $('#pageloader_quiz_button').hide();
        $('#quiz_page_loader_image').show();
        $.ajax({
            type: "get",
            url: "/admin/quiz/questions",
            data: {
                // tech_id: tech_id,
                frameworks_id: frameworks_id,
                exp_id: experience_id,
                limit: limit,
                quiz_count: quiz_count
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    let i = parseInt((quiz_count * limit) + 1);
                    var questions_data = "";
                    $.each(response.questions, function (key, value) {
                        questions_data += `<tr>
                                            <td><input type="checkbox" class="ques_checkbox" value="`+ value.id + `"></td>
                                            <td>`+ i + `</td>
                                            <td>`+ value.question + `</td>
                                         </tr>`;
                        i++;
                    });
                    $('#test_table').append(questions_data);
                    $('#quiz_page_loader_image').hide();
                    let total = parseInt(quiz_count * limit) + parseInt(limit);

                    let totalrecord = parseInt(quiz_count * limit) + parseInt(response.questions.length);

                    if (total == totalrecord) {
                        $('#pageloader_quiz_button').show();
                    } else {
                        $('#pageloader_quiz_button').hide();
                    }
                }
                else
                    if (response.status == 404) {
                        $('#pageloader_quiz_button').hide();
                        $('#quiz_page_loader_image').hide();

                        // $("#test_table > tbody"). empty();
                        // $('#test_table').html('<img src="/img/no-record-found.gif" width=100%>');

                    }
            }
        });

    });

    //Page Limit
    $('#quiz_page_limit').on('change', function () {
        let page_limit = this.value;
        let frame_id = $('#quiz_framework_id').val();
        // let tech_id = $('#quiz_technology_id').val();
        let experience_id = $('#quiz_experience').find(":selected").val();

        FetchQuizQuestion(frame_id, experience_id, page_limit);
        // alert(page_limit);
    });

    //Select experience
    $('#quiz_experience').on('change', function () {
        let experience_id = this.value;
        let frame_id = $('#quiz_framework_id').val();
        // let tech_id = $('#quiz_technology_id').val();
        let limit = $('#quiz_page_limit').find(":selected").text();
        // alert(tech_id);
        FetchQuizQuestion(frame_id, experience_id, limit);
        // alert($page_limit);
    });


    //Create a quiz module
    $('.make_test').click(function (e) {
        e.preventDefault();
        $('#testDescriptionForm').valid();
        let block_name = $('#test_description').val();
        let timer = $('#test_timer').val();
        if(timer == "" || block_name == "" ){
            return false;
        }
        var insert = [];
        $('.ques_checkbox').each(function () {
            if ($(this).is(":checked")) {
                insert.push($(this).data('id'));
            }
        });
        insert = insert.toString();
        $(this).attr('disabled', true);
        if (insert == '') {
            $.toast({
                heading: 'Warning',
                text: 'Please select any question. ;)',
                showHideTransition: 'plain',
                position: {
                    right: 50,
                    bottom: 30
                },
                icon: 'warning'
            })
            return false;
        }

        // console.log(insert);
        $.ajax({
            type: "Post",
            url: "/admin/quiz/questions",
            data: {
                block_name: block_name,
                insert: insert,
                timer: timer
            },
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {

                    swal.fire({
                        title: 'Added',
                        text: 'Quiz Block Added Successfully',
                        icon: 'success',
                        timer: 1000
                    }).then(function () {
                        window.location = '/admin/indexblock';
                    });
                }
            }
        });
    });


    //Random Questions

    $(document).on('click', '#genterateRandom', function (e) {
        e.preventDefault();
        let frameworksId = $('#quiz_framework_id').val();
        let numberOfQuestions = $('#noOfQues').val().trim();

        let totalQues = $('#totalQues').val().trim();
        if(totalQues > 0){
            if(parseInt(numberOfQuestions) > parseInt(totalQues)){
                $('#randomQuesError').html('Number of questions should be less than total number of questions')
                return false;
            }else{
                // console.log(numberOfQuestions , totalQues );
                $('#randomQuesError').html('');
            }
        }

        $("#randomTestTable > tbody").empty();

        $.ajax({
            type: "get",
            url: "/admin/quiz/randomquestions",
            data: {
                frameworksId: frameworksId,
                numberOfQuestions:numberOfQuestions
            },
            dataType: "json",
            success: function (response) {
                $('#randomQuesModal').modal('hide');
                // console.log(response);
                if (response.status == 200) {
                    $('#modal2').modal('show');
                    $('.addQuesForQues').hide();
                    let i = 1;
                    let j = '';
                    let k = '';
                    var questions_data = "";
                    $.each(response.questions1, function (key, value) {
                        questions_data += `<tr>
                                            <td><input type="checkbox" class="randomQuesCheckbox" data-id="`+ value.id + `"></td>
                                            <td>`+ i + `</td>
                                            <td>`+ value.question + `</td>
                                         </tr>`;
                        i++;
                        j=i;
                    });
                    $.each(response.questions2, function (key, value) {
                        questions_data += `<tr>
                                            <td><input type="checkbox" class="randomQuesCheckbox" data-id="`+ value.id + `"></td>
                                            <td>`+ j + `</td>
                                            <td>`+ value.question + `</td>
                                         </tr>`;
                        j++;
                        k=j;
                    });
                    $.each(response.questions3, function (key, value) {
                        questions_data += `<tr>
                                            <td><input type="checkbox" class="randomQuesCheckbox" data-id="`+ value.id + `"></td>
                                            <td>`+ k + `</td>
                                            <td>`+ value.question + `</td>
                                         </tr>`;
                        k++;
                    });
                    $('#randomTestTable').append(questions_data);

                }
                else
                    if (response.status == 404) {
                        $("#randomTestTable > thead").empty();
                        $("#randomTestTable > tbody").empty();
                        $("#randomTestTable > tfoot").empty();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No record Found!',
                        })
                        $('.addQuesForQues').show();
                        $(".addQuesForQues").click(function (e) {
                            e.preventDefault();
                            window.location = "/admin/technologies";
                        });
                        $('.noDataFound').html('<img src="/img/No data-cuate.png" width=50% height=50%; style="margin-left:25%">');


                    }
            }

        });
    });

    $(document).on('click', '#select-all-random', function (event) {
        var $that = $(this);
        $('.randomQuesCheckbox').each(function () {
            this.checked = $that.is(':checked');
        });
    });

    //Random Questions Test
    $('.makeRandomQuesTest').click(function (e) {
        e.preventDefault();
        $('#testRandomDescriptionForm').valid();
        let block_name = $('#testRandomDescription').val();
        let timer = $('#randomTestTimer').val();
        if(timer == "" || block_name == "" ){
            return false;
        }
        var insert = [];
        $('.randomQuesCheckbox').each(function () {
            if ($(this).is(":checked")) {
                insert.push($(this).data('id'));
            }
        });
        insert = insert.toString();
        $(this).attr('disabled', true);
        if (insert == '') {
            $.toast({
                heading: 'Warning',
                text: 'Please select any question. ;)',
                showHideTransition: 'plain',
                position: {
                    right: 50,
                    bottom: 30
                },
                icon: 'warning'
            })
            return false;
        }

        $.ajax({
            type: "Post",
            url: "/admin/quiz/questions",
            data: {
                block_name: block_name,
                insert: insert,
                timer: timer
            },
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {

                    swal.fire({
                        title: 'Added',
                        text: 'Quiz Block Added Successfully',
                        icon: 'success',
                        timer: 1000
                    }).then(function () {
                        window.location = '/admin/indexblock';
                    });
                }
            }
        });
    });

});
