$(document).ready ( function (){
    $("#clickMe").on("click", function (){
        var id = $(this).data('id');
        var technology_id = $(this).data('techid');
        console.log(id);
        //console.log(technology_id);
        $("#id").val(id);
        $("#tech_id").val(technology_id);
    });
});