function toggleLight(element){
    //load lightbulb
    //turn on/turn off
    //execute python
    console.log($('#lightbulb_').parent());
    console.log(element);
    $.ajax({
        type: "POST",
        url: "ajax/lightbulb_ajax.php",
        data: { 
                AJAX : (true)
                } ,
        success: function (data) {
            console.log("Success! " + data);
        },
        error: function(data){
            console.log("Error" + data);
        }
    });
}