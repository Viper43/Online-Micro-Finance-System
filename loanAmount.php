<?php
    $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    

    $querySql = $db->query("SELECT * FROM interests WHERE Type = 'Loan' ");
    $row = $querySql->fetch();
    $r = $row['Rate'];
    
    $query = $db->query("SELECT * FROM loans");

    foreach( $query as $rows ) {
        
        $n = $rows['Installments'];
        $principal = $rows['Loan_Amount'];
        $rate = ($r/12) / 100 ;
        
        $emi = round(( $principal * $rate * pow(( 1 + $rate), $n) / ( pow(( 1 + $rate), $n ) - 1 ) ));
        echo $emi."<br>";
    }
    
?>