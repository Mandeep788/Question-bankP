$(document).ready(function() {
    $(".btn").click(function() {
        var val = parseInt($('#group').find('.badge').text());

        // Check for the button clicked
        if ($(this).hasClass('btn-danger')) {
            $('#group').find('.badge').text(val - 1);
        } else if ($(this).hasClass('btn-success')) {
            $('#group').find('.badge').text(val + 1);
        }
    });
});


window.onscroll = function() {
    myFunction()
};

var header = document.getElementById("myHeader");
var sticky = header.offsetTop;

function myFunction() {
    if (window.pageYOffset > sticky) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
}
