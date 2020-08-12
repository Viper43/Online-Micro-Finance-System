<?php
    session_start();
    session_destroy();
    echo "<script type='text/javascript' >
          document.location='index.php'
          </script>";
?>