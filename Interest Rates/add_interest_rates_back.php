<?php

    require "../common variables/common_var.php";

    $type = $_POST["interestType"];
    $rate = $_POST["interestRate"];
    $tenure = $_POST["interestTenure"];

    require "../connection.php";

    try {
        if ( $type == 'Term Deposit' && $tenure > $max_td_tenure ) {

            echo "<script type='text/javascript' >
                var val = '$max_td_tenure'
                alert('Limit crossed. Limit is ' + val )
                document.location='Interest_rates.php'
            </script>";
        }

        elseif ( $type == 'Loan' && $tenure > $max_loan_tenure ) {

            echo "<script type='text/javascript' >
                var val = '$max_loan_tenure'
                alert('Limit crossed. Limit is ' + val )
                document.location='Interest_rates.php'
            </script>";

        }
        elseif ( $type == 'Savings' && $tenure > 1 ) {

            echo "<script type='text/javascript' >
                alert('Limit crossed. Limit is 1 ')
                document.location='Interest_rates.php'                
            </script>";
        }
        else {

            $sql = "INSERT INTO interests(Type, Rate, Tenure)VALUES(?,?,?)";
	        $query = $db->prepare($sql);
            $query->execute([$type, $rate, $tenure]);
            
            echo "<script type='text/javascript' >
                document.location='Interest_rates.php'
            </script>";
        }

    }
    catch(PDOException $e) {

		echo $e->getMessage();
	}
?>