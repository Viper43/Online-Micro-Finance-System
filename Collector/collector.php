<html>
  <head>
    <title> Collector </title>
    <link href="style_collector.css" rel="stylesheet"> 
  </head>

  <body>
    
    <div class="menu_bar">
        <ul>
            <li><a href="../logout_back.php" class = "link">Logout</a></li>
        </ul>
    </div>
    <div class="form-box">
        
        <h1 class="A">Search Transaction</h1>
        <form class = "input-group"   method="POST">
            <input type = "number" name="trno" placeholder="Type the Transaction Id here..." id = "search" class = "input-field">
            <button type = "submit" name="collectorsearch" class = "btn">SEARCH</button>
        </form>
        
    <?php
        if ( isset($_POST["collectorsearch"]) ) 
        {
            $tno = $_POST["trno"];
        
            $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            try 
            {
                $query = $db->query("SELECT * FROM transactions WHERE Transaction_ID='{$tno}' AND status='Pending'");
                $row_count = $query->rowCount();
                if($row_count==0)
                {
                    $tno=" ";
                    $accountno=" ";
                    $date=" ";
                    $type=" ";
                    $amount=" ";
                    $status=" ";
                }
                else
                {
                    foreach ($query as $row) 
                    {
                        $tno=$row['Transaction_ID'];
                        $accountno=$row['Account_No'];
                        $date=$row['Date'];
                        $type=$row['Type'];
                        $amount=$row['Amount'];
                        $status=$row['Status'];
                    }
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }
        else 
        {
            $type=" ";
            $status=" ";
        }
    ?>
        <h1 class="B">Transaction To Approve</h1>
        
        <form class="output-group" action="collector_back.php" method="POST" >     
            

            <div class="container">
                <label  class="label-field">Transaction Id
                    <input type="number"   class="output-field" name="tno"  readonly value="<?php echo $tno?>" >
                </label>
                <br>
                <label  class="label-field">Account No.
                    <input type="number"  class="output-field" name="accountno" readonly value="<?php echo $accountno?>" >
                </label>
                <br>
                <label  class="label-field">Date
                    <input type="date"  class="output-field" readonly value="<?php echo $date?>" >
                </label>
                <br>
                <label  class="label-field">Type
                    <input type="text" class="output-field" name="type" readonly value="<?php echo $type?>" >   
                </label>
                <br>
                <label  class="label-field">Amount
                    <input type="number"  class="output-field" name="amount" readonly value="<?php echo $amount?>" >
                </label>
                <br>
                <label  class="label-field">Status
                    <input type="text" class="output-field"  readonly value="<?php echo $status?>" >
                </label>
            </div>
            <br>
            <button type="submit" name="app" class="btn-approve" >APPROVE</button>
		</form>
    </div> 
   </body>
</html>
