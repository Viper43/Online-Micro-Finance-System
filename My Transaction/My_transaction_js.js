function moneytransfer() {
    
    document.getElementById("transaction").style.display = 'none';
    document.getElementById("A").style.display = 'none';
    document.getElementById("transferbtn").style.display = 'none';

    document.getElementById("money-transfer").style.display = 'block';
    document.getElementById("B").style.display = 'block';
    document.getElementById("transactionbtn").style.display = 'block';

}

function transactionhistory() {
    
    document.getElementById("money-transfer").style.display = 'none';
    document.getElementById("B").style.display = 'none';
    document.getElementById("transactionbtn").style.display = 'none';

    document.getElementById("transaction").style.display = 'block';
    document.getElementById("A").style.display = 'block';
    document.getElementById("transferbtn").style.display = 'block';
}