$(document).ready(function () {
//     var param = 4; // Change this if you want more or les than 2 hours

// var today = new Date();
// var newDate = today.setHours(today.getHours() + param);

// $('#getting').countdown(newDate, function(event) {
//   $(this).html(event.strftime('%H:%M:%S'));
// });
// $('#getting').countdown('2020/10/10', function(event) {
//     $(this).html(event.strftime('%D days %H:%M:%S'));
// });

// var newYear = new Date();
// newYear = new Date(newYear.getFullYear() + 1, 1 - 1, 1);
// $('#getting').countdown({until: newYear});

$(function(){
    var timer = $('#quiz_timer').val();
    var quizStartTime = $('#quiz_started_at').val();
    // let timerSec=parseInt(timer*60)
    // console.log(timerSec);
    var d2 = new Date();
    var cHour = d2.getHours();
    var cMin = d2.getMinutes();
    var cSec = d2.getSeconds();
    var d2sec=parseInt(cHour*3600)+ parseInt(cMin*60)+ parseInt(cSec);
    // alert(d2sec);
    // var newD2=Date.parse(d2);
    // console.log(d2);
    var d1 = new Date(quizStartTime);
    var d1cHour = d1.getHours();
    var d1cMin = d1.getMinutes();
    var d1cSec = d1.getSeconds();
    var d1sec=parseInt(d1cHour*3600)+ parseInt(d1cMin*60)+ parseInt(d1cSec)+parseInt(timer*60);
    // alert(d1sec);

    // alert(cHour+ ":" + cMin+ ":" +cSec );
    var diff=(parseInt(d1sec-d2sec));
    // alert(diff);
    $('#getting').countdown({until: diff});

//     var minutes = Math.floor(diff / 60000);
//   var seconds = ((diff % 60000) / 1000).toFixed(0);
//   $("#getting").html( minutes + ":" + (seconds < 10 ? '0' : '') + seconds);
     });
});


