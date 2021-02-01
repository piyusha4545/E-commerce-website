<!-- Database connection code -->
<?php
	$dbConnection = mysqli_connect("student-db.cse.unt.edu","pt0217","pt0217","pt0217");
	if(mysqli_connect_errno()){
		echo "DB error".mysqli_connect_error();
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title> Mac </title>
</head>

<body style="background-color:teal;">
<div id="center" align="left">
  <form action="" method="post">
<br>

<img src="backpic1.jpg">
<!-- Display of the products using table and form elements which are added to cart -->
<table>
<tr>
<td>
<!-- product 1 details -->
<form method="post">
	<div><img style=margin-right:5em src="pro1.jpg" height="250em" ></div>
	<div><font color="white"><input name="productname" value=" Studio Fix Foundation" readonly></input></font></div>
	<div><font color="white">Select Quantity:</font><input type="number" min="0" max="100" name="productQuant" id="product1" style="margin-right:12em" required></input></div>
	<div><font color="white">Select Size:</font><select style="margin-right:16em" name="producttype"><option value="mini">Mini</option><option value="Full">Full</option></select>
	<font color="white" style="margin-right:17em" >$32 </font><input type="hidden"name="price" value="32"></input></div>
	<button class = "submit" type="submit" name="cart" style="margin-right:19em">Add to cart</button>
</form>
</td>
<td>
<!-- product 2 details -->
<form method="post">
	<div><img style=margin-right:5em src="pro2.jpg" height="250em" ></div>
	<div><font color="white"><input name="productname" value="mascara" readonly></input></font></div>
	<div><font color="white">Select Quantity:</font><input type="number" min="0" max="100" name="productQuant" id="product2" style="margin-right:12em"></div>
	<div><font color="white">Select Size:</font><select style="margin-right:15em" name="producttype"><option  value="mini">Mini</option><option value="Full">Full</option></select>
	<font color="white" style="margin-right:17em">$25</font><input type="hidden" name="price" value="25"></input></div>
	<button class = "submit" type="submit" name ="cart" style="margin-right:19em">Add to cart</button>
</form>
</td>
<td>
<!-- product 3 details -->
<form method="post">
	<div><img src="pro3.jpg" height="250em" style="opacity:1"></div>
	<div><font color="white"><input name="productname" value="Matte Lipstick" readonly></input>
	</font></div>
	<div><font color="white">Select Quantity:</font><input type="number" min="0" max="100" name="productQuant" id="product3" style="margin-right:12em"></div>
	<div><font color="white">Select Size:</font><select name="producttype"><option  value="mini">Mini</option><option value="Full">Full</option></select>
	<font color="white" >$18</font><input name="price" type="hidden" value="18"></input></div>
	<button class = "submit" type="submit" name ="cart">Add to cart</button>
</form>
</td>
</tr>
</table>
<!-- php code to insert the products which are added to cart into the table -->
<?php
if(isset($_POST['cart']))
{
	$proname=$_POST['productname'];
	$size = $_POST['producttype'];
	$quantity = $_POST['productQuant'];
	$price = $_POST['price'];
	$date = date("y-m-d H:i:s");
	//calculating the total cost
	$finalprice = $quantity *($price + $price/100*8.25);
	mysqli_query($dbConnection, "INSERT INTO orders( custid, proname, size, quantity, price, date, totalcost) values (1,'$proname','$size','$quantity','$price', '$date', '$finalprice')");
	
}
?>

</form>
<br>
<br>


<span>
<form action="orders.php" method="post">
<button class="button" type="submit">Place my order</button>&nbsp; &nbsp;
<button class = "button"  type="reset"> Reset</button></form>
</span>

</div>
</body>
</html>