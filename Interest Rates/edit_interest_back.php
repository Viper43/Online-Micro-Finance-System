<?php
    $id= $_POST["interestId"];
    $type = $_POST["interestType"];
    $rate = $_POST["interestRate"];
    $tenure = $_POST["interestTenure"];

    include "../connection.php";
    
        try 
        {
            $query = $db->query("UPDATE interests SET Tenure='{$tenure}' , Rate='{$rate}' , Type='{$type}' WHERE Id='{$id}' ");
            echo "<script type='text/javascript'>
                document.location='Interest_rates.php'
            </script>";
        }
        catch(PDOException $e)
	    {
		    echo $e->getMessage();
        }
?>