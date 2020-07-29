<?php
session_start();

$db = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//$sql=$db->prepare("select * FROM loan where account_no= '".$_SESSION["account"]."' LIMIT 1");
$sql=$db->prepare("select * FROM loan LIMIT 1");
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
                <input type="number" class="input-field" name="amount" id="amount" placeholder="₹" value="1"> 
            </div>
            <div class="ann">
                <label for="ann" class="label-field">Annual Income</label>
                <input type="number" class="input-field" name="ann" id="ann" placeholder="₹"> 
            </div>
            <div class="installment">
                <label for="installment" class="label-field">Installments</label>
                    <select name="slct1" class="slct1" id="slct1">
                      <option selected disabled>---</option>
                        <?php
	                    $pdo = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');

                        $sql="SELECT tenure FROM interests WHERE type='loan'";
                        $query=$pdo->query($sql);
	                    foreach ($pdo->query($sql) as $row)//Array or records stored in $row
		                {
			            echo "<option value=$row[tenure]>$row[tenure]</option>"; 
		                }
	                    ?>
                    </select>
            </div>
        </div>
        <!------------------------------------------->
        <script>var principal= parseFloat(document.getElementById("amount").value);</script>        <!-----SET PRINCIPAL AMOUNT---->

        <!--Container for buttons-------------------->
        <div class="flex-container3">
            <button type="button" name="info" id="info" class="button button1">VIEW INSTALLMENTS</button>
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
        <form class="output-group" id="output">
            <div class="flex-container4 ">
                <div class="display">
                    <label  class="label-field">Loan ID
                        <input type="number" id="loan-id" class="display-field" value="<?php echo $row['loan_id']; ?>" disabled>
                    </label>
                </div>
                <div class="display">
                    <label  class="label-field">Amount
                        <input type="number" id="amount1" class="display-field" value="<?php echo $row['amount']; ?>" disabled>
                    </label>
                </div>
                <div class="display">
                    <label  class="label-field">Installments
                        <input type="number" id="inst" class="display-field" value="<?php echo $row['installments']; ?>" disabled>
                    </label>
                </div>
                <div class="display">
                    <label  class="label-field">Creation Date
                        <input type="date" id="creation-date" class="display-field" value="<?php echo $row['creation_date']; ?>" disabled>
                    </label>
                </div>
            </div>
            <button type="button" name="repay" id="repay" class="button button2">REPAY LOAN AT ONCE</button>
        </form>
        <!--Bottom border block-->
        <div class="block3"></div>
    </div> 

    <!-- MODAL OVERLAY ------------------------------>
    <div id="overlay" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            
            <div class="modal-header">
                <span class="close">&times;</span>
                <h3>Interest Rates</h3>
                <p id="test"></p>
            </div>
            
            <!--interest rates -->
            <div class="table-wrapper1">
            <table class="fl-table">
                <thead>
                <tr>
                    <th>INSTALLMENTS</th>
                    <th>EMI</th>
                </tr>
                </thead>

                <tbody>
                <?php 
					$pdo = new PDO('mysql:host=localhost;dbname=mfs', 'root', '');

					$sql="select tenure,rate FROM interests where type='loan'";
					$query=$pdo->query($sql);
					foreach($pdo->query($sql) as $row){
						?>
						<tr>
                            <td> <?php echo $row['tenure']; ?> </td>
                            <td>
                                <script>
                                        var n=parseInt("<?php echo $row['tenure']; ?>");
                                        var rate=parseFloat("<?php echo $row['rate']; ?>");
                                        var emi = Math.round(principal * rate * ((rate+1)**n) / ((rate+1)**n - 1));
                                </script>
                            </td>
						</tr>
						<?php
					}
				?>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <!---------------------------------------------->
    
    <script>
        var check = "<?php echo $count; ?>";
        if(check == 0)
        {
            document.getElementById("noLoan").style.visibility = "visible";
            document.getElementById("output").style.display = "none";
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