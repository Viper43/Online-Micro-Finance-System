<?php
    $type = $_POST["type"];
    
    $amount = $_POST["amount"];
    $account_no = 1234567891;
    $date = date('Y/m/d H:i:s');
    $status = "Pending";

    $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {

        if ( empty($_POST["receiver"]) ) {
            
            $sql = "INSERT INTO transactions(Type, Account_No, Date, Amount, Status)VALUES(?,?,?,?,?)";
	        $query = $db->prepare($sql);
            $query->execute([$type, $account_no, $date, $amount, $status]);
            
            echo "<script type='text/javascript' >
                alert('Transaction created successfully..............')
                document.location='../Create_transaction.php'
                
                </script>";

        }
        else {

            $receiver = $_POST["receiver"];

            $sql = "INSERT INTO transfer(Transferred_To, Transferred_From, Amount, Date)VALUES(?,?,?,?)";
	        $query = $db->prepare($sql);
            $query->execute([$receiver, $account_no, $amount , $date]);
            
            echo "<script type='text/javascript' >
                alert('Transfer Completed Successfully..................')
                document.location='../Create_transaction.php'
                
                </script>";

        }
        
    }
    catch(PDOException $e) {
        
        echo $e->getMessage();
	}
    
?>
