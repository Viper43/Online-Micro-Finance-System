<?php
    session_start();
    $a= $_POST["username"];
	$b= $_POST["password"];

    require "../connection.php";
    
        try 
        {
            $query = $db->query("SELECT * FROM admin WHERE Admin_ID = '{$a}' AND Password = '{$b}'");
            $row = $query->fetch();
            $type = $row['Type'];
            $row_count = $query->rowCount();
            if($row_count==0)
            {
                echo "<script type='text/javascript' >
                document.location='../index.html'
                alert('Wrong id or password')
                </script>";
            }
            else
            {
                if($type == 'Collector')
                {
                    echo "<script type='text/javascript' >
                    document.location='../collector/collector.php'
                    </script>";
                }
                if($type == 'Management')
                {
                    echo "<script type='text/javascript' >
                    document.location='../Admin/Admin_main.php'
                    </script>";
                    
                }
            }
        }
        catch(PDOException $e)
	    {
		    echo $e->getMessage();
	    }
    
    $_SESSION['account'] = $a;
?>