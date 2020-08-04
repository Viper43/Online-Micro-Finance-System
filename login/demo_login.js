function register(){
    var x= document.getElementById("login");
    var y= document.getElementById("register");
    var z= document.getElementById("btn");
	    x.style.left = "-400px";
	    y.style.left = "50px";
        z.style.left = "110px";
}
function login(){
    var x= document.getElementById("login");
    var y= document.getElementById("register");
    var z= document.getElementById("btn");
    var a=document.getElementById("full_button");
    var b=document.getElementById("choice");
	x.style.left = "50px";
	y.style.left = "450px";
    z.style.left = "0px";
    a.style.left = "5px";
    b.style.left = "-450px";
}
function create_account(){
    var x= document.getElementById("address");
    var y= document.getElementById("phone");
    var z= document.getElementById("dob");
    var a=document.getElementById("govtid");
    var w=document.getElementById("create_btn");
    var b= document.getElementById("u_name");
    var c= document.getElementById("mail");
    var d= document.getElementById("pass");
    var e= document.getElementById("register_btn");
    if(b.value!="" && c.value!="" && d.value!="")
    {
        w.style.display = 'block';
        x.style.display = 'block';
        y.style.display = 'block';
        z.style.display = 'block';
        a.style.display = 'block';
        b.style.display= 'none';
        c.style.display= 'none';
        d.style.display= 'none';
        e.style.display= 'none';
    }
    else
    {
        x.style.left = "-400px";
	    y.style.left = "50px";
        z.style.left = "450px";
        alert("All the fields must be filled");
    }
}
function admin_login()
{
    var a=document.getElementById("admin_login");
    var b=document.getElementById("choice");
    var c=document.getElementById("full_button_admin");
    var z=document.getElementById("btn1");
    var x=document.getElementById("admin_signup");
    b.style.left= "-450px";
    a.style.left= "50px";
    c.style.left= "5px";
    c.style.top= "-60px";
    z.style.left= "5px";
    x.style.left="450px";
}
function admin_signup()
{
    var x= document.getElementById("admin_login");
    var y= document.getElementById("admin_signup");
    var z= document.getElementById("btn1");
	    x.style.left = "-400px";
	    y.style.left = "50px";
        z.style.left = "110px";
}