<?php
	require "common variables/common_var.php";
?>
<html>
<head>
<title>Login Page </title>
	<link rel = "icon" href = "images/logo.png" type = "image/x-icon">
	<link rel="stylesheet" href="login/style_login.css"/>
	<script src="login/demo_login.js"></script>
</head>
<body>
	<div class="menu_bar">
		<!---------- Logo ------------------------------->

		<div class="logo">
			<img class="icon" src="images/icon.jpg" alt="Logo of company"/>
			<label class="logo-label">REPO FINANCES</label>
		</div>
		
		<ul>
		    <li><a href="#">About Us</a></li>
		 </ul>
	</div>
	<div class="login_page">
		<div class="info_form">
			<h1 style="color:white; font-family: cambria; font-size: 45; font-weight: normal;">Online Microfinance System</h1><br>
			<p style="color:rgb(100,100,100); font-family: cambria; font-size: 20; font-weight: normal;">It's a financial platform to provide the poor with access to financial services as well as an opportunity for them to build their financial capacity and ability to grow to financial self-sufficiency.</p><br>
		</div>
		
		<div class="form">
			
			<div id="choice" class="input1">
				<img class = "avatar" src="images/avatar.jpg" alt="avatar"/>
				<br><br><br><button type = "button" class="submit-btn" onclick="login()">User</button><br>
				<h5>----------OR----------</h5>
				<br><button type = "button" class="submit-btn" onclick="admin_login()">Admin</button>
			</div>
			
			<form class="button" id="full_button">
                <div id = "btn"></div>
               	<button type = "button"  class = "toggle_btn" onclick="login()" >Login</button>
               	<button type = "button"  class = "toggle_btn" onclick="register()">Register</button>  
			</form>
			
			<form id="login" method="POST" action="login/login_back.php" class="input">
				<input type="email" name="email" class="input-field" placeholder="Email" required>
				<input type="password" onmousedown="this.type='text'" onmouseup="this.type='password'" onmouseout="this.type='password'" name="password" class="input-field" placeholder="Password" required>
				<button type="submit" class="submit-btn">Login</button>
			</form>	
			
			<form id="register" method="POST" action="login/register_back.php" class="input">
				
				<input type="text" name="username" id="u_name" class="input-field" placeholder="Full Name" required onkeypress= "return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" >
				
				<input type="email" name="email" id="mail" class="input-field" placeholder="Email" required>
				
				<input type="password" onmousedown="this.type='text'" onmouseup="this.type='password'" onmouseout="this.type='password'" name="password" id="pass" class="input-field" placeholder="Password (8 - 28 characters)" required>
				
				<br><br><br><br>
				
				<button type = "button"  id="register_btn" class="submit-btn" onclick="create_account()">Register</button>	
				
				<input type="text" name="address" id="address" class="input-field" placeholder="Address" required>
				
				<input type="tel" name="phone" id="phone" class="input-field" pattern="[6-9]{1}[0-9]{9}" placeholder="Phone no. (10 digits)" required>
				
				<input type="text" name="dob" id="dob" class="input-field" max = "<?php echo $age ?>" placeholder="Date of Birth" onfocus="(this.type='Date')" required>
				
				<input type="text" name="gid" id="govtid" class="input-field" placeholder="Government ID" required>
				
				<button type="submit" id="create_btn" class="submit-btn">Create Account</button>
			</form>

			<form id="admin_login" method="POST" action="login/signin_back.php" class="input1">
				
				<img class = "avatar" src="images/avatar.jpg"/>
				
				<br><br><br>
				
				<input type="text" name="username" class="input-field" placeholder="ID" required>
				
				<input type="password" onmousedown="this.type='text'" onmouseup="this.type='password'" onmouseout="this.type='password'" name="password" class="input-field" placeholder="Password" required>
				
				<button type="submit" class="submit-btn">Sign In</button>	
			</form>

		</div>
	</div>
</body>
</html>