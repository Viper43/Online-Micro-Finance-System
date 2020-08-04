<?php
    session_start();

        function dateDiff ($d1, $d2) {
        // Return the number of days between the two dates:    
            return round(abs(strtotime($d1) - strtotime($d2))/86400);
        }

        $date = date('Y-m-d');

        $status = "Successful";						//Set variables for the transaction
        $type = "Loan Amount";

        $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    try{
            $querySql = $db->query("SELECT * FROM interests WHERE Type = 'Loan' LIMIT 1");          //Get interest rate
            $row = $querySql->fetch();
            $r = $row['Rate'];
        
            $query = $db->query("SELECT * FROM loan WHERE Account_No= '".$_SESSION["account"]."'"); //Get loan info 
            $row = $query->fetch();

            $n = $row['Installments'];
            $principal = $row['Amount'];
            $id = $row['Loan_Id'];
            $rate = ($r/12) / 100 ;

            $difference = round(dateDiff($date,$row["Creation_Date"])/30);      //No. of months
            $remaining = $row["Installments"] - $difference;                     //Remaining duration of loan

            $emi = round(( $principal * $rate * pow(( 1 + $rate), $n) / ( pow(( 1 + $rate), $n ) - 1 ) ));
            $emi = $emi * $remaining;

            $queryStr1 = $db->query("SELECT Balance FROM accounts WHERE Account_No= '".$_SESSION["account"]."'");	//Get current balance of the account
            $row2 = $queryStr1->fetch();

            if($row2['Balance'] > $emi)
            {
                //Deduct balance
                $sql = $db->query("UPDATE accounts SET Balance= '".$row2['Balance']."' - '" .$emi. "' WHERE Account_No= '".$_SESSION["account"]."'");
                $sql->execute();

                //Delete entry from Loan table
	            $queryStr = "DELETE FROM loan WHERE Loan_Id='". $id ."'";
	            $query = $db->prepare($queryStr);
                $query->execute();

                //Create transaction
		        $queryStr = "INSERT INTO transactions(Account_No,Amount,Date,Status,Type) VALUES(?,?,?,?,?)";
		        $query = $db->prepare($queryStr);
		        $query->execute([$_SESSION["account"],$emi,$date,$status,$type]);
                
                header('location:loan.php');
            }
            else
            {
                echo '<script type="text/javascript">'; 
		        echo 'alert("Insufficient balance.");'; 
		        echo 'window.location.href = "loan.php";';
		        echo '</script>';
            }
            
        }
        catch(PDOException $e)
        {
	        echo $e->getMessage();
        }
?>
