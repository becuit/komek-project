<?php 
  
  session_start();
  if (!$_SESSION['m_un']){
  header('Location: login.php');
  exit;
}

?> 



<html>

<head>
	<title>Profile</title>
	<html>

<head>
  <title>Orders</title>
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
  margin-left: 400px;
  border: pixels;
  padding-top: 50px;
  margin-right: 30px;
  padding-right: 10px;
  
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

<?php  

    $name = $_SESSION['m_un'];
    $db = mysqli_connect("localhost","bolat","1234","komek"); 
    $sql = "select * from volunteers where volunteer_name='$name'";
    $sth = $db->query($sql);
    while($result=mysqli_fetch_array($sth)){  
        
        ?>
        <table>
        <tr>
          <td><?php
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['volunteer_image'] ).'" /> 
        ';?>
      </td>
      <td class="info">
        <p><strong>Name:</strong> 
        <?php echo $result["volunteer_name"]?> </p> 
        <?php
        ?> 
        <p> <strong>Surname:</strong>  
        <?php echo $result["volunteer_surname"] ?> </p>
        <p> <strong>Age:</strong> 
        <?php echo $result["volunteer_age"]?> </p> 
        <p> <strong>Email:</strong> 
        <?php echo $result["volunteer_email"]?> </p> 
        <div class="history">
    <a  href="history.php">View the history</a>
  
<p></p>
        <form method="post" action="profile.php">
        <input type="submit" name="button1"
                class="button" value="Log out" />
                
    </form>
    </div>
      </td>
    </tr>
    </table>
    <?php

    }   

     if(array_key_exists('button1', $_POST)) {
            button1();
        }
        
        function button1() {
            

unset($_SESSION["m_un"]);


        }

        // if(isset($_POST['history'])) {

        //   header('Loaction: history.php');
        // }

//         if(array_key_exists('history', $_POST)) {
//             button2();
//         }
        
//         function button2() {
            

// header('Loaction: history.php');

//         }
?>

</div>
</body>
</html>
