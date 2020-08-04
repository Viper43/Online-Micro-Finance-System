<?php
    $id = $_GET['id'];
    
    include "../connection.php";
    
    try {
                            
        $sql = "DELETE FROM interests WHERE Id = '{$id}' ";
        $query = $db->query($sql);
                            
        echo "<script type='text/javascript' >
            
            document.location='Interest_rates.php'              
        </script>";
                        
    }
    catch(PDOException $e) {
        echo "<script type='text/javascript' >
            
            alert('Deletion Failed ...............')
            
        </script>";
    }
?>