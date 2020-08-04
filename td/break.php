<?php 
session_start();

include "../connection.php";

function dateDiff ($d1, $d2) {
	// Return the number of days between the two dates:    
		return round(abs(strtotime($d1) - strtotime($d2))/86400);
}

$id = $_GET['id'];
$date = date('Y-m-d');

$status = "Successful";
$type = "Term Deposit Amount";



try
{
	//Fetch selected TD details
	$query = $db->query("SELECT * FROM td where Account_No= '".$_SESSION["account"]."' AND TD_ID='". $id ."'");
    $row = $query->fetch();

    $tenure = $row['Tenure'];
	$amount = $row['Amount'];
	
	//get TD interest rate
	$querySql = $db->query("SELECT * FROM interests WHERE Type = 'Term Deposit' AND Tenure= '". $tenure ."'");
    $row1 = $querySql->fetch();
	$rate = $row1['Rate'];
	
	//Calculate return amount
	$difference = (round(dateDiff($date,$row["Creation_Date"])/30)/12);      //No. of years passed b/w now and creation date
	
	$td_amount = $amount*pow((1+($rate/100)), $difference);
	//Delete entry from TD table
	$queryStr = "DELETE FROM `td` WHERE `TD_ID`='". $id ."'";
	$query = $db->prepare($queryStr);
	$query->execute();

	//Get old balance
	$queryStr1 = $db->query("SELECT Balance FROM accounts WHERE Account_No= '".$_SESSION["account"]."'");
	$row2 = $queryStr1->fetch();
	
	//update balance
	$sql = $db->query("UPDATE accounts SET Balance = ".$row2['Balance']." + ".$td_amount." WHERE Account_No= '".$_SESSION["account"]."'");
	$sql->execute();

	//Create transaction
	$queryStr = "INSERT INTO transactions(Account_No,Amount,Date,Status,Type) VALUES(?,?,?,?,?)";
	$query = $db->prepare($queryStr);
	$query->execute([$_SESSION["account"],$td_amount,$date,$status,$type]);

	//Notify user
	echo '<script type="text/javascript">'; 
	echo 'alert("Selected term deposit has been closed.");'; 
	echo 'window.location.href = "td.php";';
	echo '</script>';
}
catch(PDOException $e)
{
	echo $e->getMessage();
}
?>