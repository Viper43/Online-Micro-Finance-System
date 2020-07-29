<?php
    session_start();

        function dateDiff ($d1, $d2) {
        // Return the number of days between the two dates:    
            return round(abs(strtotime($d1) - strtotime($d2))/86400);
        }

        $date = date('Y-m-d');

        $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $querySql = $db->query("SELECT * FROM interests WHERE Type = 'Loan' ");
        $row = $querySql->fetch();
        $r = $row['rate'];
        
        $query = $db->query("SELECT * FROM loan where account_no= '".$_SESSION["account"]."'");
        $row = $query->fetch();

            $n = $row['installments'];
            $principal = $row['amount'];
            $id = $row['loan_id'];
            $rate = ($r/12) / 100 ;

            $difference = round(dateDiff($date,$row["creation_date"])/30);      //No. of months 
            $remaining = $row["installments"] - $difference;                     //Remaining duration of loan

            $emi = round(( $principal * $rate * pow(( 1 + $rate), $n) / ( pow(( 1 + $rate), $n ) - 1 ) ));
            $emi = $emi * $remaining;

            $sql = $db->query("UPDATE Account SET balance= balance - '" .$emi. "' WHERE account_no= '".$_SESSION["account"]."'");
            $sql->execute();
?>