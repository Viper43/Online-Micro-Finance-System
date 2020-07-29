<?php
    session_start();
    $account_no = $_SESSION['account'];

?>
<html>
    <head>
        <title> My Transactions </title>
        <link rel="stylesheet" href="my_transaction_style.css"/>
    </head>
    <body>
        <div class="menu_bar">
            <ul>
                <li><a href="../main/main.php">Home</a></li>
               <li class="active"><a href="#">Transaction</a>
                    <div class="sub_menu">
                        <ul>
                            <li><a href="../Create Transaction/Create_transaction.php">Create</a></li>
                            <li><a href="#">View</a></li>
                        </ul>
                    </div>
               </li>
               <li><a href="../td/td.php">Term Deposit</a></li>
               <li><a href="../loan/loan.php">Loan</a></li>
               <li><a href="../logout_back.php">Logout</a></li>
               <li><a href="#">About Us</a></li>
             </ul>
        </div>

        <!--.........................Transaction History......................-->
        
        <div class = "form-box">
            <button type = "submit" class = "btn" id="transferbtn" onclick="moneytransfer()">Money Transfers</button>
            <h1 class="A" id="A"> TRANSACTION HISTORY </h1>
            
            <div class="table-wrapper" id="transaction">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th>TRANSACTION ID</th>
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
            <h1 class="B" id="B"> MONEY TRANSFERS </h1>
            
            <div class="table-wrapper" id="money-transfer">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th> TRANSFER ID </th>					
                            <th> TRANSFERRED TO </th>
                            <th> TRANSFERRED FROM </th>
                            <th> DATE </th>
                            <th> AMOUNT </th>
                        </tr>
                    </thead>
        
                    <tbody>
                    
                        <?php
                            $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "SELECT * FROM transfer WHERE Transferred_To = '{$account_no}' OR Transferred_From = '{$account_no}' ";
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
        
        <script src = "My_transaction_js.js"></script>
    </body>
</html>