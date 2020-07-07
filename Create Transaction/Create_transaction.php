<?php
    $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                      
        $sql = "SELECT * FROM transactions WHERE Account_No = '12345678' AND Status = 'Pending'";
        $query = $db->query($sql);

        $row_Count = $query->rowCount();
        
        if ( $row_Count > 0 ) {
            $rows = $query->fetch();

            $transaction_Id = $rows['Transaction_Id'];
            $type = $rows['Type'];
            $date = $rows['Date'];
            $amount = $rows['Amount'];
            $status = $rows['Status'];

            $flag = false;
        }
        else   
            $flag = true;
                        
?>
<html>
    <head>
        <title> Create Transactions  </title>
        <link rel = "stylesheet" href = "styles\Create_transaction_style.css"/>
        
    </head>
    <body onload = allowCreation(<?php echo $flag ?>) >
        <div class="menu_bar">
            <ul>
                <li class="active"><a href="#">Home</a></li>
               <li><a href="#">Transaction</a>
                    <div class="sub_menu">
                        <ul>
                            <li><a href="#">Create</a></li>
                            <li><a href="#">View</a></li>
                        </ul>
                    </div>
               </li>
               <li><a href="#">Term Deposit</a></li>
               <li><a href="#">Loan</a></li>
               <li><a href="http://localhost/roll13/oms/login.html">Logout</a></li>
               <li><a href="#">About Us</a></li>
             </ul>
        </div>

        <div class = "form-box">
            <div class="image">
                <div class="text-content">
                    <h1 style="font-family: Cambria;font-size: 49;">Create Transactions</h1>
                    <p style="font-family: 'Times New Roman';font-size: 15;">You can create your transactions here and see if you are having any pending transactions or not.
                    If you have any pending transactions you can cancel them any moment to create new transactions</p>
                </div>
            </div>

            <h1 class="A" id="A"> Pending Transaction </h1>

            <form class = "input-group" id = "pending" method = "POST" action = "backends\pending_back.php" enctype="multipart/form-data" >
                 
                <div class="container">
                        
                    <label  class="label-field"> Transaction Id
                        <input type ="number" class = "input-field" name = "transaction_id" readonly value = "<?php echo $transaction_Id ?>" >
                    </label>

                    <br>
                        
                    <label  class="label-field"> TYPE
                        <input type ="text" class = "input-field" name = "type" readonly value = "<?php echo $type ?>" >
                    </label>
                        
                    <br>
                        
                    <label  class="label-field" > DATE
                        <input type="date" class="input-field" name="date" readonly value = "<?php echo $date ?>"  >
                    </label>
                    
                    <br>

                    <label  class="label-field"> AMOUNT
                        <input type ="number" class = "input-field" name = "amount" readonly value = "<?php echo $amount ?>"  >
                    </label>
                        
                    <br>
                        
                    <label  class="label-field" > STATUS
                        <input type="text" class="input-field" name="status" readonly value = "<?php echo $status ?>"  >
                    </label>

                </div>

                <br>
                    
                <button type="submit" class="btn" name = "cancel"> CANCEL </button>
                
            </form>

            
            
            <h1 class="B" id="B"> Create Transaction </h1>

            <form class="input-group" id="create" method = "POST" action = "backends\create_transaction_back.php" enctype="multipart/form-data" >

                <div class="container">
                    
                    <label  class="label-field"> TYPE
                        <select class = "dropdown"  id = "type" onchange="enableReceiver(<?php echo $flag ?>)" name = "type" required>
                            <option class = "option" value="Deposit">Deposit</option>
                            <option class = "option" value="Withdrawal">Withdrawal</option>
                            <option class = "option" value="Money Transfer">Money Transfer</option>
                        </select>
                    </label>

                    <br>
                    
                    <label  class="label-field" id = "rec"> RECEIVER
                        <input type ="number" id = "recacc" class = "input-field" name = "receiver" disabled required>
                    </label>
                    
                    <br>
                    
                    <label  class="label-field" id="tenure-label"> AMOUNT
                        <input type ="number" class = "input-field" name = "amount" required>
                    </label>

                </div>
                <br>
                <button type = "submit" class = "btn" id = "createbtn"> CREATE </button>
            </form>
             
        </div>
    <script src = "scripts\Create_transaction_js.js"></script>
    </body>
</html>