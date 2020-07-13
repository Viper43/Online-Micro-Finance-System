<?php
    session_start();
?>
<html>
    <head>
        <title> Interest Rates </title>
        <link rel = "stylesheet" href = "styles\interest_rate_style.css"/>
        <script src="scripts\Interest_rates_script.js"></script>
    </head>
    <body>

        <div class="menu_bar">
            <ul>
                <li><a href="http://localhost/Viper/Login_system/Admin_main.php"> Home </a></li>
               <li class="active"><a href="#"> Interest Rates </a></li>
               <li><a href="http://localhost/roll13/oms/login.html"> Logout </a></li>
               <li><a href="#">About Us</a></li>
             </ul>
        </div>

        <div class = "form-box">
            <h1 class="A" id="A"> Existing Schemes </h1>
            
            <div class="table-wrapper" id="transaction">
                <table class="fl-table">
                    <thead>
                        <tr>
                            <th> INTEREST TYPE </th>
                            <th> RATE (in % ) </th>
                            <th> TENURE (in months) </th>
                            <th> DELETE </th>
                            <th> EDIT </th>
                        </tr>
                    </thead>
        
                    <tbody>
                        
                        <?php
                            
                            $db = new PDO("mysql:host=localhost;dbname=mfs","root","");
                            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $sql = "SELECT * FROM interests ";
                            $query = $db->query($sql);
                            foreach($db->query($sql) as $rows) {
                                
                            ?>
                                
                                <tr>
                                    <td> <?php echo $rows['Type']; ?> </td>
                                    <td> <?php echo $rows['Rate']; ?> </td>
                                    <td> <?php echo $rows['Tenure']; ?> </td>
                                    <td> <button class = "del-btn" > <a href = "backends\delete_interest.php?id=<?php echo $rows['Id']; ?>" class = "del-link"> Delete </a> </button> </td>
                                    <td> <button class = "edit-btn" > <a href = "interest_edit.php?id=<?php echo $rows['Id']; ?>" class = "edit-link" > Edit </a> </button> </td>
                                </tr>
                                <?php
                            }
                        
                        ?>
                    <tbody>
                </table>
            </div>

            <button type="submit" class="btn-add" onclick="addFields()" > ADD NEW SCHEME </button>

            <h1 class="B" id="B"> Enter New Scheme </h1>

            <form class="input-group" id="add_rates" method="POST" action="backends\add_interest_rates_back.php" enctype="multipart/form-data">
            
                <div class="container">
                    
                    <label  class="label-field"> Interest Type

                        <select class = "dropdown"  id = "type" onchange="enableReceiver()" name="interestType" required >
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
                    
                    <label  class="label-field" id="tenure-label"> Tenure (in months)
                        <input type="number" id="tenure" class="input-field" name="interestTenure" required >
                    </label> 

                </div>
                <br>
                <button type="submit" class="btn-add" > ADD </button>
            </form>
        </div>
    </body>
</html>
