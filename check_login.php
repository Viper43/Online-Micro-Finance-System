<?php

    if (strlen($_SESSION['account']) == 0 ) {

        echo "<script type='text/javascript' >
                alert('Please Login')
                document.location='../index.php'
            </script>";
    }

?>