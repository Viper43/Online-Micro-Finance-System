// Get the modal
var modal = document.getElementById("overlay");

// Get the button that opens the modal
var btn = document.getElementById("info");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
/*
//Get the renew button of every row marked by same id
var btn1 = document.getElementById("renew");
btn1.onclick = function() {
  
}*/