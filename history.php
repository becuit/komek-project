<?php 
session_start();

if (!$_SESSION['m_un']){
  header('Location: login.php');
  exit;
}
  

?>


<html>

<head>
	<title>History</title>
	
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

.in-progress {
  background-color: yellow;
}

.completed {
  background-color: #99ff3b;
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
$id_of_volunteer = $_SESSION['id'];
$db = mysqli_connect("localhost","bolat","1234","komek"); 
    $sql = "select o.order_id, o.order_date, c.client_name, c.client_image, o.order_address_from, o.order_address_to, o.order_status from orders o join clients c on c.client_id = o.client_id where o.order_status = 'in progress' and o.volunteer_id = '$id_of_volunteer'";
    $sql_2 = "select o.order_id, o.order_date, c.client_name, c.client_image, o.order_address_from, o.order_address_to, o.order_status from orders o join clients c on c.client_id = o.client_id where o.order_status = 'completed' and o.volunteer_id = '$id_of_volunteer'";
    $sth = $db->query($sql);
    $sth_2 = $db->query($sql_2);
    $i = 0;
    $message_success = 'The operation ended successfully';
    $message_error = 'Please try again';
    
    $button_ar = array(1=> 'button1', 2=> 'button2', 3=>'button3', 4=>'button4', 5=>'button5', 6=>'button6', 7=>'button7');
    $n = 1;
    $column_1 = array(1,4,7,10,13,16,19);
    $column_2 = array(2,5,8,11,14,17,20);
    $column_3 = array(3,6,9,12,15,18,21);

    while($result= mysqli_fetch_array($sth)) { 
        $id_of_order = $result['order_id'];
        for ( $i = 1; $i <= 30; $i++ ) {
        $button_name = "button" . $i;
        if ( isset( $_POST[$button_name] ) ) {
            $sql_query = "update orders set order_status = 'completed' where order_id = '$i'";
            if (mysqli_query($db, $sql_query)) {
              header('Location: history.php');
            } else {
              header('Location: confirmation.php');
            }       
        }
}


        
        
       
        
        if (in_array($n, $column_1)){ 

          $s = $n;
        ?>
        <div class="" align="center">
        <form  method="post" action="history.php">
    <table class="group1">
      <th>
        <table class = "table1">
          <tr>
            <td>
              <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['client_image'] ).'" height="240" width="180"/> ';?>
            </td>
            <td>
          <p><strong>Name:</strong> 
          <?php echo $result["client_name"]; $name = $result["client_name"]?> </p> 
          <?php
          ?> 
          <p> <strong>From:</strong>  
          <?php echo $result["order_address_from"] ?> </p>
          <p> <strong>To:</strong> 
          <?php echo $result["order_address_to"]?> </p> 
          <p> <strong>Date:</strong> 
          <?php echo $result["order_date"]?> </p> 
          <p> <strong>Order status:</strong>

          <div class="in-progress"><?php echo $result["order_status"]?></div> </p> 
          <form method="post" action="history.php">
          <!-- <button onclick="confirmation()">Take the order</button> -->
          <input name="<?php echo "button".$id_of_order; ?>" type="submit" value="Mark as completed">
          <!-- onclick="return confirm('Are you sure?')" -->
          </form>
          </td>
        </tr>
        </table>
      </th>
  <?php
  }
  if (in_array($n, $column_2)){
  ?> 
      <th>
        <table class = "table2">
          <tr>
            <td>
              <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['client_image'] ).'" height="240" width="180"/> ';?>
            </td>
            <td>
              <p><strong>Name:</strong> 
              <?php echo $result["client_name"]; $name = $result["client_name"]?> </p> 
              <?php
              ?> 
              <p> <strong>From:</strong>  
              <?php echo $result["order_address_from"] ?> </p>
              <p> <strong>To:</strong> 
              <?php echo $result["order_address_to"]?> </p> 
              <p> <strong>Date:</strong> 
              <?php echo $result["order_date"]?> </p> 
              <p> <strong>Order status:</strong> 
              <?php echo $result["order_status"]?> </p> 
              <form method="post" action="history.php">
                <!-- <button onclick="confirmation()">Take the order</button> -->
                <input name="<?php echo "button".$id_of_order; ?>" type="submit" value="Mark as completed">
                <!-- onclick="return confirm('Are you sure?')" -->
              </form>
            </td>
          </tr>
        </table>
      </th>
      
      <?php
      }
      if (in_array($n, $column_3)){
      ?>
      
      <th>
        <table class = "table3">
          <tr>
            <td>
              <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $result['client_image'] ).'" height="240" width="180"/> ';?>
            </td>
            <td>
          <p><strong>Name:</strong> 
          <?php echo $result["client_name"]; $name = $result["client_name"]?> </p> 
          <?php
          ?> 
          <p> <strong>From:</strong>  
          <?php echo $result["order_address_from"] ?> </p>
          <p> <strong>To:</strong> 
          <?php echo $result["order_address_to"]?> </p> 
          <p> <strong>Date:</strong> 
          <?php echo $result["order_date"]?> </p> 
          <p> <strong>Order status:</strong> 
          <?php echo $result["order_status"]?> </p> 
          <form method="post" action="history.php">
          <!-- <button onclick="confirmation()">Take the order</button> -->
          <input name="<?php echo "button".$id_of_order; ?>" type="submit" value="Mark as completed">
          <!-- onclick="return confirm('Are you sure?')" -->
          </form>
          </td>
        </tr>
        </table>
        </form>
      </th>
    </table>
    </form>
    </div>
      
    <?php
  }
      $n = $n + 1;
    }   
    


$p = 1;


?>



<?php

while($result_1= mysqli_fetch_array($sth_2)){  
        


        $id_of_order = $result_1['order_id'];
        

        
       
        
        if (in_array($p, $column_1)){ 

          
        ?>

        <form  method="post" action="orders.php">
    <table class="group2">
      <th>
        <table class = "table4">
          <tr>
            <td>
              <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $result_1['client_image'] ).'" height="240" width="180"/> ';?>
            </td>
            <td>
          <p><strong>Name:</strong> 
          <?php echo $result_1["client_name"]; $name = $result_1["client_name"]?> </p> 
          <?php
          ?> 
          <p> <strong>From:</strong>  
          <?php echo $result_1["order_address_from"] ?> </p>
          <p> <strong>To:</strong> 
          <?php echo $result_1["order_address_to"]?> </p> 
          <p> <strong>Date:</strong> 
          <?php echo $result_1["order_date"]?> </p> 
          <p> <strong>Order status:</strong> 
          <div class="completed"><?php echo $result_1["order_status"]?></div></p>
          
          </td>
        </tr>
        </table>
      </th>
  <?php
  }
  if (in_array($p, $column_2)){
  ?> 
      <th>
        <table class = "table5">
          <tr>
            <td>
              <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $result_1['client_image'] ).'" height="240" width="180"/> ';?>
            </td>
            <td>
              <p><strong>Name:</strong> 
              <?php echo $result_1["client_name"]; $name = $result_1["client_name"]?> </p> 
              <?php
              ?> 
              <p> <strong>From:</strong>  
              <?php echo $result_1["order_address_from"] ?> </p>
              <p> <strong>To:</strong> 
              <?php echo $result_1["order_address_to"]?> </p> 
              <p> <strong>Date:</strong> 
              <?php echo $result_1["order_date"]?> </p> 
              <p> <strong>Order status:</strong> 
          <div class="completed"><?php echo $result_1["order_status"]?></div></p>
              
            </td>
          </tr>
        </table>
      </th>
      
      <?php
      }
      if (in_array($p, $column_3)){
      ?>
      
      <th>
        <table class = "table6">
          <tr>
            <td>
              <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $result_1['client_image'] ).'" height="240" width="180"/> ';?>
            </td>
            <td>
          <p><strong>Name:</strong> 
          <?php echo $result_1["client_name"]; $name = $result_1["client_name"]?> </p> 
          <?php
          ?> 
          <p> <strong>From:</strong>  
          <?php echo $result_1["order_address_from"] ?> </p>
          <p> <strong>To:</strong> 
          <?php echo $result_1["order_address_to"]?> </p> 
          <p> <strong>Date:</strong> 
          <?php echo $result_1["order_date"]?> </p> 
          <p> <strong>Order status:</strong> 
          <div class="completed"><?php echo $result_1["order_status"]?></div></p> 
          
          </td>
        </tr>
        </table>
        </form>
      </th>
    </table>
    </form>
      
    <?php
  }
      $p = $p + 1;
    }


?>

</body>
</html>