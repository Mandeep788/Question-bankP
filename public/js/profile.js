$(document).ready(function () {
    $('#myform').validate({
        rules: {
            profile_name: {
                required: true,

            },
            profile_experience: {
                required: true,
                digits: true

            },
            profile_designation: {
                required: true,

            },
            profile_last_company: {
                required: true,
            },
            profile_address: {
                required: true,
            },
        },
        messages: {
            profile_name: {
                required: "Please enter your name",
            },
            profile_experience:{
                required: "Please enter your experience",
            },
            profile_designation:{
                required: "Please enter your designation",
            },
            profile_last_company:{
                required: "Please enter your last company",
            },
            profile_address:{
                required: "Please enter your address",
            }

        },
        // success: function() {
        //     Swal.fire({
        //             title: 'Success!',
        //             text: 'Profile updated Successfully.',
        //             type: 'success',
        //             icon:'success',
        //             timer: 1000
        //          });
        // }
        submitHandler:function(form)
        {
            swal({
                title: 'Success!',
                text: 'Profile updated Successfully.',
                type: 'success',
                icon:'success',
                timer: 1000
            });
            form.submit();
        }

    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function getProfile(){
        $.ajax({
            type: "get",
            url: "/admin/profile/user",
            enctype: 'multipart/form-data',
            dataType: "json",
            cache: false,
            success: function (data) {
                $.each(data, function (key, value) {
                    $('#profile_name').val(value.name);
                    $('#profile_email').val(value.email);
                    $('#profile_experience').val(value.experience);
                    $('#profile_designation').val(value.designation);
                    $('#profile_last_company').val(value.last_company);
                    $('#profile_address').val(value.address);
                    $("input[name=profile_gender][value=" + value.gender + "]").attr('checked', 'checked');
                    if(value.image==""){
                        $('#preview-image').html('<i class="bi bi-person-bounding-box" style="font-size:100px"></i>');
                    }else{
                    $('#preview-image').html('<img id="user_img" src="' +value.image+ '" style="width: 250px;">');
                    }
                    $('.image_file').click(function () {
                        $('#user_img').hide();
                    });
                });
            }
        });
    }
    getProfile();

    $('#image').change(function(){
        $('#preview-image').html('<img src="" class="preview-image" style="width: 250px;">');
        let reader = new FileReader();
        reader.onload = (e) => {
          $('.preview-image').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);

       });


});
