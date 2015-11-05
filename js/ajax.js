
function welcomeMsg(){
    $.ajax({
        type: "POST",
        url: "ajax/welcome_ajax.php",
        data: { 
                AJAX : (true)
                } ,
        success: function () {
            console.log("Success! Welcome Executed");
        },
        error: function(data){
            console.log("Error" + data);
        }
    });
}

function toggleLight(element){
    var status = element.dataset.status;
    var lightID = element.dataset.id;
    console.log(status);
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
            if(status === "on"){
                element.dataset.status = "off";
            }else{
                element.dataset.status = "on";
            }
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

function toggleLock(element){
    var lockId = element.dataset.id;
    var ajax_handler = element.dataset.handler;
    $.ajax({
        type: "POST",
        url: "ajax/" + ajax_handler,
        data: {
            AJAX : (true),
            ID : (lockId)
        },
        success: function(data){
            console.log("Success! " + data);
            //update button div
            $('#locked_'+lockId).toggle();
            $('#unlocked_'+lockId).toggle();
        },
        error: function(data){
            console.log("Error: " + data);
        }
    });
    
}
