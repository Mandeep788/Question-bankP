$(document).ready(function(){
    $('#logout').click(function(e){
        e.preventDefault();
        $.ajax({
            type: "GET",
            url: "/logout",
            // data: "data",
            // dataType: "dataType",
            success: function (response) {
                window.location="/login";
            }
        });

    });

});