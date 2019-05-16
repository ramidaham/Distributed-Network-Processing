<?php
	require_once('art-config.inc.php');
	include 'art-connection.inc.php';
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
				
				echo '<div class="media">';
				echo '<a class="pull-left" href="#">';
				echo '<img class="media-object" src="images/art/works/tiny/' .$r['Title']. ' .jpg" alt="..." width="32"></a>';
				echo '<div class="media-body">';
				echo '<p class="cartText"><a href="display-art-work.php?ArtWorkID=' .$r['ArtWorkID']. '">' .$r['Title']. '</a></p></div></div>';
			}
		} 
			
		if (!empty($_SESSION['amount'])) {
			foreach ($_SESSION['cart'] as $i) {
				$subtotal += $_SESSION['amount'][$i];
			}
		}
	}
?>


<div class="panel panel-primary">
	<div class="panel-heading">
		<h3 class="panel-title">Cart </h3>
	</div>
	<div class="panel-body">            
		<?php printCart($pdo, $subtotal);?>
		<strong class="cartText">Subtotal: <span class="text-warning"><?php echo $subtotal?></span></strong>
		<div>
		<button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-info-sign"></span> Edit</button>
		<button type="button" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-arrow-right"></span> Checkout</button>
		</div>
	</div>
</div>    