$(document).ready(function(){
    $('#formid').validate({
        rules:{
            old_password :           {required:true,
                                        minlength:6},
            new_password :           {required:true,
                                        minlength:6},
            new_password_confirmation : {required:true,
                                        minlength:6},
        },
        messages:
        {
            old_password : {required: "Enter your old password",
            minlength:"Old Password must be  6 character",
            },

            new_password : {required: "Enter new password",
            minlength:"New Password must be  6 character",
            },

            new_password_confirmation : {required : "Confirm password",
            minlength:"Confirm Password must be  6 character",
            },
        },
    });
});
