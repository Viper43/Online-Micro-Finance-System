function register() {
    var l = document.getElementById("login");
    var r = document.getElementById("register");
    var b = document.getElementById("btn");
    l.style.left = "-400px";
    r.style.left = "50px";
    b.style.left = "110px";
}

function login() {
    var l = document.getElementById("login");
    var r = document.getElementById("register");
    var b = document.getElementById("btn");
    l.style.left = "50px";
    r.style.left = "450px";
    b.style.left = "0";
}
function create_account() {
    var l = document.getElementById("login");
    var r = document.getElementById("register");
    var b = document.getElementById("btn");
    var cr = document.getElementById("create_account");
    var n = document.getElementById("naam");
    var m = document.getElementById("mail");
    var p = document.getElementById("pass");
    
    if( p.value != "" && n.value != "" && m.value != "") {
        r.style.left = "450px";
        cr.style.left = "50px";
        
    }
    else {
        
        l.style.left = "-400px";
        r.style.left = "50px";
        b.style.left = "110px";
    }
}