$(document).ready(function () {
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
$(document).on('click',".updateAdmin",function(){
    //    document.querySelector(".updateAdmin").addEventListener('click', function(){
        Swal.fire({
            title: 'Success!',
            text: 'Profile updated Successfully.',
            type: 'success',
            icon:'success',
            timer: 1000
         });
      });

});
