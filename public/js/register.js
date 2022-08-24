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
   // let url ='{{route("userRegister")}}';

    // let mydata={};
    // mydata.name=name;
    // mydata.email=email;
    // mydata.password=password;
    // mydata.password_confirmation=password_confirmation;
    // console.log(mydata);
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
            //console.log(response);
            var success=response.success;
           
				$('#invalid').append('<div class="alert alert-success"style="margin-bottom:15px;">'+success+'</div');
                window.location="/login";
        },
        error:function(xhr){

            $('#invalid').html('');
                  $.each(xhr.responseJSON.errors, function(key,value) {
                $('#invalid').append('<div class="alert alert-danger"style="margin-bottom:15px; height:70px;">'+value+'</div');
            }); 
       }

    });

});


});