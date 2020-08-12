<html>
    <head>
        <title> Home Page </title>
        <link rel = "icon" href = "../images/logo.png" type = "image/x-icon">
        <link rel="stylesheet" href="style_main.css">
        <script src="demo_main.js"></script>
    </head>
    <body>
        <div class="menu_bar">

            <!---------------- logo ---------------------->
            
            <div class = "logo">
                <img class = "icon" src="../images/icon.jpg">
                <label class="logo-label"> REPO FINANCES </label>
            </div>

            <ul>
                <li class="active"><a href="#">Home</a></li>
               <li><a href="#">Transaction</a>
                    <div class="sub_menu">
                        <ul>
                            <li><a href="../Create Transaction/Create_transaction.php">Create</a></li>
                            <li><a href="../My Transaction/My_transactions.php">View</a></li>
                        </ul>
                    </div>
               </li>
               <li><a href="../td/td.php">Term Deposit</a></li>
               <li><a href="../loan/loan.php">Loan</a></li>
               <li><a href="../logout_back.php">Logout</a></li>
               <li><a href="#">About Us</a></li>
             </ul>
        </div>


        <div class="outer_form">
            <div class="info_form">
                <h1 style="color:white; font-family: cambria; font-size: 45; font-weight: normal;">Welcome User!</h1><br>
                <p style="color:white; font-family: cambria; font-size: 20; font-weight: normal;">Welcome to your section. You can both view and update your information.</p><br>
            </div>
            <div class="edit_page">
                <form action="main_back.php" method="POST" class="input">
                    <?php
                         require("maindetails_back.php");
                    ?>
                    <img class = "avatar" src="../images/avatar.jpg"/>
                    <br>
                    <div class="name">
                        <label  class="label-field">Account No.</label>
                        <input type="text" id="account" class="input-field"  value="<?php echo $accountno?>" disabled>
                    </div>
                    
                    <div class="name">
                        <label  class="label-field">Balance</label>
                        <input type="text" id="bal" class="input-field" value="<?php echo $balance?>" disabled>
                    </div>
                    
                    <div class="name">
                        <label  class="label-field">Name</label>
                        <input type="text" id="u_name" class="input-field" value="<?php echo $name?>" disabled>
                    </div>
                    
                    <div class="name">
                        <label  class="label-field">Address</label>
                        <input type="text" id="address" name="address" class="input-field" value="<?php echo $address?>" disabled>
                    </div>
                    
                    <div class="name">
                        <label  class="label-field">Phone no.</label>
                        <input type="number" id="phone" name="phone" class="input-field" value="<?php echo $phone?>" disabled>
                    </div>
                    
                    <div class="name">
                        <label  class="label-field">Email</label>
                        <input type="text" id="mail" name="email" class="input-field" readonly value="<?php echo $emailId ?>">
                    </div>
                    
                    <div class="name">
                        <label  class="label-field">DOB</label>
                        <input type="date" id="dob"  class="input-field" value="<?php echo $dob?>" disabled>
                    </div>
                    
                    <div class="name">
                        <label  class="label-field">Govt. ID</label>
                        <input type="text" id="gid" name="gid" class="input-field" readonly value="<?php echo $gid?>" >
                    </div>
                    
                    <div class="name">
                        <label  class="label-field">Password</label>
                        <input type="password" onmousedown="this.type='text'" onmouseup="this.type='password'" onmouseout="this.type='password'" id="password" name="password" class="input-field" value="<?php echo $password?>" disabled>
                    </div>
                        <button type = "button" class="btn" id="edit" onclick="afterEdit()">EDIT</button>
                        <button type="submit" class="btn" id="save">SAVE</button>
                </form>
            </div>
        </div>
    </body>
</html>