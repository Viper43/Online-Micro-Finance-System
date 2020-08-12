<?php
session_start();

require "../connection.php";

require "../common variables/common_var.php";				//Get minimum balance

$td_amount = $_GET["amount"];
$tenure = $_GET["slct1"];
$date = date('Y-m-d');

$status = "Successful";						//Set variables for the transaction
$type = "Term Deposit Amount";

try
{
	$sql = $db->query("SELECT Balance FROM accounts where Account_No= '".$_SESSION["account"]."'");
	$row = $sql->fetch();
	
	if($td_amount < $min_td_amount)									//Check if TD is requested for amount lower than permissible
	{
		echo "<script type='text/javascript'> 
			var td_amt = '$min_td_amount'
			alert('Term Deposit lower than ' + td_amt + ' is not allowed.') 
			window.location.href = 'td.php'
		</script>";
		
	}
	elseif($row['Balance'] < $min_balance)								//If minimum balance is not maintained, alert so
	{
		echo "<script type='text/javascript'>
			var amt = '$min_balance'
			alert('Minimum Balance not maintained. Minimum balance required is' + amt ) 
			window.location.href = 'td.php'
		</script>";
		
	}
	elseif($row['Balance'] < $td_amount)								// Check if current balance is insufficient for opening the TD
	{
		echo "<script type='text/javascript'>
			var amt = '$min_balance'
			alert('Insufficient balance. Minimum balance required is' + amt )
			window.location.href = 'td.php'
		</script>";
	}
	else															//Open TD
	{
		//Add new term deposit to TD table
		$queryStr = "INSERT INTO td(Account_No,Amount,Tenure,Creation_Date) VALUES(?,?,?,?)";
		$query = $db->prepare($queryStr);
		$query->execute([$_SESSION["account"],$td_amount,$tenure,$date]);

		//Deduct term deposit amount from balance
		$queryStr = $db->query("UPDATE accounts SET Balance = ".$row['Balance']." - ".$td_amount." WHERE Account_No= '".$_SESSION["account"]."'");
		$queryStr->execute();

		//Create transaction
		$queryStr = "INSERT INTO transactions(Account_No,Amount,Date,Status,Type) VALUES(?,?,?,?,?)";
		$query = $db->prepare($queryStr);
		$query->execute([$_SESSION["account"],$td_amount,$date,$status,$type]);
		
		header('location:td.php');
	} 	
}
catch(PDOException $e)
{
	echo $e->getMessage();
}