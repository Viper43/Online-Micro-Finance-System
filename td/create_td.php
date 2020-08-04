<?php
session_start();

include "../connection.php";

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
	
	if($row['Balance'] < $min_balance)
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("Minimum Balance not maintained.");'; 
		echo 'window.location.href = "td.php";';
		echo '</script>';
		
	}
	elseif($row['Balance'] < $td_amount)
	{
		echo '<script type="text/javascript">'; 
		echo 'alert("Insufficient balance");'; 
		echo 'window.location.href = "td.php";';
		echo '</script>';
	}
	else
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
