<?php
	$page = $_SERVER['PHP_SELF'];

	require_once('includes/art-config.inc.php');
	include 'includes/art-connection.inc.php';
?>

<!DOCTYPE html> 
<html lang="en">
	<head>
	   <meta charset="utf-8">
	   <meta name="viewport" content="width=device-width, initial-scale=1.0">
	   <title>Chapter 8</title>

	   <!-- Bootstrap core CSS -->
	   <link href="bootstrap3_defaultTheme/dist/css/bootstrap.css" rel="stylesheet">

	   <!-- Custom styles for this template -->
	   <link href="ArtStore.css" rel="stylesheet">

	   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	   <!--[if lt IE 9]>
	   <script src="bootstrap3_defaultTheme/assets/js/html5shiv.js"></script>
	   <script src="bootstrap3_defaultTheme/assets/js/respond.min.js"></script>
	   <![endif]-->
	</head>

	<?php 
		include("includes/art-header.inc.php"); 
		
		
		function clearList() {
			if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
				unset($_SESSION['qty']);
				unset($_SESSION['amount']);
				unset($_SESSION['cart']);
			}
		}
		
		if (isset($_GET['checkout'])) { clearList();}
		
		$subtotal = 0;
		function printCart($pdo, &$subtotal) {
			if(!empty($_SESSION['cart'])) {
				
				foreach ($_SESSION['cart'] as $i) {
					$sql = 'select * from artworks where artworkid=' .$i;
					
					$result = $pdo->query($sql);
					$r = $result->fetch();
					
					$qty = $_SESSION['qty'][$i];
					$price = $r['MSRP'];
					$amount = $qty * $price;
					$_SESSION['amount'][$i] = $amount;
					
					echo '<tr><td><img class="img-thumbnail" src="images/art/works/square-medium/'.$r['ImageFileName'].'.jpg" alt="..."></td>
							<td>'.$r['Title'].'</td>
							<td>' .$qty. '</td>
							<td>$'.number_format($price, 0). '</td>
							<td>$'.number_format($amount, 0).'</td></tr>';
				}
			} 
			
			if (!empty($_SESSION['amount'])) {
				foreach ($_SESSION['cart'] as $i) {
					$subtotal += $_SESSION['amount'][$i];
				}
			}
		}
	?>

	<body>
		<div class="container">

			<div class="page-header">
				<h2>View Cart</h2>
			</div>
			 
			<table class="table table-condensed">
				<tr>
					<th>Image</th>
					<th>Product</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Amount</th>
				</tr>
				
				<?php 
					printCart($pdo, $subtotal);
					 
					$tax = $subtotal * 0.10;
		
					if($subtotal > 2000){
						$shipping = 0;
					}else if ($subtotal > 0) {
						$shipping = 100;
					} else {
						$shipping = 0;
					}
		
					$grandtotal = $subtotal + $tax + $shipping;
				?>
				
				<tr class="success strong">
					<td colspan="4" class="moveRight">Subtotal</td>
					<td ><?php echo '$'.number_format($subtotal,0); ?></td>
				</tr>
				<tr class="active strong">
					<td colspan="4" class="moveRight">Tax</td>
					<td><?php echo '$'.number_format($tax,0); ?></td>
				</tr>  
				<tr class="strong">
					<td colspan="4" class="moveRight">Shipping</td>
					<td><?php echo '$'.number_format($shipping,0); ?></td>
				</tr> 
				<tr class="warning strong text-danger">
					<td colspan="4" class="moveRight">Grand Total</td>
					<td><?php echo '$'.number_format($grandtotal,0); ?></td>
				</tr>    
				<tr >
					<td colspan="4" class="moveRight"><button type="button" class="btn btn-primary" >Continue Shopping</button></td>
					<td><button type="button" class="btn btn-success" onClick='location.href="?checkout"'>Checkout</button></td>
				</tr>
			</table>         

		</div>  <!-- end container -->


		<?php include("includes/art-footer.inc.php"); ?>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
		<script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script>    
	</body>
</html>
