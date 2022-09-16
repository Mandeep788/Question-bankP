$(document).ready(function(){
    $('#logout').click(function(e){
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/admin/logout",
            // data: "data",
            dataType: "json",
            success: function (response) {
                if(response.status==200){
                    Swal.fire({
                        title: 'Success!',
                        text: 'Logout Successfully.',
                        icon:'success',
                        timer: 1000
                     }).then(function () {
                        window.location = '/login';
                    });
                }

            }
        });

    });

});
