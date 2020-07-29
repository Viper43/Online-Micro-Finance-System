<?php session_start();
    $date = date('Y-m-d');
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Term Deposit</title>
 
    <link href="styles/style.css?v=<?php echo time(); ?>" rel="stylesheet"> 
  </head>

  <body>
    <div class="menu_bar">
            <ul>
                <li><a href="../main_page/main.php">Home</a></li>
               <li><a href="#">Transaction</a>
                    <div class="sub_menu">
                        <ul>
                            <li><a href="../Create Transaction/Create_transaction.php">Create</a></li>
                            <li><a href="../My Transactions/My_transactions.php">View</a></li>
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

                        $sql="SELECT tenure FROM interests WHERE type='td'";
                        $query=$pdo->query($sql);
	                    foreach ($pdo->query($sql) as $row)//Array or records stored in $row
		                {
			                echo "<option value=$row[tenure]>$row[tenure] Year(s)</option>"; 
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
                    <th>BREAK</th>
                    <th>RENEW</th>
                </tr>
                </thead>

                <tbody>
                <?php 
					$pdo = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');

					$sql="select * FROM td where account_no= '".$_SESSION["account"]."'";
					$query=$pdo->query($sql);
					foreach($pdo->query($sql) as $row){
                        $exp = date('Y-m-d', strtotime($row['creation_date']. "+ {$row['tenure']} years"));
						?>
						<tr>
							<td> <?php echo $row['td_id']; ?></td>
                            <td> ₹<?php echo $row['amount']; ?></td>
                            <td> <?php echo $row['tenure']; ?></td>
                            <td> <?php echo $row['creation_date']; ?></td>
                            <td><button class="button3" onclick="alert('Selected term deposit has been closed.')"><a href="break.php?id=<?php echo $row['td_id'];?>">BREAK</a></button></td>
                            
                            <?php if($date >= $exp)
                            {?>
                            <td><button class="button4" id="renew" onclick="alert('Selected term deposit has been renewed.')"><a href="renew.php?id=<?php echo $row['td_id'];?>">RENEW</a></button></td>
                            <?php } ?> 

                        </tr>
						<?php

					}
				?>
                </tbody>
            </table>
        </div>
        <!------------------------------------------->

        <!--Manage TD block------------------------->
        <!--<div class="block1">
            <h1 class="A">Manage Term Deposit</h1>
        </div>  
        <div class="select">
            <label for="slct" class="label-field">Term Deposit to manage</label> 
            <select name="slct" class="slct" id="slct">
              <option selected disabled>Select TD</option>
              <?php
	                $pdo = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');

                    $sql="select td_id FROM td WHERE account_no= '".$_SESSION["account"]."'";
                    $query=$pdo->query($sql);
	                foreach ($pdo->query($sql) as $row)//Array or records stored in $row
		            {
			            echo "<option value=$row[td_id]>$row[td_id]</option>"; 
		            }
	         ?>
            </select>
          </div>
        
        <div class="flex-container3">
            <button type="button" name="info" class="button button2">BREAK</button>
            
            <button type="button" name="create" class="button button2">RENEW</button>
        </div>
        <!------------------------------------------>
        <div class="block3"></div>
    </div> 

    <!--MODAL OVERLAY------------------------------>
        <div id="overlay" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h3>Interest Rates</h3>
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

					$sql="select tenure,rate FROM interests where type='td'";
					$query=$pdo->query($sql);
					foreach($pdo->query($sql) as $row){
						?>
						<tr>
                            <td> <?php echo $row['tenure']; ?></td>
                            <td> <?php echo $row['rate']; ?>%</td>
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
