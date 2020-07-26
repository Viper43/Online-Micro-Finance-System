<?php
    $transaction_Id = $_POST["transaction_id"];
    $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
                            
        $sql = "DELETE FROM transactions WHERE Transaction_Id = '{$transaction_Id}' ";
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