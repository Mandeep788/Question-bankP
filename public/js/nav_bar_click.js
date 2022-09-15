$(document).ready(function(){
    $('.nav-link').click(function(e){
        e.preventDefault();
        var id= $(this).data("id");
        //console.log(id);
        $.ajax({
            method:"get",
            url:"/tech_data/"+id,
            success:function(response){
             if(response)
             {
                window.location.href="/user_tech/"+id;
             }
            }

        });
    });
});
