const inputs = document.querySelectorAll(".input");

function addcl() {
    let parent = this.parentNode.parentNode;
    parent.classList.add("focus");
}

function remcl() {
    let parent = this.parentNode.parentNode;
    if (this.value == "") {
        parent.classList.remove("focus");
    }
}


inputs.forEach(input => {
    input.addEventListener("focus", addcl);
    input.addEventListener("blur", remcl);
});

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
        setInterval(function() {
			$('#slide_in').fadeOut('linear',function(){
					$(this).empty();
			});
		}, 2000);

        $.ajax({
            type: "POST",
            url: "/login",
            data: {
                email: email,
                password: password
            },

            success: function (response) {

                $('#invalid').html('');
                var result = response;
                if (result == 'admin') {
                    Swal.fire(
                        'Success!',
                        'Admin Login Successfully.',
                        'success'
                    ).then(function () {
                        window.location = '/admin/dashboard';
                    });
                }
                if (result =='user') {
                    Swal.fire(
                        'Success!',
                        'User Login Successfully.',
                        'success'
                    ).then(function () {
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

