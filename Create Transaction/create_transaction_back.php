<?php
    session_start();
    $account_no = $_SESSION['acccount'];
    
    $type = $_POST["type"];
    $amount = $_POST["amount"];
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
                document.location='Create_transaction.php'
                
                </script>";

        }
        else {

            $receiver = $_POST["receiver"];

            $sql = "SELECT * FROM accounts WHERE Account_No = '{$account_no}' ";
            $query = $db->query($sql);
            $row = $query->fetch();

            $balance = $row['Balance'];

            if ( $balance - $amount > 2000 ) {

                $balance = $balance - $amount;

                $sql = "SELECT * FROM accounts WHERE Account_No = '{$receiver}' ";
                $query = $db->query($sql);
                $rows = $query->fetch();

                $balanceRec = $rows['Balance'] + $amount;
                
                $query = $db->query("UPDATE accounts SET Balance='{$balance}' WHERE Account_No='{$account_no}'");
                $query = $db->query("UPDATE accounts SET Balance='{$balanceRec}' WHERE Account_No='{$receiver}'");

                $sql = "INSERT INTO transfer(Transferred_To, Transferred_From, Amount, Date)VALUES(?,?,?,?)";
                $query = $db->prepare($sql);
                $query->execute([$receiver, $account_no, $amount , $date]);
                
                echo "<script type='text/javascript' >
                    alert('Transfer Successful')
                    document.location='Create_transaction.php'
            
                    </script>";
            }
            else {

                echo "<script type='text/javascript' >
                    alert('Insufficient Balance')
                    document.location='Create_transaction.php'
            
                    </script>";

            }
        }
        
    }
    catch(PDOException $e) {
        
        echo $e->getMessage();
	}
    
?>
