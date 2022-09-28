$(document).ready(function () {

    $('#new_user_registration').hide();
    $('#add_user').click(function (e) {
        e.preventDefault();
    $('#new_user_registration').show();
    $('#user_datatable').hide();

    });

    $('#yajra-datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/users/list',
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            // {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'designation', name: 'designation'},
            {data: 'last_company', name: 'last_company'},
            {data: 'experience', name: 'experience'},
            {data: 'technology_name', name: 'technology_name'},
            // {data: 'action', name: 'action', orderable: false, searchable: false}
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
        let technologies_id = user_tech.join(", ");
        let role = $("#userRole option:selected").val();
        let designation = $('#userDesignation').val();
        let current_company = $('#userCurrentCompany').val();
        let last_company = $('#userLastCompany').val();
        let experience = $('#userExperience').val();
        // let mydata = {};

        //  console.log(technology_name);


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
                technologies_id: technologies_id,
                role: role,
                designation: designation,
                current_company: current_company,
                last_company: last_company,
                experience: experience,
            },

            dataType: "JSON",
            beforSend:function(){
                $(document).find('span.error-text').text('');
            },
            success: function (response) {
                // console.log(response.errors);
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

