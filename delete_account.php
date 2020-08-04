<?php

    $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $currentDate = date('Y-m-d');

    $query = $db->query("SELECT * FROM accounts");
    foreach( $query as $rows ) {

        $balance = $rows['Balance'];
        $accountNo = $rows['Account_No'];
        $creation_date = $rows['Creation_Date'];
        $emailID = $rows['Email'];
        
        $diff = date_diff(date_create($currentDate), date_create($creation_date))->format("%a");

        if( $diff == 5 && $balance == 0 ) {

            $query = $db->query("DELETE FROM accounts WHERE Account_No = '{$accountNo}' ");
            $query = $db->query("DELETE FROM users WHERE Email = '{$emailID}' ");
        }

    }

?>