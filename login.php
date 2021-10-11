<!DOCTYPE html>​

<html>​

<head>​

<title> ​

  Log in

</title>​

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

.login-form {
  margin-top: 50px;

}

.login-form input {
  width: 200px;
  height: 25px;
  padding: 5px;
}

</style>

</head>​




<body >



<?php 

$db = mysqli_connect("localhost","bolat","1234","komek");

if(isset($_POST["Submit1"]))
{
  $email = $_POST['email'];
  $password = $_POST['password'];
  $array = array(
  1 =>  $email,
  2 =>  $password);
  
  $sql = "select * from volunteers where volunteer_email='$array[1]'";
  $sql_1 = "select * from clients where client_email='$array[1]'";
  $sth = $db->query($sql);

  $nResults = mysqli_num_rows($sth);
  
  $result=mysqli_fetch_array($sth);


  $sth_1 = $db->query($sql_1);
  $nResults_1 = mysqli_num_rows($sth_1);
  $result_1 = mysqli_fetch_array($sth_1);
  

  if ( $nResults > 0 ) {
  if ($result['volunteer_password']==$array[2]) {
    session_start();
    $_SESSION['m_un'] = $result['volunteer_name'];
    $_SESSION['id'] = $result['volunteer_id'];
    $_SESSION['isClient'] = False;
    header('Location: home.php');

  }
  else {
    echo "Your password is wrong";
  }
}
elseif ($nResults_1 > 0) {
    if ($result_1['client_password']==$array[2]) {
    session_start();
    $_SESSION['m_un'] = $result_1['client_name'];
    $_SESSION['id'] = $result_1['client_id'];
    $_SESSION['isClient'] = True;
    header('Location: home.php');
  }
    else {
    echo "Your password is wrong";
  }
}
  else {
    echo('Your login is wrong. Please try again');
  }
}








 

?>
	




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
<div class="login-form" align="center">

<form method="POST" action="login.php">​

    <input type="text" name="email"  placeholder="email"   required="email" /><br><br>​

   <input type="password" name="password"  placeholder="password" required="password" /><br><br>​

<input  type="submit"   name="Submit1"      value="Log in"/>​ 



</form>​

</div>
 


</body>​

</html>
