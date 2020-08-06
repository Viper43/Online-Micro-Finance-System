<?php
session_start();

require "../common variables/common_var.php";				//Get minimum balance and approval percentage

$loan_amount = $_GET["amount"];
$installments = $_GET["slct1"];
$income= $_GET["ann"];
$date = date('Y-m-d');

$status = "Successful";						//Set variables for the transaction
$type = "Loan Amount";

require "../connection.php";

try
{	
	//Get current balance
	$sql = $db->query("SELECT Balance FROM accounts where Account_No= '".$_SESSION["account"]."'");
	$row = $sql->fetch();

	if($loan_amount < $min_loan_amount)									//Check if loan is requested for amount lower than permissible
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("Loan for amount less than ₹10000 is not allowed.");'; 
		echo 'window.location.href = "td.php";';
		echo '</script>';
		
	}
	elseif($row['Balance'] < $min_balance)								//If minimum balance is not maintained, alert so
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("Minimum Balance not maintained.");'; 
		echo 'window.location.href = "loan.php";';
		echo '</script>';
	}
	elseif($row['Balance'] > ($loan_amount * $approval_percentage)) // Check if current balance is greater than specified percentage of loan amount
	{
		//Add loan to loan table
		$queryStr = "INSERT INTO loan(Account_No,Amount,Installments,Income,Creation_Date) VALUES(?,?,?,?,?)";
		$query = $db->prepare($queryStr);
		$query->execute([$_SESSION["account"],$loan_amount,$installments,$income,$date]);

		//Update balance with loan amount
		$QueryStr1 = $db->query("UPDATE accounts SET Balance = '".$row['Balance']."' + '" .$loan_amount. "' WHERE Account_No= '".$_SESSION["account"]."'");
		$QueryStr1->execute();

		//Create transaction
		$queryStr = "INSERT INTO transactions(Account_No,Amount,Date,Status,Type) VALUES(?,?,?,?,?)";
		$query = $db->prepare($queryStr);
		$query->execute([$_SESSION["account"],$loan_amount,$date,$status,$type]);

		//Notify user
		echo '<script type="text/javascript">'; 
		echo 'alert("Loan granted.");'; 
		echo 'window.location.href = "loan.php";';
		echo '</script>';
	}
	else														//Loan not granted
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("Loan denied.");'; 
		echo 'window.location.href = "loan.php";';
		echo '</script>';
	}
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>