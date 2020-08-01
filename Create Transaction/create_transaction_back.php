<?php
    session_start();            //session picks account number
    $account_No = $_SESSION['account'];         
    $type = $_POST["type"];
    $amount = $_POST["amount"];
    $date = date('Y/m/d H:i:s');
    $status = "Pending";

    $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {

        if ( empty($_POST["receiver"]) ) {

            //for withdrawal
            if($type == 'Withdrawal') {

                $sql = "SELECT * FROM accounts WHERE Account_No = '{$account_No}' ";
                $query = $db->query($sql);
                $row = $query->fetch();

                $balance = $row['Balance'];

                //check minimum balance
                if ( $balance - $amount > 2000 ) {

                    $sql = "INSERT INTO transactions(Type, Account_No, Date, Amount, Status)VALUES(?,?,?,?,?)";
                    $query = $db->prepare($sql);
                    $query->execute([$type, $account_No, $date, $amount, $status]);

                    echo "<script type='text/javascript' >
                    alert('Transaction created successfully.')
                    document.location='Create_transaction.php'
                    
                    </script>";
                }
                else {
                    echo "<script type='text/javascript' >
                    alert('Insufficient Balance.')
                    document.location='Create_transaction.php'
                    
                    </script>";
                }
            }
            else {          //deposit

                $sql = "INSERT INTO transactions(Type, Account_No, Date, Amount, Status)VALUES(?,?,?,?,?)";
                $query = $db->prepare($sql);
                $query->execute([$type, $account_No, $date, $amount, $status]);

                //redirecting
                echo "<script type='text/javascript' >
                alert('Transaction created successfully.')
                document.location='Create_transaction.php'
                
                </script>";
            }
        }
        else {              //money transfer

            $receiver = $_POST["receiver"];

            $sql = "SELECT * FROM accounts WHERE Account_No = '{$account_No}' ";
            $query = $db->query($sql);
            $row = $query->fetch();

            $balance = $row['Balance'];


            //minimum balance check
            if ( $balance - $amount > 2000 ) {

                //update receiver balance
                $balance = $balance - $amount;

                $sql = "SELECT * FROM accounts WHERE Account_No = '{$receiver}' ";
                $query = $db->query($sql);
                $rows = $query->fetch();

                //update receiver balance
                $balanceRec = $rows['Balance'] + $amount;
                
                //queries for updating
                $query = $db->query("UPDATE accounts SET Balance='{$balance}' WHERE Account_No='{$account_No}'");
                $query = $db->query("UPDATE accounts SET Balance='{$balanceRec}' WHERE Account_No='{$receiver}'");

                //inserting transaction to transfer table
                $sql = "INSERT INTO transfer(Transferred_To, Transferred_From, Amount, Date)VALUES(?,?,?,?)";
                $query = $db->prepare($sql);
                $query->execute([$receiver, $account_No, $amount , $date]);
                
                //redit=rection
                echo "<script type='text/javascript' >
                    alert('Transfer Successful.')
                    document.location='Create_transaction.php'
            
                    </script>";
            }
            else {

                echo "<script type='text/javascript' >
                    alert('Insufficient Balance.')
                    document.location='Create_transaction.php'
            
                    </script>";
            }
        }   
    }
    catch(PDOException $e) {
        
        echo $e->getMessage();
	}  
?>