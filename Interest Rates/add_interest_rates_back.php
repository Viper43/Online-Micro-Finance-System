<?php
    $type = $_POST["interestType"];
    $rate = $_POST["interestRate"];
    $tenure = $_POST["interestTenure"];
    $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    try {
        $sql = "INSERT INTO interests(Type, Rate, Tenure)VALUES(?,?,?)";
	    $query = $db->prepare($sql);
        $query->execute([$type, $rate, $tenure]);
            
        echo "<script type='text/javascript' >
                
                document.location='../Interest_rates.php'
                
            </script>";

    }
    catch(PDOException $e) {

		echo $e->getMessage();
	}
?>