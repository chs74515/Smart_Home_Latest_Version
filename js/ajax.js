function toggleLight(element, lightID, status, description){
    //load lightbulb
    //turn on/turn off
    //execute python
    //console.log(status);
    //console.log(element.getAttribute('id'));
    //console.log(description);
    var ele_id = element.getAttribute('id');
    $.ajax({
        type: "POST",
        url: "ajax/lightbulb_ajax.php",
        data: { 
                AJAX : (true),
                status : (status),
                ID : (lightID)
                } ,
        success: function (data) {
            console.log("Success! " + data);
            //update button div
            $('#lightbulb_on_'+lightID).toggle();
            $('#lightbulb_off_'+lightID).toggle();
        },
        error: function(data){
            console.log("Error" + data);
        }
    });
}

var party = 0;

function commenceParty(){
    if(this.party === 0){
        this.party = 1;
    }else{
        this.party = 0;
    }
    $.ajax({
        
        type: "POST",
        url: "ajax/party_ajax.php",
        data: { 
                AJAX : (true),
                party : (this.party)
                } ,
        success: function (data) {
            console.log("Success! " + data);
            
        },
        error: function(data){
            console.log("Error" + data);
        }
    });
}