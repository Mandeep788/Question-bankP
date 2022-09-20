$(document).ready(function(){

$('#register').click(function(e){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
        }
    });
    e.preventDefault();
    let name= $('#name').val();
    let email= $('#email').val();
    let password= $('#password').val();
    let password_confirmation= $('#password_confirmation').val();
    $.ajax({
        url:'/register',
        type:"POST",
        data:{
            name:name,
            email:email,
            password:password,
            password_confirmation:password_confirmation
        },
        // dataType:"JSON",
        success:function(response){
            $('#invalid').html('');
            console.log(response);
            // var success=response.success;
            if(response.status==200){
				// $('#invalid').append('<div class="alert alert-success"style="margin-bottom:15px;">'+success+'</div');
                // window.location="";
                Swal.fire({
                    title: 'Success!',
                    text: 'Registration Successfully.',
                    icon:'success',
                    timer: 1000
                 }).then(function () {
                    window.location = '/login';
                });
            }
        },
        error:function(xhr){

            $('#invalid').html('');
                  $.each(xhr.responseJSON.errors, function(key,value) {
                $('#invalid').append('<div class="alert alert-danger"style="margin-bottom:15px;">'+value+'</div');
            });
       }

    });

});


});
