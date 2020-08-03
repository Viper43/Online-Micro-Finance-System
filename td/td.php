<?php session_start();
    $date = date('Y-m-d');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Term Deposit</title>
    
    <link rel = "icon" href = "images/favicon.png" type = "image/x-icon">
    <link href="styles/style.css?v=<?php echo time(); ?>" rel="stylesheet"> 
  </head>

  <body>
    <div class="menu_bar">

         <!---------- Logo ------------------------------->

        <div class="logo">
            <img class="icon" src="../images/icon.jpg"/>
            <label class="logo-label">REPO FINANCES</label>
        </div>

            <ul>
                <li><a href="../main/main.php">Home</a></li>
               <li><a href="#">Transaction</a>
                    <div class="sub_menu">
                        <ul>
                            <li><a href="../Create Transaction/Create_transaction.php">Create</a></li>
                            <li><a href="../My Transaction/My_transactions.php">View</a></li>
                        </ul>
                    </div>
               </li>
               <li class="active"><a href="../td/td.php">Term Deposit</a></li>
               <li><a href="../loan/loan.php">Loan</a></li>
               <li><a href="../logout_back.php">Logout</a></li>
               <li><a href="#">About Us</a></li>
             </ul>
    </div>
    <!---------------------------------------------->

    <!-- Container for rest of body elements-------->
    <div class="super-container">
        <!--Intro Image and desc-------------------->
        <div class="intro">
            <div class="intro-txt">
                <h1 class="img-head">TERM DEPOSIT</h1>
                <p class="information">You can create term deposit by specifying amount and tenure.
                    Currently active term deposits are displayed in the table. Note: Renew is only
                    shown for matured term deposits.
                </p>
            </div>
        </div>
        <!------------------------------------------>
        
        <!--Create TD block------------------------->
        <div class="block1">
            <h1 class="A">Create Term Deposit</h1>
        </div>
        <!------------------------------------------>

        <!--Container for Input field and labels---->
        <div class="flex-container2">
            <div class="amount">
                <label for="amount" class="label-field">Amount</label>
                <input type="number" class="input-field" name="amount" id="amount" placeholder="₹"> 
            </div>
            <div class="tenure">
                <label for="tenure" class="label-field">Tenure</label>
                    <select name="slct1" class="slct1" id="slct1">
                      <option selected disabled>---</option>
                        <?php
	                    $pdo = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');

                        $sql="SELECT Tenure FROM interests WHERE Type='Term Deposit'";
                        $query=$pdo->query($sql);
	                    foreach ($pdo->query($sql) as $row)//Array or records stored in $row
		                {
			                echo "<option value=$row[Tenure]>$row[Tenure] Year(s)</option>"; 
		                }
	                    ?>
                    </select>
            </div>
        </div>
        <!------------------------------------------->

        <!--Container for buttons-------------------->
        <div class="flex-container3">
            <button type="button" name="info" id="info" class="button button1">VIEW INTEREST RATES</button>
            <button type="button" name="create" class="button button2" onclick="location.href='create_td.php?amount='+ document.getElementById('amount').value+'&slct1='+ document.getElementById('slct1').value;">
            CREATE</button>
        </div>
        <!-------------------------------------------> 

        <!--View TD block---------------------------->
        <div class="block2">
            <h1 class="B">Current Term Deposits</h1>
        </div>
        <!------------------------------------------->
        
        <!--Current TD table ------------------------>
        <div class="table-wrapper">
            <table class="fl-table">
                <thead>
                <tr>
                    <th>TD ID</th>
                    <th>AMOUNT</th>
                    <th>TENURE(years)</th>
                    <th>CREATION DATE</th>
                    <th>MANAGE</th>
                </tr>
                </thead>

                <tbody>
                <?php 
					$pdo = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');

					$sql="SELECT * FROM td WHERE Account_No= '".$_SESSION["account"]."'";
					$query=$pdo->query($sql);
					foreach($pdo->query($sql) as $row){
                        $exp = date('Y-m-d', strtotime($row['Creation_Date']. "+ {$row['Tenure']} years")); //Get expiration date
                        $lower = date('Y-m-d', strtotime($row['Creation_Date']. "+6 months"))               //Set TD locking period
						?>
						<tr>
							<td> <?php echo $row['TD_ID']; ?></td>
                            <td> ₹<?php echo $row['Amount']; ?></td>
                            <td> <?php echo $row['Tenure']; ?></td>
                            <td> <?php echo $row['Creation_Date']; ?></td>
                            <?php if($date < $exp and $date > $lower)
                            {?>
                            <td><button class="button3"><a href="break.php?id=<?php echo $row['TD_ID'];?>">BREAK</a></button></td>
                            <?php } ?> 
                            <?php if($date >= $exp)
                            {?>
                            <td><button class="button4" id="renew"><a href="renew.php?id=<?php echo $row['TD_ID'];?>">RENEW</a></button></td>
                            <?php } ?> 
                        </tr>
						<?php

					}
				?>
                </tbody>
            </table>
        </div>
        <!------------------------------------------->
        <div class="block3"></div>
    </div> 

    <!--MODAL OVERLAY------------------------------>
        <div id="overlay" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h3 class="header">Interest Rates</h3>
            </div>
            
            <!--interest rates -->
            <div class="table-wrapper1">
            <table class="fl-table">
                <thead>
                <tr>
                    <th>TENURE (years)</th>
                    <th>RATE</th>
                </tr>
                </thead>

                <tbody>
                <?php 
					$pdo = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');

					$sql="SELECT Tenure,Rate FROM interests WHERE type='Term Deposit'";
					$query=$pdo->query($sql);
					foreach($pdo->query($sql) as $row){
						?>
						<tr>
                            <td> <?php echo $row['Tenure']; ?></td>
                            <td> <?php echo $row['Rate']; ?>%</td>
						</tr>
						<?php
					}
				?>
                </tbody>
            </table>
            </div>
        </div>
    <!-------------------------------------------> 
    <script src="scripts/main.js"></script>
    </body>
</html>