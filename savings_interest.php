<?php

	require "connection.php";

	require "common variables/common_var.php";

	$currentDate = date('Y-m-d');
	$day = date('d');

	if( $day == $savings_interest_date ) {

		$querySql = $db->query("SELECT * FROM interests WHERE Type = 'Savings' ");
		$row = $querySql->fetch();
		$rate = $row['Rate'];

		$query = $db->query("SELECT * FROM accounts");
		foreach( $query as $rows ) {

			$accountNo = $rows['Account_No'];
			$balance = $rows['Balance'];
			$creation_date = $rows['Creation_Date'];
			
			$diff = date_diff(date_create($currentDate), date_create($creation_date))->format("%a");
			
			if( $diff >= 28 ) {

				$interestAmount = round(( $balance * $rate * 1 ) / ( 100 * 12 ), 2 );
				$finalAmount = $interestAmount + $balance;

			}
			else {

				$interestAmount = round( ( $balance * $rate * $diff ) / ( 100 * 365 ), 2 );
				$finalAmount = $interestAmount + $balance;

			}

			$query = $db->query("UPDATE accounts SET balance='{$finalAmount}' WHERE Account_No ='{$accountNo}' ");
			$type = "Savings Interest";
			$status = "Approved";
			$query = $db->prepare("INSERT INTO transactions(Type, Account_No, Date, Amount, Status)VALUES(?,?,?,?,?)");
			$query->execute([$type, $accountNo, $currentDate, $interestAmount, $status]);


		}
	}

?>