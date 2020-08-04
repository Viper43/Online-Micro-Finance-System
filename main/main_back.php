<?php
    $email = $_POST['email'];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $govtId = $_POST["gid"];
    $pass = $_POST["password"];

    include "../connection.php";
    
        try 
        { 
            $query = $db->query("UPDATE users SET Address='{$address}' , Phone_No='{$phone}' , Govt_ID='{$govtId}' , Password='{$pass}' WHERE Email='{$email}'");
            echo "<script type='text/javascript' >
            alert('Updated Successfully')
            document.location='main.php'
            </script>";
        }
        catch(PDOException $e)
	    {
		    echo $e->getMessage();
        }
?>