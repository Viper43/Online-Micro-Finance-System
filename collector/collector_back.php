<?php

    include "../connection.php";
    echo "hello";
    $trno = $_POST["tno"];
    $accountno = $_POST["accountno"];
    $type = $_POST["type"];
    $amount = $_POST["amount"];

    
        try 
        { 
            $query = $db->query("SELECT * FROM accounts WHERE Account_No='{$accountno}'");
            $row = $query->fetch();
            $balance = $row['Balance'];
            if($type=='Deposit')
                $balance = $balance + $amount;
            if($type=='Withdrawal')
                $balance = $balance - $amount;

            $query = $db->query("UPDATE accounts SET Balance='{$balance}' WHERE Account_No='{$accountno}'");
            $query = $db->query("UPDATE transactions SET Status='Approved' WHERE Transaction_ID='{$trno}'");
            echo "<script type='text/javascript' >
            alert('Transaction Approved Successfully')
            document.location='collector_main.php'
            </script>";
        }
        catch(PDOException $e)
	    {
		    echo $e->getMessage();
        }
?>