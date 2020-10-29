<?php
    session_start();
    $a= $_POST["email"];
    $b= $_POST["password"];
    
    require "../connection.php";
    
    try 
    {
        $query = $db->query("SELECT * FROM users WHERE Email = '{$a}' AND Password = '{$b}'");
        $sql = "SELECT * FROM accounts WHERE Email = '{$a}'";
        foreach ($db->query($sql) as $row)
        {
             $ano=$row['Account_No'];
        }
        $row_count = $query->rowCount();
        if($row_count==0)
        {
            echo "<script type='text/javascript' >
            document.location='../index.php'
            alert('Wrong email or password')
            </script>";     
        }
        else
        {
            header("Location: ../main/main.php");
        }
    }

    catch(PDOException $e)
	{
		echo $e->getMessage();
    }

    $_SESSION['account'] = $ano;
?>