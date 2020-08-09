function enableReceiver(flag) {
    var t = document.getElementById("type");

    if ( t.value == 'Money Transfer' && !flag ) {

        document.getElementById("recacc").disabled = false;
        document.getElementById("rec").style.display = 'block';
        document.getElementById("createbtn").style.display = 'block';
        document.getElementById("createbtn").disabled = false;
        
    }
    else if ( t.value != 'Money Transfer' && !flag ) {

        document.getElementById("recacc").disabled = true;
        document.getElementById("rec").style.display = 'none';
        document.getElementById("createbtn").style.display = 'none';
        document.getElementById("createbtn").disabled = true;
    }
    else if ( t.value == 'Money Transfer' && flag ) {

        document.getElementById("recacc").disabled = false;
        document.getElementById("rec").style.display = 'block';
        document.getElementById("createbtn").disabled = false;
        
    }
    else {

        document.getElementById("recacc").disabled = true;
        document.getElementById("rec").style.display = 'none';
    }
}
function allowCreation(flag) {
    if ( flag ) {
        document.getElementById("create").style.display = 'flex';
        document.getElementById("createbtn").style.display = 'block';
        document.getElementById("B").style.display = 'block';

        document.getElementById("A").style.display = 'none';
        document.getElementById("pending").style.display = 'none';
    }
    else {
        document.getElementById("A").style.display = 'block';
        document.getElementById("pending").style.display = 'flex';
        
        document.getElementById("create").style.display = 'flex';
        document.getElementById("B").style.display = 'block';
        document.getElementById("createbtn").disabled = true;
        document.getElementById("createbtn").style.display = 'none';
        

    }
}