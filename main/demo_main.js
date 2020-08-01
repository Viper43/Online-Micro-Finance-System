function afterEdit() {
    document.getElementById("address").disabled=false;
    document.getElementById("phone").disabled=false;
    document.getElementById("password").disabled=false;
    document.getElementById("save").style.display='block';
    document.getElementById("edit").style.display='none';
} 