<?php
session_start();
$loan_amount = $_GET["amount"];
$installments = $_GET["slct1"];
$income= $_GET["ann"];
$date = date('Y-m-d');

$db = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
{
	$queryStr = "INSERT INTO loan(account_no,amount,installments,income,creation_date) VALUES(?,?,?,?,?)";
	//$queryStr = "INSERT INTO loan(amount,installments,income,creation_date) VALUES(?,?,?,?)";
	$query = $db->prepare($queryStr);
	$query->execute([$_SESSION["account_no"],$loan_amount,$installments,$income,$date]);
	//$query->execute([$loan_amount,$installments,$income,$date]);

	$sql = $db->query("UPDATE account SET balance = balance + '" .$loan_amount. "' WHERE account_no= '".$_SESSION["account"]."'");
	$sql->execute();

}
catch(PDOException $e)
{
	echo $e->getMessage();
}

header('location:loan.php');
?>