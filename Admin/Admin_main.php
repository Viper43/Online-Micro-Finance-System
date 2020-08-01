<?php
    //starting the session
    session_start();
?>
<html>
    <head>
        <title> Admin Main  </title>
        <link rel = "stylesheet" href = "styles/Admin_main_style.css"/>
    </head>
    <body>
        <div class="menu_bar">
            <ul>
                <li class="active"><a href="#"> Home </a></li>
                <li><a href="../Interest Rates/Interest_rates.php"> Interest Rates </a></li>
                <li><a href="../logout_back.php"> Logout </a></li>
                <li><a href="#">About Us</a></li>
            </ul>
        </div>
        
        <div class="form-box">
            
            <!--------------------Display image and text section----------------------->
            <div class="image">
                <div class="text-content">
                    <h1 style="font-family: sans-serif;font-size: 70;">Welcome Admin</h1>
                    <p style="font-family: 'Times New Roman';font-size: 18;">Here you can view the details of every customers by entering the account number and selecting the details you want to view.
                    The details are displayed in the details section and you are also provided with a reset button to search all over again.</p>
                </div>
            </div>

            <!------------------- Search block------------------------->
            
            <h1 class="A"> Search Account No. </h1>

            <form class = "input-group" method = "POST" >
                <input type = "number" placeholder="Type the Account No. here..." id = "search" name = "accountno" class = "input-field">
                <br>
                <div class="check-container">
                    <label class="checkbox-container">
                        <input type="checkbox" name = "personalDetails" > 
                        <span class="checkmark"></span> 
                        View Personal Details
                    </label>
                    <br>
                    <label class="checkbox-container">
                        <input type="checkbox" name = "accountDetails" >
                        <span class="checkmark"></span>
                        View Account Details
                    </label>
                    <br>
                    <label class="checkbox-container">
                        <input type="checkbox" name = "termDeposits" >
                        <span class="checkmark"></span>
                        View Term Deposits
                    </label>
                    <br>
                    <label class="checkbox-container"> 
                        <input type="checkbox" name = "loans" >
                        <span class="checkmark"></span>
                        View Loans
                    </label>
                </div>
                <br>
                <div class = "buttons">
                    <button type = "button" class = "reset-btn" name = "reset" onclick = " document.location='Admin_main.php' " > RESET </button>
                    <button type = "submit" class = "btn" name = "search">SEARCH</button>
                </div>
            </form>
            
            <!---------------------Details----------------------->
            
            <h1 class="B"> Details </h1>
            
            <!-------------------Displaying the details--------------------->

            <?php

                if ( isset($_POST["search"]) ) {
                    
                    $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $account_No = $_POST["accountno"];

                    if ( $account_No != "" ) {
                        
                        //personal details
                        if ( isset($_POST["personalDetails"]) ) {
                            
                            ?>

                            <h1 style = "font-family: sans-serif;font-size: 30;"> User Details </h1>

                            <div class="table-wrapper" >
                                <table class="fl-table">
                                    <thead>
                                        <tr>
                                            <th> NAME </th>
                                            <th> EMAIL ID </th>
                                            <th> PHONE NO. </th>
                                            <th> ADDRESS </th>
                                            <th> D.O.B. </th>
                                            <th> GOVT. ID </th>
                                        </tr>
                                    </thead>
                        
                                    <tbody>
                                    
                                        <?php
                            
                                            $sql = "SELECT * FROM users, accounts WHERE users.Email = accounts.Email AND accounts.Account_No = '{$account_No}' ";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['Name']; ?> </td>
                                                    <td> <?php echo $rows['Email']; ?> </td>
                                                    <td> <?php echo $rows['Phone_No']; ?> </td>
                                                    <td> <?php echo $rows['Address']; ?> </td>
                                                    <td> <?php echo $rows['DOB']; ?> </td>
                                                    <td> <?php echo $rows['Govt_ID']; ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        
                                        ?>
                                        
                                    <tbody>
                                </table>
                            </div>
                        
                        <?php
                        }

                        //display account
                        if ( isset($_POST["accountDetails"]) ) {

                            ?>

                            <h1 style = "font-family: sans-serif;font-size: 30;"> Account Details </h1>

                            <div class="table-wrapper" >
                                <table class="fl-table">
                                    <thead>
                                        <tr>
                                            <th> NAME </th>
                                            <th> ACCOUNT NO. </th>					
                                            <th> BALANCE </th>
                                            <th> CREATED ON </th>
                                        </tr>
                                    </thead>
                        
                                    <tbody>
                                    
                                        <?php
                            
                                            $sql = "SELECT * FROM users, accounts WHERE users.Email = accounts.Email AND accounts.Account_No = '{$account_No}' ";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['Name']; ?> </td>
                                                    <td> <?php echo $rows['Account_No']; ?> </td>
                                                    <td> <?php echo $rows['Balance']; ?> </td>
                                                    <td> <?php echo $rows['Creation_Date']; ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        
                                        ?>
                                        
                                    <tbody>
                                </table>
                            </div>
                        
                        <?php

                        }

                        //display term deposits
                        if ( isset($_POST["termDeposits"]) ) {

                            ?>

                            <h1 style = "font-family: sans-serif;font-size: 30;"> Term Deposit Details </h1>

                            <div class="table-wrapper" >
                                <table class="fl-table">
                                    <thead>
                                        <tr>
                                            <th> ACCOUNT NO. </th>
                                            <th> TERM DEPOSIT ID </th>
                                            <th> TENURE </th>
                                            <th> AMOUNT </th>
                                            <th> CREATED ON </th>
                                        </tr>
                                    </thead>
                        
                                    <tbody>
                                    
                                        <?php
                            
                                            $sql = "SELECT * FROM td, accounts WHERE td.Account_No = accounts.Account_No AND accounts.Account_No = '{$account_No}' ";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['Account_No']; ?> </td>
                                                    <td> <?php echo $rows['TD_ID']; ?> </td>
                                                    <td> <?php echo $rows['Tenure']; ?> </td>
                                                    <td> <?php echo $rows['Amount']; ?> </td>
                                                    <td> <?php echo $rows['Creation_Date']; ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        
                                        ?>
                                        
                                    <tbody>
                                </table>
                            </div>
                        
                        <?php

                        }

                        //display loan
                        if ( isset($_POST["loans"]) ) {

                            ?>

                            <h1 style = "font-family: sans-serif;font-size: 30;"> Loan Details </h1>

                            <div class="table-wrapper" >
                                <table class="fl-table">
                                    <thead>
                                        <tr>
                                            <th> ACCOUNT NO </th>
                                            <th> LOAN ID </th>					
                                            <th> NO. OF INSTALLMENTS </th>
                                            <th> AMOUNT </th>
                                            <th> CREATED ON </th>
                                        </tr>
                                    </thead>
                        
                                    <tbody>
                                    
                                        <?php
                            
                                            $sql = "SELECT * FROM loan, accounts WHERE loan.Account_No = accounts.Account_No AND accounts.Account_No = '{$account_No}' ";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['Account_No']; ?> </td>
                                                    <td> <?php echo $rows['Loan_Id']; ?> </td>
                                                    <td> <?php echo $rows['Installments']; ?> </td>
                                                    <td> <?php echo $rows['Amount']; ?> </td>
                                                    <td> <?php echo $rows['Creation_Date']; ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        
                                        ?>
                                        
                                    <tbody>
                                </table>
                            </div>
                        
                        <?php

                        }

                    }

                    //display all section
                    else {

                        //display all users
                        if ( isset($_POST["personalDetails"]) ) {
                            
                            ?>

                            <h1 style = "font-family: sans-serif;font-size: 30;"> User Details </h1>

                            <div class="table-wrapper" >
                                <table class="fl-table">
                                    <thead>
                                        <tr>
                                            <th> NAME </th>
                                            <th> EMAIL ID </th>					
                                            <th> PHONE NO. </th>
                                            <th> ADDRESS </th>
                                            <th> D.O.B. </th>
                                            <th> GOVT. ID </th>
                                        </tr>
                                    </thead>
                        
                                    <tbody>
                                    
                                        <?php
                            
                                            $sql = "SELECT * FROM users";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['Name']; ?> </td>
                                                    <td> <?php echo $rows['Email']; ?> </td>
                                                    <td> <?php echo $rows['Phone_No']; ?> </td>
                                                    <td> <?php echo $rows['Address']; ?> </td>
                                                    <td> <?php echo $rows['DOB']; ?> </td>
                                                    <td> <?php echo $rows['Govt_ID']; ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        
                                        ?>
                                        
                                    <tbody>
                                </table>
                            </div>
                        
                        <?php
                        }

                        //display all accounts
                        if ( isset($_POST["accountDetails"]) ) {

                            ?>

                            <h1 style = "font-family: sans-serif;font-size: 30;"> Account Details </h1>

                            <div class="table-wrapper" >
                                <table class="fl-table">
                                    <thead>
                                        <tr>
                                            <th> ACCOUNT NO. </th>
                                            <th> EMAIL ID </th>				
                                            <th> BALANCE </th>
                                            <th> CREATED ON </th>
                                        </tr>
                                    </thead>
                        
                                    <tbody>
                                    
                                        <?php
                            
                                            $sql = "SELECT * FROM accounts ";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['Account_No']; ?> </td>
                                                    <td> <?php echo $rows['Email']; ?> </td>
                                                    <td> <?php echo $rows['Balance']; ?> </td>
                                                    <td> <?php echo $rows['Creation_Date']; ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        
                                        ?>
                                        
                                    <tbody>
                                </table>
                            </div>
                        
                        <?php

                        }

                        //display all term deposits
                        if ( isset($_POST["termDeposits"]) ) {

                            ?>

                            <h1 style = "font-family: sans-serif;font-size: 30;"> Term Deposit Details </h1>

                            <div class="table-wrapper" >
                                <table class="fl-table">
                                    <thead>
                                        <tr>
                                            <th> TERM DEPOSIT ID </th>
                                            <th> ACCOUNT NO. </th>
                                            <th> TENURE </th>
                                            <th> AMOUNT </th>
                                            <th> CREATED ON </th>
                                        </tr>
                                    </thead>
                        
                                    <tbody>
                                    
                                        <?php
                            
                                            $sql = "SELECT * FROM td ";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['TD_ID']; ?> </td>
                                                    <td> <?php echo $rows['Account_No']; ?> </td>
                                                    <td> <?php echo $rows['Tenure']; ?> </td>
                                                    <td> <?php echo $rows['Amount']; ?> </td>
                                                    <td> <?php echo $rows['Creation_Date']; ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        
                                        ?>
                                        
                                    <tbody>
                                </table>
                            </div>
                        
                        <?php

                        }

                        //display all loans
                        if ( isset($_POST["loans"]) ) {

                            ?>

                            <h1 style = "font-family: sans-serif;font-size: 30;"> Loan Details </h1>

                            <div class="table-wrapper" >
                                <table class="fl-table">
                                    <thead>
                                        <tr>
                                            <th> LOAN ID </th>
                                            <th> ACCOUNT NO. </th>
                                            <th> NO. OF INSTALLMENTS </th>
                                            <th> AMOUNT </th>
                                            <th> CREATED ON </th>
                                        </tr>
                                    </thead>
                        
                                    <tbody>
                                    
                                        <?php
                            
                                            $sql = "SELECT * FROM loan ";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['Loan_Id']; ?> </td>
                                                    <td> <?php echo $rows['Account_No']; ?> </td>
                                                    <td> <?php echo $rows['Installments']; ?> </td>
                                                    <td> <?php echo $rows['Amount']; ?> </td>
                                                    <td> <?php echo $rows['Creation_Date']; ?> </td>
                                                </tr>
                                                <?php
                                            }
                                        
                                        ?>
                                        
                                    <tbody>
                                </table>
                            </div>
                        
                        <?php

                        }
                        
                    }
                }

            ?>

        </div>     
    </body>
</html>