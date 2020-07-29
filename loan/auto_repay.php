<?php
    session_start();

        $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $querySql = $db->query("SELECT * FROM interests WHERE Type = 'Loan'");
        $row = $querySql->fetch();
        $r = $row['Rate'];
        
        $query = $db->query("SELECT * FROM loan WHERE account_no= '".$_SESSION["account"]."'");

        foreach( $query as $rows ) {
            $n = $rows['installments'];
            $principal = $rows['amount'];
            $id = $rows['loan_id'];
            $rate = ($r/12) / 100 ;
            
            $emi = round(( $principal * $rate * pow(( 1 + $rate), $n) / ( pow(( 1 + $rate), $n ) - 1 ) ));

            $sql = $db->query("UPDATE Account SET balance= balance - '" .$emi. "' WHERE account_no= '".$_SESSION["account"]."'");
            $sql->execute();
        }  
?>