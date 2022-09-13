$(document).ready(function () {

    $('#new_user_registration').hide();
    $('#add_user').click(function (e) {
        e.preventDefault();
    $('#new_user_registration').show();
    $('#user_datatable').hide();

    });
    $('.yajra-datatable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/admin/users/list",
        "columns": [
            { "data": "id" },
            { "data": "name" },
            { "data": "email" },
            { "data": "role" },
            { "data": "technology_name" },
            { "data": "designation" },
            { "data": "last_company" },
            { "data": "experience" }
        ]
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // $('#addUserForm').submit(function (e) {
    //     e.preventDefault();
    //     let fd = new FormData(document.getElementById("addUserForm"));
    //     console.log(fd[0]);

    // });
    $('#addUserForm').submit(function (e) {
        e.preventDefault();
        let name = $('#username').val();
        let email = $('#useremail').val();
        let password = $('#userpassword').val();
        let password_confirmation = $('#userConfirmPassword').val();
        var user_tech = [];
        $.each($("#userTech option:selected"), function () {
            user_tech.push($(this).val());
        });
        let technology_name = user_tech.join(", ");
        let role = $("#userRole option:selected").val();
        let designation = $('#userDesignation').val();
        let current_company = $('#userCurrentCompany').val();
        let last_company = $('#userLastCompany').val();
        let experience = $('#userExperience').val();
        // let mydata = {};

        // console.log(mydata);


        $('#add_new_user').text('Adding...');
        $.ajax({
            type: "POST",
            url: "/admin/users",
            data: {
                // "_token": "{{ csrf_token() }}",
                name: name,
                email: email,
                password: password,
                password_confirmation: password_confirmation,
                technology_name: technology_name,
                role: role,
                designation: designation,
                current_company: current_company,
                last_company: last_company,
                experience: experience,
            },
            // cache:false,
            // processData: false,
            // contentType: false,
            dataType: "JSON",
            beforSend:function(){
                $(document).find('span.error-text').text('');
            },
            success: function (response) {
                console.log(response.errors);
                if(response.status==409){
                    $.each(response.errors, function (prefix, value) {
                        $('span.'+prefix+'_error').text(value[0]);
                    });
                }
                if (response.status == 200) {
                    $('#add_new_user').text('Add User');
                    $('#addUserForm')[0].reset();
                    $('#addUserModal').modal('hide');
                    swal.fire({
                        title: 'Added',
                        text: 'User Added Successfully',
                        icon:'success',
                        timer: 1000
                     }).then(function () {
                        location.reload();
                    });
                }

            }

        });
    });
});

