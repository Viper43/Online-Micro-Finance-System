<?php
	$a= $_POST["username"];
	$b= $_POST["email"];
	$c= $_POST["password"];
	$d= $_POST["address"];
	$e= $_POST["phone"];
	$f= $_POST["dob"];
	$g= $_POST["gid"];
	$h= date('Y/m/d H:i:s');

	require "../connection.php";
	
		try
		{
			$sql = $db->query("SELECT * FROM users WHERE Email='{$b}'");
			$row_count = $sql->rowCount();
			if($row_count==0)
			{
				$queryStr = "INSERT INTO users(Name, Address, Phone_No, Email,  Govt_ID, Password, DOB)VALUES(?,?,?,?,?,?,?)";
				$query = $db->prepare($queryStr);
            	$query->execute([$a,$d,$e,$b, $g, $c, $f]);
            	$queryStr = "INSERT INTO accounts(Creation_Date, Email)VALUES(?,?)";
				$query = $db->prepare($queryStr);
				$query->execute([$h,$b]);
				echo "<script type='text/javascript' >
                alert('Registerred successfully! Now login to the system')
                document.location='../index.html'
				</script>";
			}
			else
			{
				echo "<script type='text/javascript' >
                alert('Email id already registerred! Please login')
                document.location='../index.html'
				</script>";
			}
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
?>