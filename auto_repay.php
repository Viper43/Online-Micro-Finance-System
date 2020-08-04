<?php
        
        include "connection.php";
        
        $date = date('Y-m-d');
        $status = "Successful";						//Set variables for the transaction
        $type = "Loan Installment";

        $querySql = $db->query("SELECT * FROM interests WHERE Type = 'Loan' LIMIT 1");      //Get interest rate
        $row = $querySql->fetch();
        $r = $row['Rate'];
        
        $query = $db->query("SELECT * FROM loan");

        foreach( $query as $rows ) {
            $account = $rows['Account_No'];
            $n = $rows['Installments'];
            $principal = $rows['Amount'];
            $id = $rows['Loan_Id'];
            $rate = ($r/12) / 100 ;
            
            $emi = round(( $principal * $rate * pow(( 1 + $rate), $n) / ( pow(( 1 + $rate), $n ) - 1 ) ));

            $queryStr = $db->query("SELECT Balance FROM accounts WHERE Account_No= '".$rows["Account_No"]."'");      //Get current balance of account in iteration
            $row2 = $queryStr->fetch();

            //Create transaction
		    $queryStr = "INSERT INTO transactions(Account_No,Amount,Date,Status,Type) VALUES(?,?,?,?,?)";
		    $query = $db->prepare($queryStr);
            $query->execute([$account,$emi,$date,$status,$type]);
            
            //Update balance
            $sql = $db->query("UPDATE accounts SET Balance= ".$row2['Balance']." - '" .$emi. "' WHERE Account_No= '".$rows["Account_No"]."'");
            $sql->execute();
        }  
?>