<?php
    require "connection.php";
    

    $querySql = $db->query("SELECT * FROM interests WHERE Type = 'Loan' ");
    $row = $querySql->fetch();
    $r = $row['Rate'];
    
    $query = $db->query("SELECT * FROM loan");

    foreach( $query as $rows ) {
        
        $n = $rows['Installments'];
        $principal = $rows['Amount'];
        $rate = ($r/12) / 100 ;
        
        $emi = round(( $principal * $rate * pow(( 1 + $rate), $n) / ( pow(( 1 + $rate), $n ) - 1 ) ));
        echo $emi."<br>";
    }
    
?>