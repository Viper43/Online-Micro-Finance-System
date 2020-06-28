<html>
    <head>
        <title> My Transactions </title>
        <link rel="stylesheet" href="styles\my_transaction_style.css"/>
    </head>
    <body>
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

        <!--.........................Transaction History......................-->
        
        <div class = "form-box">
            <button type = "submit" class = "btn" id="transferbtn" onclick="moneytransfer()">Money Transfers</button>
            <h1 class="A" id="A"> Transaction History </h1>
            
            <div class="table-wrapper" id="transaction">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>TYPE</th>
                            <th>ACCOUNT NO.</th>
                            <th>DATE</th>
                            <th>AMOUNT</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
        
                    <tbody>
                        
                        <?php
                            $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "SELECT * FROM transactions WHERE Account_No = '{$account_no}' ";
                            $query = $db->query($sql);
                            foreach($db->query($sql) as $rows) {
                                
                            ?>
                                
                                <tr>
                                    <td> <?php echo $rows['Transaction_Id']; ?> </td>
                                    <td> <?php echo $rows['Type']; ?> </td>
                                    <td> <?php echo $rows['Account_No']; ?> </td>
                                    <td> <?php echo $rows['Date']; ?> </td>
                                    <td> <?php echo $rows['Amount']; ?> </td>
                                    <td> <?php echo $rows['Status']; ?> </td>
                                </tr>
                                <?php
                            }
                        
                        ?>
                    <tbody>
                </table>
            </div>

            <!--........................Money Transfer......................-->

            <button type = "submit" class = "btn" id = "transactionbtn" onclick="transactionhistory()">Transaction History</button>
            <h1 class="B" id="B"> Money Transfers </h1>
            
            <div class="table-wrapper" id="money-transfer">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th> Transfer ID </th>					
                            <th> Transferred To </th>
                            <th> Transferred From </th>
                            <th> DATE </th>
                            <th> AMOUNT </th>
                        </tr>
                    </thead>
        
                    <tbody>
                    
                        <?php
                            $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "SELECT * FROM transfer WHERE Transferred_To = '{$account_no}' AND Transferred_From = '{$account_no}' ";
                            $query = $db->query($sql);
                            foreach($db->query($sql) as $rows) {

                            ?>
                                
                                <tr>
                                    <td> <?php echo $rows['Transfer_ID']; ?> </td>
                                    <td> <?php echo $rows['Transferred_To']; ?> </td>
                                    <td> <?php echo $rows['Transferred_From']; ?> </td>
                                    <td> <?php echo $rows['Date']; ?> </td>
                                    <td> <?php echo $rows['Amount']; ?> </td>
                                </tr>
                                <?php
                            }
                        
                        ?>
                    <tbody>
                </table>
            </div>

        </div>

        <!--.........................script......................-->
        
        <script src = "scripts\My_transaction_js.js"></script>
    </body>
</html>