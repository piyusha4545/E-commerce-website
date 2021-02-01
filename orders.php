
<!DOCTYPE html>
<html>
<head>
  <title> Orders </title>
</head>

<body style="background-color:teal;">
<div>
<a href= "http://students.cse.unt.edu/~pt0217/phpMyAdmin/SE/mac.php"> 
<button style="font-size: 8pt; margin-top: 1px; margin-left: 2px; font-color:white" >Home</button>
</a>
</div>

<div id="center" align="left">
<br>
<img src="backpic1.jpg">
</div>
<!-- code for existing user to place an order or cancel it-->
<div style= "height:20em; width:60em"><br/>
<p style="color:white;">Existing user? Enter Id to place an order.</p>
<form action=" " method="post">
<input type="number" placeholder="Enter your ID" id = "Cid" name="Cid" required><br/><br/>
<button type="submit" name="submit_order" value ="submit order">submit order</button> &nbsp; &nbsp; 
<button type ="submit" name= "cancel_order" value="cancel order" >cancel order</button>
<br/> <br/><br/>
</form>
<!-- Database Connection code-->
<?php
	$dbConnection = mysqli_connect("student-db.cse.unt.edu","pt0217","pt0217","pt0217");
?>
<!-- php code to submit order -->
<?php
if(isset($_POST['submit_order']))
{
	$custidnum = $_POST['Cid'];
	$query_customer=mysqli_query($dbConnection, "SELECT * FROM customer WHERE custid='$custidnum'");
	$count=mysqli_num_rows($query_customer);
	$row= mysqli_fetch_assoc($query_customer);
	$addr =$row['address'];
	$zipcode = $row['zipcode'];
	if($count >0)
	{
		$query_orders = mysqli_query($dbConnection, "SELECT * FROM orders WHERE custid=1 AND status='cart'");
		$totalcost = 0.0;
		if($res = mysqli_fetch_array($query_orders))
		{
			$totalcost  = $totalcost + $res['totalcost'];
		}
		mysqli_query($dbConnection,"UPDATE orders SET custid = '$custidnum',totalcost='$totalcost',status='Placed' WHERE custid=1 AND status='cart'");
		
	}
	// order summary details
	echo "Your Order has been Placed with userID:".$custidnum."with a total cost of ".$totalcost."and will be delivered to the users address".$addr.",".$zipcode;
}
// Cancel order code
else if($_POST['cancel_order']){
	mysqli_query($dbConnection,"DELETE FROM orders WHERE custid=1 AND status='cart'");
	echo "Order cancelled successfuly.";
}
?>
<!-- code for registering new user and allow to place/ cancel an order -->
<p style="color:white;">New user? Sign up by entering your details.</p>
<br/> 
<form method="post">
<input type="text" placeholder="Name" id= "name" name="name" required><br/><br/>
<input type="text" placeholder="address" id="address" name="address" required><br/><br/>
<input type="number" placeholder="Phone number" id="phone" name="phone" required><br/><br/>
<input type="number" placeholder="Enter Zip code" id="zipcode" name="zipcode" required><br/> <br /><br/>
<a ><button type="submit" name ="submit_details">Register and Place order</button> <button type="submit" name="cancel_order">cancel order</button>
</form>
</div>
<?php
//php code to insert the customer details into the table
if( isset($_POST['submit_details']) )
{
	$cname = $_POST['name'];
	$addr = $_POST['address'];
	$phno = $_POST['phone'];
	$zip = $_POST['zipcode'];
	mysqli_query($dbConnection , "INSERT INTO customer(name, address, `phone number`, zipcode) VALUES('$cname','$addr', '$phno' ,'$zip')");
	$id= $dbConnection->insert_id;
	$query_orders=mysqli_query($dbConnection, "SELECT * FROM orders WHERE custid=1 AND status='cart'");
	$totalcost =0.0;
	//calculating the total cost
	while($res =mysqli_fetch_array($query_orders))
	{
		$totalcost  = $totalcost + $res['totalcost'];
	}
mysqli_query($dbConnection , "UPDATE orders SET custid='$id',totalcost = '$totalcost',status='Placed' WHERE custid = 1 AND status='cart'");
	echo "<br><br><br>";
	//order summary details
echo "Your Order has been Placed with userID:".$id."with a total cost of ".$totalcost."and will be delivered to ".$addr.",".$zip;

}
//php code to cancel the order
else if($_POST['cancel_order']){
	mysqli_query($dbConnection,"DELETE FROM orders WHERE custid=1 AND status='cart'");
	echo "<br><br><br>";
	echo "Order cancelled successfuly.";
}
?>


</body>
</html>