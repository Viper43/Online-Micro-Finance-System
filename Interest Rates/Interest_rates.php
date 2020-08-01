<?php
    session_start();
?>
<html>
    <head>
        <title> Interest Rates </title>
        <link rel = "stylesheet" href = "styles/interest_rate_style.css"/>
        <script src="scripts/Interest_rates_script.js"></script>
    </head>
    <body>

        <div class="menu_bar">
            <ul>
                <li><a href="../Admin/Admin_main.php"> Home </a></li>
               <li class="active"><a href="#"> Interest Rates </a></li>
               <li><a href="../logout_back.php"> Logout </a></li>
               <li><a href="#">About Us</a></li>
             </ul>
        </div>

        <div class = "form-box">

            <!--------------------Display image and text section----------------------->
            <div class="image">
                <div class="text-content">
                    <h1 style="font-family: sans-serif;font-size: 65;"> Interest Rates</h1>
                    <p style="font-family: 'Times New Roman';font-size: 17;">Here you can view the available interest rates and even add new ones.
                    The schemes can be deleted or edited also.</p>
                </div>
            </div>
            
            <!--------------- Table data block --------------->

            <h1 class="A" id="A"> Existing Schemes </h1>
            
            <div class="table-wrapper" id="transaction">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th> INTEREST TYPE </th>
                            <th> RATE (in %) </th>
                            <th> TENURE </th>
                            <th> DELETE </th>
                            <th> EDIT </th>
                        </tr>
                    </thead>
        
                    <tbody>
                        
                        <?php
                            
                            $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "SELECT * FROM interests ORDER BY Type";
                            $query = $db->query($sql);
                            foreach($db->query($sql) as $rows) {
                                
                            ?>
                                
                                <tr>
                                    <td> <?php echo $rows['Type']; ?> </td>
                                    <td> <?php echo $rows['Rate']; ?> </td>
                                    <?php if( $rows['Type'] == 'Term Deposit') {?>
                                        <td> <?php echo $rows['Tenure']; ?> years </td>
                                    <?php }
                                    else { ?>
                                    <td> <?php echo $rows['Tenure']; ?> months </td>
                                    <?php } ?>
                                    <td> <button class = "del-btn" > <a href = "delete_interest.php?id=<?php echo $rows['ID']; ?>" class = "del-link"> Delete </a> </button> </td>
                                    <td> <button class = "edit-btn" > <a href = "interest_edit.php?id=<?php echo $rows['ID']; ?>" class = "edit-link" > Edit </a> </button> </td>
                                </tr>
                                <?php
                            }
                        
                        ?>
                    <tbody>
                </table>
            </div>

            <button type="submit" class="btn-add" onclick="addFields()" > ADD NEW SCHEME </button>
            
            <!----------------- Adding new Schemes block ---------------------------->

            <h1 class="B" id="B"> Enter New Scheme </h1>

            <form class="input-group" id="add_rates" method="POST" action="add_interest_rates_back.php" enctype="multipart/form-data">
            
                <div class="container">
                    
                    <label  class="label-field"> Interest Type

                        <select class = "dropdown"  id = "type" name="interestType" required >
                            <option class = "option" value="Savings"> Savings </option>
                            <option class = "option" value="Term Deposit"> Term Deposit </option>
                            <option class = "option" value="Loan"> Loan </option>
                        
                        </select>
                    </label>
    
                    <br>
                    
                    <label  class="label-field"> Rate
                        <input type="number" step = "0.01" id="rate" class="input-field" name="interestRate" required >
                    </label>
                    
                    <br>
                    
                    <label  class="label-field" id="tenure-label"> Tenure
                        <input type="number" id="tenure" class="input-field" name="interestTenure" required >
                    </label> 

                </div>
                <br>
                <button type="submit" class="btn-add" > ADD </button>
            </form>

            <p class = "foot-note" style="font-family: 'Times New Roman';font-size: 15;">*Note: Term Deposits are stored in years whereas Loan and other schemes are stored in months</p>
        </div>
    </body>
</html>