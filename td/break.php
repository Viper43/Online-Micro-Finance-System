<?php 
session_start();

function dateDiff ($d1, $d2) {
	// Return the number of days between the two dates:    
		return round(abs(strtotime($d1) - strtotime($d2))/86400);
}

$id = $_GET['id'];
$date = date('Y-m-d');

$db = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
{
	//get TD interest rate
	$querySql = $db->query("SELECT * FROM interests WHERE Type = 'td'");
    $row = $querySql->fetch();
	$rate = $row['rate'];

	//Fetch selected TD details
	$query = $db->query("SELECT * FROM td where account_no= '".$_SESSION["account"]."' AND td_id='". $id ."'");
    $row = $query->fetch();

    $tenure = $row['tenure'];
    $amount = $row['amount'];
	
	//Calculate return amount
	$difference = round(dateDiff($date,$row["creation_date"])/30);      //No. of months 
    $remaining = $row["tenure"] - ($difference/12);			//No of years remaining
	$td_amount = $amount*pow((1+($rate/100)), $remaining);

	//update balance
	$sql = $db->query("UPDATE account SET balance= balance + '" .$td_amount. "' WHERE account_no= '".$_SESSION["account"]."'");
	$sql->execute();
	
	$queryStr = "DELETE FROM `td` WHERE `td_id`='". $id ."'";
	$query = $db->prepare($queryStr);
	$query->execute();
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

header('location:td.php');

?>