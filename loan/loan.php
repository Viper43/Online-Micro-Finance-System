<?php
session_start();

include "../connection.php";

$sql=$db->prepare("SELECT * FROM loan WHERE Account_No= '".$_SESSION["account"]."'");

$sql->execute(); 
$count = $sql->rowCount();
$row = $sql->fetch();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Loan</title>

        <link rel = "icon" href = "../images/logo.png" type = "image/x-icon">
        <link href="styles/style.css" rel="stylesheet"> 
    </head>

    <body>
        <div class="menu_bar">

            <!---------- Logo ------------------------------->

            <div class="logo">
                <img class="nav-icon" src="../images/icon.jpg"/>
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
                <li><a href="../td/td.php">Term Deposit</a></li>
                <li class="active"><a href="../loan/loan.php">Loan</a></li>
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
                    <h1 class="img-head">LOAN</h1>
                    <p class="information">You can request for loan by specifying amount, annual income
                        and the number of installments. Previous loans must be cleared to avail new loan.
                        You also have to be a member for at least a year to avail loan services.
                        Currently active loan information is displayed, if any.
                    </p>
                </div>
            </div>
            <!------------------------------------------>

            <!--Create TD block------------------------->
            <div class="block1">
                <h1 class="A">Create Loan</h1>
            </div>
            <!------------------------------------------>
        
            <!--Container for Input field and labels---->
            <div class="flex-container2">
                <div class="amount">
                    <label for="amount" class="label-field">Amount</label>
                    <input type="number" class="input-field" name="amount" id="amount" placeholder="₹"> 
                </div>
                <div class="ann">
                    <label for="ann" class="label-field">Annual Income</label>
                    <input type="number" class="input-field" name="ann" id="ann" placeholder="₹"> 
                </div>
                <div class="installment">
                    <label for="installment" class="label-field">Installments</label>
                        <select name="slct1" class="slct1" id="slct1">
                        <option selected disabled hidden>---</option>
                            <?php

                            $sql="SELECT Tenure FROM interests WHERE Type='Loan'";
                            $query=$db->query($sql);
                            foreach ($db->query($sql) as $row)//Array or records stored in $row
                            {
                            echo "<option value=$row[Tenure]>$row[Tenure]</option>"; 
                            }
                            ?>
                        </select>
                </div>
            </div>
            <!------------------------------------------->
                            
            <!--Container for buttons-------------------->
            <div class="flex-container3">
                <button type="button" name="info" id="info" class="button button1">EMI CALCULATOR</button>
                <button type="button" name="create" id="create" class="button button2" onclick="location.href='create_loan.php?amount='+ document.getElementById('amount').value+'&ann='+ document.getElementById('ann').value+'&slct1='+ document.getElementById('slct1').value;">
                SUBMIT FOR REVIEW</a></button>
            </div>
            <!-------------------------------------------> 
            
            <!--View TD block---------------------------->
            <div class="block2">
                <h1 class="B">Active Loan</h1>
            </div>
            <!------------------------------------------->
        
            <!--Active Loan------------------------------>
            <!--IF no active loan-->
            <div class="noLoan" id="noLoan" style="visibility:hidden">
                <img class="icon" src="images/icon.png" alt="icon">
                <h3 class="n">No active loan for this account.<h3>
            </div>

            <!--IF active loan exists-->
            <div id="output-group" class="output-group">
                <?php 
                $sql=$db->prepare("SELECT * FROM loan WHERE Account_No= '".$_SESSION["account"]."'");
                $sql->execute();
                $row = $sql->fetch();?>

                <table class="main2">
                    <col class=w50>
                    <col class=w50>
                    <tr>
                        <td>Loan ID</td>
                        <td><input type="number" id="loan-id" value="<?php echo $row['Loan_Id']; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Amount</td>
                        <td>₹ <input type="number" id="amount1" value="<?php echo $row['Amount']; ?>" disabled></td>
                    </tr>
                    <tr>
                        <td>Installments</td>
                        <td><input type="number" id="inst" value="<?php echo $row['Installments']; ?>" disabled></td>
                    </tr>						
                    <tr>
                        <td>Creation Date</td>
                        <td><input type="date" id="creation-date" value="<?php echo $row['Creation_Date']; ?>" disabled></td>
                    </tr>
                </table>
                <button type="button" name="repay" id="repay" class="button button2" onclick="location.href='repay_once.php'">REPAY LOAN AT ONCE</button>
            </div>       

            <!--Bottom border block-->
            <div class="block3"></div>
        </div> 

        <!-- MODAL OVERLAY ------------------------------>
        <div id="overlay" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h3 class="header">EMI CALCULATOR</h3>
                </div>
                
                <!--calculate emi -->
                <div class=cover>
                    <table class="main">
                        <col class=w50>
                        <col class=w50>
                        <tr>
                            <td>Loan Amount</td>
                            <td><input id="amount2" type="number" placeholder="₹"></td>
                        </tr>
                        <tr>
                            <td>Installments</td>
                            <td>
                                <select name="installment2" id="installment2">
                                <option selected disabled>---</option>
                                <?php

                                    $sql="SELECT Tenure,Rate FROM interests WHERE Type='Loan'";
                                    $query=$db->query($sql);
                                    foreach ($db->query($sql) as $row)//Array or records stored in $row
                                    {
                                        echo "<option value=$row[Tenure]>$row[Tenure]</option>"; 
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Interest Rate</td>
                            <!--<td><input id=rate onchange=emi();></td>-->
                            <td><input id=rate value="<?php echo $row['Rate']; ?>" disabled></td>
                        </tr>						
                        <tr>
                            <td><button id="reset" class="button button2 buttonModal" type=reset>Reset</button></td>
                            <td><button class="button button2 buttonModal" type=button onclick='emi()'>Calculate</button></td>
                        </tr>
                        <tr>
                            <td>EMI</td>
                            <td><input id="emi1" disabled></td>
                        </tr>
                        <tr>
                            <td>Interest payable</td>
                            <td><input id="total_inte" disabled></td>
                        </tr>						
                        <tr>
                            <td>Total payable</td>
                            <td><input id="total" disabled></td>
                        </tr>
                    </table>
                </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------->
        <script>
            var check = "<?php echo $count; ?>";
            if(check == 0)
            {
                document.getElementById("noLoan").style.visibility = "visible";
                document.getElementById("output-group").style.display = "none";
            }
            else if(check == 1)
            {
                document.getElementById("noLoan").style.display = "none";
                document.getElementById("create").disabled = true;
                document.getElementById("create").classList.add('button2d');
                document.getElementById("create").classList.remove('button2');
            }
        </script>
        <script src="scripts/main.js"></script>
    </body>
</html>