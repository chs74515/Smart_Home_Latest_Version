
function updateThermometer(){
    console.log("Current Choice: " + $('#temp_slide').val());
    var choice = $('#temp_slide').val();
    $('#display_value').html(choice + "&deg;");
    choice = parseInt(choice) * 2.5 + 15;
    $(".bar").css({'width' : choice + "px"});
}


