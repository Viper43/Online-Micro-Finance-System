<?php
    $transaction_Id = $_POST["transaction_id"];

    require "../connection.php";
    
    try {
                            
        $sql = "DELETE FROM transactions WHERE Transaction_Id = '{$transaction_Id}' AND Status = 'Pending' ";
        $query = $db->query($sql);
                            
        echo "<script type='text/javascript' >
            alert('Transaction has been cancelled...............')
            document.location='Create_transaction.php'               
        </script>";
                        
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
?>