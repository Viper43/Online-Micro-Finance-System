<?php
    session_start();
?>
<html>
    <head>
        <title> Admin Main  </title>
        <link rel = "stylesheet" href = "Admin_main_style.css"/>
    </head>
    <body>
        <div class="menu_bar">
            <ul>
                <li class="active"><a href="#"> Home </a></li>
                <li><a href="../Interest Rates/Interest_rates.php"> Interest Rates </a></li>
                <li><a href="http://localhost/roll13/oms/login.html"> Logout </a></li>
                <li><a href="#">About Us</a></li>
            </ul>
        </div>
        
        <div class="form-box">
            <!--Create TD block------------------------->
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
            
            <!----------------------------------------------->
            
            <h1 class="B"> Details </h1>
            
            <!------------------------------------------->

            <?php

                if ( isset($_POST["search"]) ) {
                    
                    $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $account_No = $_POST["accountno"];

                    if ( $account_No != "" ) {
                        
                        if ( isset($_POST["personalDetails"]) ) {
                            
                            ?>

                            <h1 style = "font-family: Cambria;font-size: 30;"> User Details </h1>

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

                        if ( isset($_POST["accountDetails"]) ) {

                            ?>

                            <h1 style = "font-family: Cambria;font-size: 30;"> Account Details </h1>

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

                        if ( isset($_POST["termDeposits"]) ) {

                            ?>

                            <h1 style = "font-family: Cambria;font-size: 30;"> Term Deposit Details </h1>

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
                            
                                            $sql = "SELECT * FROM termdeposits, accounts WHERE termdeposits.Account_No = accounts.Account_No AND accounts.Account_No = '{$account_No}' ";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['Account_No']; ?> </td>
                                                    <td> <?php echo $rows['TD_ID']; ?> </td>
                                                    <td> <?php echo $rows['Tenure']; ?> </td>
                                                    <td> <?php echo $rows['TD_Amount']; ?> </td>
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

                        if ( isset($_POST["loans"]) ) {

                            ?>

                            <h1 style = "font-family: Cambria;font-size: 30;"> Loan Details </h1>

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
                            
                                            $sql = "SELECT * FROM loans, accounts WHERE loans.Account_No = accounts.Account_No AND accounts.Account_No = '{$account_No}' ";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['Account_No']; ?> </td>
                                                    <td> <?php echo $rows['Loan_Id']; ?> </td>
                                                    <td> <?php echo $rows['Installments']; ?> </td>
                                                    <td> <?php echo $rows['Loan_Amount']; ?> </td>
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
                    else {

                        if ( isset($_POST["personalDetails"]) ) {
                            
                            ?>

                            <h1 style = "font-family: Cambria;font-size: 30;"> User Details </h1>

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

                        if ( isset($_POST["accountDetails"]) ) {

                            ?>

                            <h1 style = "font-family: Cambria;font-size: 30;"> Account Details </h1>

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

                        if ( isset($_POST["termDeposits"]) ) {

                            ?>

                            <h1 style = "font-family: Cambria;font-size: 30;"> Term Deposit Details </h1>

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
                            
                                            $sql = "SELECT * FROM termdeposits ";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['TD_ID']; ?> </td>
                                                    <td> <?php echo $rows['Account_No']; ?> </td>
                                                    <td> <?php echo $rows['Tenure']; ?> </td>
                                                    <td> <?php echo $rows['TD_Amount']; ?> </td>
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

                        if ( isset($_POST["loans"]) ) {

                            ?>

                            <h1 style = "font-family: Cambria;font-size: 30;"> Loan Details </h1>

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
                            
                                            $sql = "SELECT * FROM loans ";
                                            $query = $db->query($sql);
                                            foreach($db->query($sql) as $rows) {

                                            ?>
                                                
                                                <tr>
                                                    <td> <?php echo $rows['Loan_Id']; ?> </td>
                                                    <td> <?php echo $rows['Account_No']; ?> </td>
                                                    <td> <?php echo $rows['Installments']; ?> </td>
                                                    <td> <?php echo $rows['Loan_Amount']; ?> </td>
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