// const inputs = document.querySelectorAll(".input");

// function addcl() {
//     let parent = this.parentNode.parentNode;
//     parent.classList.add("focus");
// }

// function remcl() {
//     let parent = this.parentNode.parentNode;
//     if (this.value == "") {
//         parent.classList.remove("focus");
//     }
// }


// inputs.forEach(input => {
//     input.addEventListener("focus", addcl);
//     input.addEventListener("blur", remcl);
// });

$(document).ready(function () {

    $("#login").click(function (e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var email = $("#email").val();
        var password = $("#password").val();
        var rememberme=null;
        setInterval(function() {
			$('#slide_in').fadeOut('linear',function(){
					$(this).empty();
			});
		}, 2000);
        if ($('#rememberme').is(":checked"))
        {
            rememberme=rememberme;
        }

        $.ajax({
            type: "POST",
            url: "/login",
            data: {
                email: email,
                password: password,
                rememberme:rememberme
            },

            success: function (response) {

                $('#invalid').html('');
                var result = response;
                if (result == 'admin') {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Admin Login Successfully.',
                        icon:'success',
                        timer: 1000
                     }).then(function () {
                        window.location = '/admin/dashboard';
                    });
                }
                if (result =='user') {
                    Swal.fire({
                        title: 'Success!',
                        text: 'User Login Successfully.',
                        icon:'success',
                        timer: 1000
                     }).then(function () {
                        window.location = "/dashboard";
                    });
                }
                //error code area-
                var error = response.error;
                if (!$.trim(response.error)){
                } else {
                    $('#invalid').append('<div class="alert alert-danger"style="margin-bottom:15px;">' + error + '</div');
                }
            },
            error: function (xhr) {
                $('#invalid').html('');
                $.each(xhr.responseJSON.errors, function (key, value) {
                    $('#invalid').append('<div class="alert alert-danger "style="margin-bottom:15px;">' + value + '</div');
                });
            }
            //end error area-------------------------------------------------------------------------
        });

    });

});

