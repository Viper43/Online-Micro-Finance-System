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

//Define EMI calcuation function
function emi()
	{
		if(document.getElementById('amount2').value==null || document.getElementById('amount2').value.length==0 || document.getElementById('installment2').value==null) 
			{document.getElementById('emi1').value="Data Required.";}
		else 
			{
				var emi='';
				var princ1= document.getElementById('amount2').value;
				var term1= document.getElementById('installment2').value;
				var intr1=document.getElementById('rate').value / 1200;
				document.getElementById('emi1').value =Math.round(princ1 * intr1 / (1-(Math.pow(1/(1 + intr1), term1)))*100)/100; 
				document.getElementById('total').value= Math.round((document.getElementById('emi1').value * document.getElementById('installment2').value)*100)/100;
				document.getElementById('total_inte').value=Math.round((document.getElementById('total').value*1 - document.getElementById('amount2').value*1)*100)/100;
			}
	}

//Reset field values of overlay
var res = document.getElementById("reset");

res.onclick = function() {
  document.getElementById("amount2").value = "";
  document.getElementById("installment2").selectedIndex = -1;
  document.getElementById("emi1").value = "";
  document.getElementById("total_inte").value = "";
  document.getElementById("total").value = "";
}

