function enableReceiver() {
    var t = document.getElementById("type");
    if ( t.value == 'Money Transfer') {
        document.getElementById("rec").style.display = 'block';
    }
    else {
        document.getElementById("rec").style.display = 'none';
    }
}