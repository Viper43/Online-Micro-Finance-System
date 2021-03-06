<?php
    session_start();
    require "../check_login.php";
    
    $id = $_GET['id'];

    require "../connection.php";    
                      
    $sql = "SELECT * FROM interests WHERE Id = '{$id}' ";
    $query = $db->query($sql);
    $rows = $query->fetch();

    $type = $rows['Type'];
    $rate = $rows['Rate'];
    $tenure = $rows['Tenure'];
                                    
?>
<html>
    <head>
        <title> Interest Rate Editing  </title>
            <link rel = "icon" href = "../images/logo.png" type = "image/x-icon">
            <link rel = "stylesheet" href = "styles/interest_rate_style.css"/>
    </head>
    <body>
        <div class="menu_bar">

            <!---------- Logo ------------------------------->

            <div class="logo">
                <img class="icon" src="../images/icon.jpg"/>
                <label class="logo-label">REPO FINANCES</label>
            </div>

            <ul>
                <li><a href="../Admin/Admin_main.php"> Home </a></li>
               <li class="active"><a href="#"> Interest Rates </a></li>
               <li><a href="../logout_back.php"> Logout </a></li>
               <li><a href="#">About Us</a></li>
            </ul>
        </div>

        <div class = "form-box">

            <h1 class="A" id="A"> Edit Rate Scheme </h1>

            <form class = "input-group" method = "POST" action = "edit_interest_back.php" enctype="multipart/form-data" >
                 
                <div class="container">

                    <label  class="label-field" style = "display: none;"> I
                        <input type ="text" class = "input-field" name = "interestId" value = "<?php echo $id ?>" >
                    </label>

                    <label  class="label-field"> TYPE
                        <input type ="text" class = "input-field" name = "interestType" readonly value = "<?php echo $type ?>" required >
                    </label>
                        
                    <br>
                        
                    <label  class="label-field" > RATE
                        <input type="number" step = "0.01" class="input-field" min = "1" name="interestRate" value = "<?php echo $rate ?>" required >
                    </label>
                    
                    <br>

                    <label  class="label-field"> TENURE
                        <input type ="number" class = "input-field" min = "1" name = "interestTenure" value = "<?php echo $tenure ?>" required >
                    </label>

                </div>

                <br>
                    
                <button type="submit" class="btn-add" > SAVE </button>
                
                <p class = "foot-note">*Note: Term Deposit tenures are stored in years whereas Loan and other tenures are stored in months</p>
            </form>

    
             
        </div>
    </body>
</html>