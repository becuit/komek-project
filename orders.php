<?php 
session_start();

if (!$_SESSION['m_un']){
  header('Location: login.php');
  exit;
}

if (!$_SESSION['isClient'] == True) {

  

?>


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

<h1 class="nick">Welcome, <?php echo $_SESSION['m_un']?> !</h1>

<?php  
    $db = mysqli_connect("localhost","bolat","1234","komek"); 
    $sql = "select o.order_id, o.order_date, c.client_name, c.client_image, o.order_address_from, o.order_address_to, o.order_description, o.order_status from orders o join clients c on c.client_id = o.client_id where o.order_status = 'active'";
    $sth = $db->query($sql);
    $i = 0;
    $id_of_volunteer = $_SESSION['id'];
    $n = 1;
	  $column_1 = array(1,4,7,10,13,16,19);
	  $column_2 = array(2,5,8,11,14,17,20);
	  $column_3 = array(3,6,9,12,15,18,21);
    while($result= mysqli_fetch_array($sth)){  
        $id_of_order = $result['order_id'];
        for ( $i = 1; $i <= 30; $i++ ) {
        $button_name = "button" . $i;
        if ( isset( $_POST[$button_name] ) ) {
            $sql_query = "update orders set volunteer_id = '$id_of_volunteer', order_status = 'in progress' where order_id = '$i'";
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
        <form method="post" action="orders.php">
		<table>
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
          <p> <strong>Description:</strong> 
          <?php echo $result["order_description"]?> </p>
					<p> <strong>Order status:</strong> 
					<?php echo $result["order_status"]?> </p> 
					<form method="post" action="orders.php">
					<input name="<?php echo "button".$id_of_order; ?>" type="submit" value="Take the order">
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
              <p> <strong>Description:</strong> 
          <?php echo $result["order_description"]?> </p>
							<p> <strong>Order status:</strong> 
                
							<?php echo $result["order_status"]?> </p> 
							<form method="post" action="orders.php">
								<!-- <button onclick="confirmation()">Take the order</button> -->
								<input name="<?php echo "button".$id_of_order; ?>" type="submit" value="Take the order">
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
          <p> <strong>Description:</strong> 
          <?php echo $result["order_description"]?> </p> 
					<p> <strong>Order status:</strong> 
					
          <?php echo $result["order_status"]?> </p>
					<form method="post" action="orders.php">
					<!-- <button onclick="confirmation()">Take the order</button> -->
					<input name="<?php echo "button".$id_of_order; ?>" type="submit" value="Take the order">
					<!-- onclick="return confirm('Are you sure?')" -->
				  </form>
				  </td>
				</tr>
				</table>
        </form>
			</th>
    </table>
    </form>
			
    <?php
	}
      $n = $n + 1;
    }    
?>

<!-- <form method="post" action="orders.php"> -->
          <!-- <button onclick="confirmation()">Take the order</button> -->
          <!-- <input name="checking" type="submit" value="check"> -->
          <!-- onclick="return confirm('Are you sure?')" -->
          <!-- </form> -->
 <?php






?>

<!-- function confirm_delete(){
    if(confirm("Are you sure you want to delete this..?") === true){
        return true;
    }else{
        return false;
   }
 }

 <input type="button" Onclick="confirm_delete()"> -->

</body>
</html>

<!-- where o.order_status = 'active' (!$_SESSION['isClient'] == True)-->
<?php }

else  {

  ?>
  <html>


<head>
  <title>Application</title>
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

.description {
  width: 500px;
  height: 100px;
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

<h1 class="nick">Welcome, <?php echo $_SESSION['m_un']?> !</h1>

<div class="register">
<?php

$db = mysqli_connect("localhost","bolat","1234","komek");

                              

// $order_date = '2021-09-09';
// $client_id = 2;
// $volunteer_id_to_register = 0;
// $order_address_from = 'ddfdf';
// $order_address_to = 'dfdffd';
// $order_description = 'dfdfd';
// $order_status = 'active';
// $order_date = $_POST['order_date'];
// $client_id = $_SESSION['id'];
// $volunteer_id_to_register = 0;
// $order_address_from = $_POST['order_address_from'];
// $order_address_to = $_POST['order_address_to'];
// $order_description = $_POST['order_description'];
// $order_status = 'active';

// // $sql_query_4 = "insert into orders order_date, client_id, volunteer_id, order_address_from, order_address_to, order_description, order_status values $order_date, $client_id, $volunteer_id_to_register, $order_address_from, $order_address_to, $order_description, $order_status"; 
// if (isset($_POST['submition'])) {
//     $sql_query_4 = "insert into orders (order_date, client_id, volunteer_id, order_address_from, order_address_to, order_description, order_status) values ('$order_date', '$client_id', '$volunteer_id_to_register', '$order_address_from', '$order_address_to', '$order_description', '$order_status')";
//     $result_input = mysqli_query($db, $sql_query_4);
//     if ($result_input == True){
//      exit ('Your request was successfully accepted');
//     }
// }
?><div class="login-form">
  <form method="post" action="orders.php">
  <input type="date" name="order_date" placeholder="Date" required="date" /><br>
  <input type="text" name="order_address_from" placeholder="Order address from" required="order_address_from" /><br>
  <input type="text" name="order_address_to" placeholder="Order address to" required="order_address_to" /><br>
  <textarea name="Text1" cols="100" rows="5"  width="500px" height="300px" name="order_description" placeholder="Description (for example: From the first addres need to buy drugs and deliver to the second address where i am" required="description">for example: From the first addres need to buy drugs and deliver to the second address where i am </textarea><br>
  <input type="submit" name="submition" value="Submit"/>
  </form>
</div>
</div>

<?php 
$order_date = $_POST['order_date'];
$client_id = $_SESSION['id'];
$volunteer_id_to_register = 0;
$order_address_from = $_POST['order_address_from'];
$order_address_to = $_POST['order_address_to'];
$order_description = $_POST['order_description'];
$order_status = 'active';

if (isset($_POST['submition'])) {
    $sql_query_4 = "insert into orders (order_date, client_id, volunteer_id, order_address_from, order_address_to, order_description, order_status) values ('$order_date', '$client_id', '$volunteer_id_to_register', '$order_address_from', '$order_address_to', '$order_description', '$order_status')";
    $result_input = mysqli_query($db, $sql_query_4);
    if ($result_input == True){
     exit ('Your request was successfully accepted');
    }
}

?>
</body>
</html><?php




}?>

