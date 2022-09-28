$(document).ready(function () {

    $('#indexblocks').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/totalquizblocks',
        columns: [
            {data: 'DT_RowIndex', name: 'Dt_RowIndex'},
            {data: 'block_name', name: 'block_name'},
            {data: 'question_count', name: 'question_count'},
            {data: 'action', name: 'action'}
        ]
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#show_block_data').hide();
    $('#load_users_list').hide();
    var users_count = 0;
    var ques_count = 0;

    //Fetch Stored Block Data
    function Fetch_Block_Data(limit, ques_count) {
        let block_id = $('#store_block_id').val();
        $('#show_block_data').show();
        $('#show_blocks').hide();
        $("#block_table > tbody").empty();
        // console.log(block_id);
        $.ajax({
            type: "get",
            url: "/admin/blocks/" + block_id,
            data: {
                limit: limit,
                ques_count: ques_count
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    let i = 1;
                    var block_questions = "";
                    $.each(response.block, function (key, value) {
                        block_questions += `<tr>
                                            <td>`+ i + `</td>
                                            <td>`+ value.question + `</td>
                                         </tr>`;
                        i++;

                    });
                    $('#block_table').append(block_questions);
                    $("#block_table > tfoot").empty();
                    $("#block_table > tfoot").html('<button type="button" id="assign_users_btn" data-id="' + block_id + '" class="btn btn-info"><i class="fa-solid fa-eye"></i>&nbsp;Assign</button>');

                } else
                    if (response.status == 404) {
                        // $('#pageloader_quiz_button').hide();
                        // $("#users_detail_table > tbody").empty();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No record Found!',
                            timer: 1000
                        })

                    }

            }
        });
    }

    //Fetch Detail of Selected Block
    $(document).on('click', '#show_block_btn', function () {
        let block_id = $(this).data('id');
        $('#store_block_id').val(block_id);
        let limit = $('#block_data_limit').find(":selected").text();
        ques_count = 0;
        Fetch_Block_Data(limit, ques_count);
    });

    //Function for Fetching Users
    function Fetch_Users_Data(limit, users_count) {
        let block_id = $('#store_block_id').val();
        $('#load_users_list').show();
        $('#show_block_data').hide();
        $('#show_blocks').hide();

        // console.log(limit);
        $("#users_detail_table > tbody").empty();
        $.ajax({
            type: "get",
            url: "/admin/blockusers",
            data: {
                limit: limit,
                users_count: users_count,
            },
            dataType: "json",
            success: function (response) {
                // console.log(response);
                if (response.status == 200) {
                    let i = 1;
                    var users_data = "";
                    $.each(response.users, function (key, value) {
                        if (value.block_id == block_id) {
                            users_data += `<tr >
                                            <td><input type="checkbox" class="get_value" data-id="`+ value.id + `" disabled></td>
                                            <td>`+ i + `</td>
                                            <td>`+ value.name + `</td>
                                            <td>`+ value.email + `</td>
                                            <td><span class="text-danger">&nbsp;&nbsp;Already Assigned<span><td>
                                         </tr>`;
                        }
                        else {
                            users_data += `<tr>
                                            <td><input type="checkbox" class="get_value" data-id="`+ value.id + `"></td>
                                            <td>`+ i + `</td>
                                            <td>`+ value.name + `</td>
                                            <td>`+ value.email + `</td>
                                            <td><td>
                                         </tr>`;
                        }
                        i++;
                    });
                    $('#users_detail_table').append(users_data);
                    $("#users_detail_table > tfoot").html(`<tr>
                    <td colspan="2">

                    </td>
                    <td colspan="2">
                        <form>
                        <button id="assign_block" data-id="`+ block_id + `"type="submit" class="btn btn-primary">Assign Block</button>
                        </form>
                    </td>
                </tr>`);
                    // $('#pageloader_quiz_button').show();
                    if (response.users.length == limit) {
                        $('#pageloader_quiz_button').show();
                    } else {
                        $('#pageloader_quiz_button').hide();
                    }
                }
                else
                    if (response.status == 404) {
                        $('#pageloader_quiz_button').hide();
                        $("#users_detail_table > tbody").empty();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No record Found!',
                            timer: 1000
                        })
                        // $('#test_table').html('<img src="/img/no-record-found.gif" width=100%>');

                    }
            }
        });

    }

    //Fetch Users Click Event
    $(document).on('click', '#assign_users_btn', function (e) {
        e.preventDefault();
        let limit = $('#users_list_limit').find(":selected").text();
        users_count = 0;
        Fetch_Users_Data(limit, users_count);

    });

    //Assign Blocks to Users
    $(document).on('click', '#assign_block', function (e) {
        e.preventDefault();
        let block_id = $(this).data('id');
        // console.log(block_id);
        var user_id = [];
        $(':checkbox').each(function () {
            if ($(this).is(":checked")) {
                user_id.push($(this).data('id'));
            }
        });
        user_id = user_id.toString();
        if (user_id == '') {
            $.toast({
                heading: 'Warning',
                text: 'Please select any User. ;)',
                showHideTransition: 'plain',
                position: {
                    right: 50,
                    bottom: 30
                },
                icon: 'warning'
            })
            return false;
        }

        // console.log(user_id);
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to assign!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#008000',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Assign it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "post",
                    url: "/admin/asssignblock",
                    data: {
                        user_id: user_id,
                        block_id: block_id
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 200) {
                            swal.fire({
                                title: "Block Assigned!",
                                text: "Block Assigned Successfully.",
                                icon: 'success',
                                timer: 1000
                            }).then(function () {
                                location.reload(true);
                            });
                        } else if (response.status == 404) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                timer: 1000
                            })
                        }
                    }
                });
            }
        })
    });

    // $('#show_blocks_limit').on('change', function () {
    //     let page_limit = this.value;
    //     let technology_id = $('#store_technology_id').val();
    //     let framework_id = $('#store_framework_id').val();
    //     FetchQuestion(id, technology_id, framework_id, page_limit);
    //     // alert($page_limit);
    // });

    $('#block_data_limit').on('change', function () {
        let limit = this.value;
        ques_count = 0;
        Fetch_Block_Data(limit, ques_count);
        // alert($page_limit);
    });

    $('#users_list_limit').on('change', function () {
        let limit = this.value;
        users_count = 0;
        Fetch_Users_Data(limit, users_count);

        // alert($page_limit);
    });
});
