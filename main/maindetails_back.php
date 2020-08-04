<?php
        session_start();
        $a=$_SESSION['account'];

        include "../connection.php";
        
        try 
        {
            $query = "SELECT * FROM users, accounts WHERE users.Email=accounts.Email AND accounts.Account_No = '{$a}'";
            foreach ($db->query($query) as $row) 
            {
                $accountno=$row['Account_No'];
                $balance=$row['Balance'];
                $name=$row['Name'];
                $address=$row['Address'];
                $phone=$row['Phone_No'];
                $emailId=$row['Email'];
                $dob=$row['DOB'];
                $gid=$row['Govt_ID'];
                $password=$row['Password'];
            }
        }
        catch(PDOException $e)
	    {
		    echo $e->getMessage();
        }
?>