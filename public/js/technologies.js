$(document).ready(function () {
    $("#back_btn").click(function(){
        $(".framework_content").attr('style', 'display: none');
        $("#load_technologies_data").removeAttr('style', 'display: none');
        $("#clickable").click(function () {
            $(".framework_content").removeAttr('style', 'display: none');
        });
    });

    $("#back_btnn").click(function(){
        $(".experience_content").attr('style', 'display: none');
        $("#load_frameworks_data").removeAttr('style', 'display: none');
        $("#clickframework").click(function () {
            $(".experience_content").removeAttr('style', 'display: none');
        });
    });

    $("#back_btnnn").click(function(){
        $(".ques_ans_content").attr('style', 'display: none');
        $("#load_experience_data").removeAttr('style', 'display: none');
        $("#clickexperience").click(function () {
            $(".ques_ans_content").removeAttr('style', 'display: none');
        });

    });

    $('#load_frameworks_data').hide();
    $('#load_experience_data').hide();
    $('#load_question_data').hide();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Update Technologies

    $('#editTechnologyForm').submit(function (e) {
        e.preventDefault();
        var update_form = new FormData(document.getElementById("editTechnologyForm"));

        var url = $('#editTechnologyForm').attr('action');
        var id = $('#technology_id').val();
        $('#update_technology').text('Updating...');
        $.ajax({
            type: "post",
            url: url,
            data: update_form,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "JSON",

            success: function (response) {
                console.log(response);
                if (response.status == 200) {
                    $('#update_technology').text('Update Technology');
                    $('#editTechnologyForm')[0].reset();
                    $('#editTechnologyModal').modal('hide');
                    swal.fire({
                        title: "Updated!",
                        text: "Technology Updated.",
                        type: "success"
                    }).then(function () {

                        location.reload(true);

                    });
                }


            }
        });
    });
    // Add Technologies

    $('#addTechnologyForm').submit(function (e) {
        e.preventDefault();
        // alert();
        var Tech_form = new FormData(this);
        // console.log(Tech_form[0]);
        $('#add_technology').text('Adding...');
        $.ajax({
            type: "POST",
            url: "/admin/technologies",
            data: Tech_form,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (response) {

                if (response.status == 200) {
                    $('#add_technology').text('Add Technology');
                    $('#addTechnologyForm')[0].reset();
                    $('#addTechnologyModal').modal('hide');
                    swal.fire(
                        'Added',
                        'Technology Added Successfully',
                        'success'
                    ).then(function () {

                        location.reload(true);

                    });
                }

            }
        });
    });

    //Edit technology

    $(document).on('click', '#edit_technology', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.ajax({
            type: "get",
            url: "/admin/technologies/edit",
            data: {
                id: id
            },
            success: function (response) {
                $('#edit_technology_name').val(response.technology_name);
                $('#edit_technology_description').val(response.technology_description);
                $('#technology_id').val(response.id);

            }
        });

    });

    //Delete Technology

    $(document).on('click', '#delete_technology', function (e) {
        e.preventDefault();

        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/technologies/delete/' + id,
                    method: 'delete',
                    data: {
                        id: id
                    },
                    success: function (response) {
                        console.log(response);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then(function () {

                            location.reload(true);

                        });
                        //   fetchAllEmployees();
                    }
                });
            }
        })

    });

    //Fetch Frameworks

    $(document).on('click', '#clickable', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $('#load_technologies_data').hide();
        $('#load_frameworks_data').show();
        $('#dynamic_frameworks').empty();
        $.ajax({
            type: "get",
            url: "/admin/frameworks/"+id,
            // data: {
            //     tech_id: id
            // },
            dataType: "json",
            success: function (response) {
                // window.history.pushState('new','title','/admin/frameworks/'+id);
                if (response.status == 200) {
                    $frame_data = '<div class="row justify-content-left">';
                    // console.log(response);
                    $.each(response.frameworks, function (key, value) {
                        $frame_data += `<div class="col-lg-4 col-md-12">
                                        <div id="white_boxx">
                                            <div id="clickframework" data-id="`+ value.id + `" data-name="` + value.framework_name + `">
                                                <h4>`+ value.framework_name + `</h4>
                                            </div>
                                            <div id="icons_gap">
                                                <a id="delete_framework" data-id="`+ value.id + `" >
                                                    <i class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;
                                                </a>
                                                <a id="edit_framework" data-id="`+ value.id + `" data-bs-toggle="modal" data-bs-target="#editFrameworkModal" >
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>`;
                        $('#store_technology_id').val(value.technology_id);
                        $('#store_technology_name').val(value.technology_name);
                    });
                    $frame_data += '</div>';

                    $('#dynamic_frameworks').append($frame_data);

                } else if (response.status == 404) {

                    $.each(response.technology, function (key, value) {
                        $('#store_technology_id').val(value.id);
                        $('#store_technology_name').val(value.technology_name);
                        // $('#frame_technology_id').val(value.id);
                        // $('#frame_technology_name').val(value.technology_name);
                    });
                }


            }
        });
    });

    //Fetch Function
    function FetchFramework() {
        let id = $('#store_technology_id').val();
        // console.log(id);
        $('#load_technologies_data').hide();
        $('#load_frameworks_data').show();
        $('#dynamic_frameworks').empty();

        $.ajax({
            type: "get",
            url: "/admin/frameworks",
            data: {
                tech_id: id
            },
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    $frame_data = '<div class="row justify-content-left">';
                    // console.log(response);
                    $.each(response.frameworks, function (key, value) {
                        $frame_data += `<div class="col-lg-4 col-md-12">
                                        <div id="white_boxx">
                                            <div id="clickframework" data-id="`+ value.id + `" data-name="` + value.framework_name + `">
                                                <h4>`+ value.framework_name + `</h4>
                                            </div>
                                            <div id="icons_gap">
                                                <a id="delete_framework" data-id="`+ value.id + `" href="">
                                                    <i class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;
                                                </a>
                                                <a id="edit_framework" data-id="`+ value.id + `" data-bs-toggle="modal" data-bs-target="#editFrameworkModal" href="">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>`;
                        $('#store_technology_id').val(value.technology_id);
                        $('#store_technology_name').val(value.technology_name);
                    });
                    $frame_data += '</div>';

                    $('#dynamic_frameworks').append($frame_data);

                } else if (response.status == 404) {

                    $.each(response.technology, function (key, value) {
                        $('#store_technology_id').val(value.id);
                        $('#store_technology_name').val(value.technology_name);
                        // $('#frame_technology_id').val(value.id);
                        // $('#frame_technology_name').val(value.technology_name);
                    });
                }


            }
        });

    }

    //Show add Framework Modal
    $('#show_Framework_Modal').click(function (e) {
        e.preventDefault();
        $('#addFrameworkModal').modal('show');
        var id = $('#store_technology_id').val();
        var name = $('#store_technology_name').val();
        $('#frame_technology_id').val(id);
        $('#frame_technology_name').val(name);
    });

    //Insert New Frameworks

    $('#addFrameworkForm').submit(function (e) {
        e.preventDefault();
        // alert();
        var Tech_form = new FormData(this);
        // console.log(Tech_form[0]);
        $('#add_framework').text('Adding...');
        $.ajax({
            type: "POST",
            url: "/admin/frameworks",
            data: Tech_form,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    $('#add_framework').text('Add Framework');
                    $('#addFrameworkForm')[0].reset();
                    $('#addFrameworkModal').modal('hide');
                    swal.fire(
                        'Added',
                        'Framework Added Successfully',
                        'success'
                    ).then(function () {

                        FetchFramework();

                    });
                }

            }
        });
    });

    //Edit Framework

    $(document).on('click', '#edit_framework', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        // console.log(id);
        $.ajax({
            type: "get",
            url: "/admin/frameworks/edit/" + id,
            success: function (response) {
                // console.log(response);
                $('#editframe_technology_id').val(response.technology_id);
                $('#edit_framework_name').val(response.framework_name);
                $('#edit_framework_description').val(response.framework_description);
                $('#framework_id').val(response.id);

            }
        });

    });
    // Update Framework
    $('#editFrameworkForm').submit(function (e) {
        e.preventDefault();
        var update_form = new FormData(document.getElementById("editFrameworkForm"));

        var url = $('#editFrameworkForm').attr('action');
        var id = $('#framework_id').val();
        $('#update_framework').text('Updating...');
        $.ajax({
            type: "post",
            url: url + '/' + id,
            data: update_form,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "JSON",

            success: function (response) {
                console.log(response);
                if (response.status == 200) {
                    $('#update_framework').text('Update Framework');
                    $('#editFrameworkForm')[0].reset();
                    $('#editFrameworkModal').modal('hide');
                    swal.fire({
                        title: "Updated!",
                        text: "Framework Updated.",
                        type: "success"
                    }).then(function () {

                        FetchFramework();

                    });
                }


            }
        });
    });

    //Delete Framework

    $(document).on('click', '#delete_framework', function (e) {
        e.preventDefault();

        let id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/frameworks/delete/' + id,
                    method: 'delete',
                    data: {
                        id: id
                    },
                    success: function (response) {
                        console.log(response);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then(function () {

                            location.reload(true);

                        });
                        //   fetchAllEmployees();
                    }
                });
            }
        })

    });

    //Show Experience Window
    $(document).on('click', '#clickframework', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let framework_name = $(this).data('name');
        // console.log(framework_name);
        $('#store_framework_id').val(id);
        $('#store_framework_name').val(framework_name);
        $('#load_technologies_data').hide();
        $('#load_frameworks_data').hide();
        $('#load_experience_data').show();
        $('#dynamic_experience').empty();
        $.ajax({
            type: "get",
            url: "/admin/experiences",
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    $experience_data = '<div class="row justify-content-left">';
                    // console.log(response);
                    $.each(response.experience, function (key, value) {
                        $experience_data += `<div class="col-lg-4 col-md-12">
                                        <div id="white_boxx">
                                            <div id="clickexperience" data-id="`+ value.id + `" data-name="` + value.experience_name + `">
                                                <h4>`+ value.experience_name + `</h4>
                                            </div>
                                            <div id="icons_gap">
                                                <a id="delete_experience" data-id="`+ value.id + `" href="">
                                                    <i class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;
                                                </a>
                                                <a id="edit_experience" data-id="`+ value.id + `" data-bs-toggle="modal" data-bs-target="#editExperienceModal" href="">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>`;
                    });
                    $experience_data += '</div>';
                    $('#dynamic_experience').append($experience_data);
                }
            }
        });
    });

    function FetchExperience() {
        $('#dynamic_experience').empty();
        $.ajax({
            type: "get",
            url: "/admin/experiences",
            dataType: "json",
            success: function (response) {
                if (response.status == 200) {
                    $experience_data = '<div class="row justify-content-left">';
                    // console.log(response);
                    $.each(response.experience, function (key, value) {
                        $experience_data += `<div class="col-lg-4 col-md-12">
                                        <div id="white_boxx">
                                            <div id="clickexperience" data-id="`+ value.id + `" data-name="` + value.experience_name + `">
                                                <h4>`+ value.experience_name + `</h4>
                                            </div>
                                            <div id="icons_gap">
                                                <a id="delete_experience" data-id="`+ value.id + `" href="">
                                                    <i class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;
                                                </a>
                                                <a id="edit_experience" data-id="`+ value.id + `" data-bs-toggle="modal" data-bs-target="#editExperienceModal" href="">
                                                    <i class="fa-solid fa-pencil"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>`;
                    });
                    $experience_data += '</div>';
                    $('#dynamic_experience').append($experience_data);
                }
            }
        });
    }

    //Insert New Experience
    $('#addExperienceForm').submit(function (e) {
        e.preventDefault();
        var Exp_form = new FormData(this);
        $('#add_experience').text('Adding...');
        $.ajax({
            type: "POST",
            url: "/admin/experiences",
            data: Exp_form,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    $('#add_experience').text('Add Experience');
                    $('#addExperienceForm')[0].reset();
                    $('#addExperienceModal').modal('hide');
                    swal.fire(
                        'Added',
                        'Experience Added Successfully',
                        'success'
                    ).then(function () {

                        FetchExperience();

                    });
                }

            }
        });
    });

    //Edit Experience
    $(document).on('click', '#edit_experience', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        // console.log(id);
        $.ajax({
            type: "get",
            url: "/admin/experiences/edit/" + id,
            success: function (response) {
                // console.log(response);
                $('#edit_experience_name').val(response.experience_name);
                $('#experience_id').val(response.id);

            }
        });

    });

    // Update Experience
    $('#editExperienceForm').submit(function (e) {
        e.preventDefault();
        var update_form = new FormData(document.getElementById("editExperienceForm"));

        var url = $('#editExperienceForm').attr('action');
        var id = $('#experience_id').val();
        $('#update_experience').text('Updating...');
        $.ajax({
            type: "post",
            url: url + '/' + id,
            data: update_form,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "JSON",

            success: function (response) {
                console.log(response);
                if (response.status == 200) {
                    $('#update_experience').text('Update Experience');
                    $('#editExperienceForm')[0].reset();
                    $('#editExperienceModal').modal('hide');
                    swal.fire({
                        title: "Updated!",
                        text: "Experience Updated.",
                        type: "success"
                    }).then(function () {

                        FetchExperience();

                    });
                }
            }
        });
    });

    //Delete Experience
    $(document).on('click', '#delete_experience', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/experiences/delete/' + id,
                    method: 'delete',
                    data: {
                        id: id
                    },
                    success: function (response) {
                        // console.log(response);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then(function () {
                            FetchExperience();
                        });
                        //   fetchAllEmployees();
                    }
                });
            }
        })

    });

    //Fetch Question Function
    function FetchQuestion(id) {
        $('#dynamic_question').empty();
        $.ajax({
            type: "get",
            url: "/admin/questions/" + id,
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    $question_data = '<div class="row justify-content-center">';
                    let i = 1;
                    $.each(response.Ques, function (key, value) {
                        $question_data += `<div class="col-lg-12 col-md-12">
                                                <div id="white_boxes">
                                                    <h4><span>Q`+ i + `.</span>` + value.question + `</h4>
                                                    <p><span>Ans.</span><button type="button" id="show_answer_modal" data-id="`+ value.id + `" data-name="` + value.question + `" class="btn btn-success mt-3 mx-5">Add Answer</button><p></p>
                                                    <span><i data-id="`+ value.id + `" id="delete_question" class="fa-solid fa-trash-can text-danger"></i>
                                                </div>
                                            </div>`;
                        i++;
                    });
                    $question_data += '</div>';
                    $('#dynamic_question').append($question_data);
                    $ques_answer = '<div class="row justify-content-center">';
                    $.each(response.QuesAnswer, function (key, value) {
                        $ques_answer += `<div class="col-lg-12 col-md-12">
                                    <div id="white_boxes">
                                        <h4><span>Q`+ i + `.</span>` + value.question + `</h4>
                                        <p><span>Ans.</span>&nbsp;&nbsp;&nbsp;`+ value.answer + `</p>
                                        <span><i data-id="`+ value.question_id + `" id="delete_QuesAnswer"  class="fa-solid fa-trash-can text-danger"></i>&nbsp;&nbsp;<i id="edit_QuesAnswer"  data-id="` + value.question_id + `" data-bs-toggle="modal" data-bs-target="#editQuestionModal" class="fa-solid fa-pencil"></i></span>
                                    </div>
                                </div>`;
                        i++;
                    });
                    $ques_answer += '</div>';
                    $('#dynamic_question').append($ques_answer);
                }
            }
        });
    }
    //Show Questions
    $(document).on('click', '#clickexperience', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let experience_name = $(this).data('name');
        // console.log(framework_name);
        $('#store_experience_id').val(id);
        $('#store_experience_name').val(experience_name);
        $('#load_technologies_data').hide();
        $('#load_frameworks_data').hide();
        $('#load_experience_data').hide();
        $('#load_question_data').show();

        FetchQuestion(id);

    });

    //Show add Question Modal
    $('#show_Question_Modal').click(function (e) {
        e.preventDefault();
        $('#addQuestionModal').modal('show');
        let technology_id = $('#store_technology_id').val();
        let technology_name = $('#store_technology_name').val();
        let framework_id = $('#store_framework_id').val();
        let framework_name = $('#store_framework_name').val();
        let experience_id = $('#store_experience_id').val();
        let experience_name = $('#store_experience_name').val();
        $('#ques_technology_id').val(technology_id);
        $('#ques_technology_name').val(technology_name);
        $('#ques_framework_id').val(framework_id);
        $('#ques_framework_name').val(framework_name);
        $('#ques_experience_id').val(experience_id);
        $('#ques_experience_name').val(experience_name);
    });

    // Insert new Question
    $('#addQuestionForm').submit(function (e) {
        e.preventDefault();
        let id = $('#store_experience_id').val();
        var Ques_form = new FormData(this);
        $('#add_question').text('Adding...');
        $.ajax({
            type: "POST",
            url: "/admin/questions",
            data: Ques_form,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    $('#add_question').text('Add Question');
                    $('#addQuestionForm')[0].reset();
                    $('#addQuestionModal').modal('hide');
                    swal.fire(
                        'Added',
                        'Question Added Successfully',
                        'success'
                    ).then(function () {

                        FetchQuestion(id);

                    });
                }

            }
        });
    });

    //Show add Answer Modal
    $(document).on('click', '#show_answer_modal', function (e) {
        e.preventDefault();
        let question_id = $(this).data('id');
        let question = $(this).data('name');
        // console.log(this);
        $('#store_question').val(question);
        $('#store_question_id').val(question_id);
        $('#addAnswerModal').modal('show');
    });

    // Insert new Answer
    $('#addAnswerForm').submit(function (e) {
        e.preventDefault();
        let id = $('#store_experience_id').val();
        var Ans_form = new FormData(document.getElementById("addAnswerForm"));
        // console.log(Ans_form);
        $('#add_answer').text('Adding...');
        $.ajax({
            type: "POST",
            url: "/admin/answers",
            data: Ans_form,
            processData: false,
            contentType: false,
            dataType: "JSON",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    $('#a').text('Add Answer');
                    $('#addAnswerForm')[0].reset();
                    $('#addAnswerModal').modal('hide');
                    swal.fire(
                        'Added',
                        'Answer Added Successfully',
                        'success'
                    ).then(function () {
                        FetchQuestion(id);
                    });
                }

            }
        });
    });

    //Edit Experience
    $(document).on('click', '#edit_QuesAnswer', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        // console.log(id);
        $.ajax({
            type: "get",
            url: "/admin/questions/edit/" + id,
            success: function (response) {
                // console.log(response);
                $('#edit_question').val(response.question);
                $('#edit_answer').val(response.answer);
                $('#edit_question_id').val(response.question_id);
            }
        });

    });
    // Update Experience
    $('#editQuestionForm').submit(function (e) {
        e.preventDefault();
        var update_form = new FormData(document.getElementById("editQuestionForm"));

        var url = $('#editQuestionForm').attr('action');
        var id = $('#edit_question_id').val();
        let experience_id = $('#store_experience_id').val();
        // console.log(id);
        $('#update_question').text('Updating...');
        $.ajax({
            type: "post",
            url: url + '/' + id,
            data: update_form,
            cache: false,
            processData: false,
            contentType: false,
            dataType: "JSON",

            success: function (response) {
                console.log(response);
                if (response.status == 200) {
                    $('#update_question').text('Update');
                    $('#editQuestionForm')[0].reset();
                    $('#editQuestionModal').modal('hide');
                    swal.fire({
                        title: "Updated!",
                        text: "Question Answer Updated.",
                        type: "success"
                    }).then(function () {

                        FetchQuestion(experience_id);

                    });
                }
            }
        });
    });

    //Delete Question Answer Function
    function deleteQuestion(id) {
        let experience_id = $('#store_experience_id').val();
        // console.log(id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/admin/questions/delete/' + id,
                    method: 'delete',
                    success: function (response) {
                        if (response.status == 200) {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            ).then(function () {
                                FetchQuestion(experience_id);
                            });
                        }
                    }
                });
            }
        })

    }
    //Delete Question
    $(document).on('click', '#delete_question', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        deleteQuestion(id);
    });

    //Delete Question Answer
    $(document).on('click', '#delete_QuesAnswer', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        deleteQuestion(id);
    });

    // load more
    $('.page_loader_image').hide();
    $('#pageloader_button').click(function () {
        $('.pageloader_button').hide();
        $('.page_loader_image').show();

    });
});