<html>

<head>
	<title>Register</title>
  
  <style>
    
.topnav {
  background-color: #A6CBD7;
  overflow: hidden;
  height: 90px;
}

/* Style the links inside the navigation bar */
.topnav a {

  margin-top: 15px;
  float: left;
  color: black;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
  font-family: Fjalla One;
}

/* Change the color of links on hover */
.topnav a:hover {
  color: #F3C477;
}

/* Add a color to the active/current link */
/*.topnav a.active {
  background-color: #4CAF50;
  color: white;
}*/
body {
  margin: 15px;
  background-color: #F8F8FF;
}
.register {
  margin-top: 30px;
  text-align: center;
}

.register input {
  padding: 10px;
  padding-right: 50px;
  padding-left: 20px;
  margin: 10px;
  margin-left: -20px;
}
/*.lr {
  margin-top: -50px;
  margin-left: 1160px;
}*/

.topnav img {
  margin-top: 13px;
  margin-left: 10px;
  float: left;
}

.searchdiv {
  margin-top: 15px;
  /*margin-left: 850px;*/
  margin-left: 500px;
}

.searchInput {
  width: 500px;
  height: 30px;
}

.searchButton {
  width: 75px;
  height: 30px;
}

table {
  margin-left: 100px;
  border: pixels;
  padding-top: 50px;
  margin-right: 30px;
}

td {
  
}

.nick {
  text-align: center;
}
p {
    max-width:200px;
    word-wrap:break-word;
}
.a_tags {
  margin-left: 850px;
}

#login_tag {
  margin-left:50px;
}

</style>
</head>

<body >


  <div class="topnav" >
  
<img src="komek_logo.png"  height="60" width="195" />
<div class="a_tags">
  <a href="home.php">Home</a>
  <a href="orders.php">Orders</a>
  <a href="contacts.php">Contacts</a>
  <a href="profile.php">Profile</a>
  
  <a id="login_tag" href="login.php">Log in</a>
</div>
</div>





<div class="register">
<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
$db = mysqli_connect ("localhost","yusuf", "1234", "mysteryshack");
if (isset($_POST['submit'])) {
$username = $_POST['username'];                              
$email = $_POST['email'];
$password = $_POST['password'];
$r_password = $_POST['r_password'];
 if ($password==$r_password)
		{
		$result2 = mysqli_query ($db, "INSERT INTO clients (username,email, password) VALUES ('$username','$email','$password')");	
	if ($result2=='TRUE')
					{
							
	exit ("Вы успешно зарегистрированы! Теперь вы можете зайти на сайт. <a href='home.php'>Главная страница</a>");
					
					}
	else {
		echo "Ошибка! Вы не зарегистрированы.";
	        }

			}
else { 
		die ('Passwords must match!');
			}

}
?>
	<form method="post" action="register.php">
	<input type="text" name="username" placeholder="Username" required="Username" /><br>
	<input type="text" name="email" placeholder="Email" required="Email" /><br>
	<input type="password" name="password" placeholder="Password" required="Password" /><br>
	<input type="password" name="r_password" placeholder="Retype your password" required="Retype your password" /><br>
	<input type="submit" name="submit" value="Register"/>
	</form>
</div>
	</body>
</html>