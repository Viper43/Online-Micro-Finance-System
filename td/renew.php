<?php
$date = date('Y-m-d');
$id = $_GET['id'];

$db = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try
{	
	$sql = $db->query("SELECT * FROM td WHERE td_id='". $id ."'");
    $row = $sql->fetch();
	$creation = $row['creation_date'];
	$tenure = $row['tenure'];

	$td_amount = $amount*pow((1+($rate/100)), $tenure);
	
	
	//renew TD with current date and previous amount with interest.
	$queryStr = "UPDATE `td` SET `creation_date`='". $date ."' AND amount = '" . $td_amount . "' WHERE `td_id`='". $id ."'";
	$query = $db->prepare($queryStr);
	$query->execute();
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

header('location:td.php');
?>