<?php
	session_start();
	
	if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
		$items = $_GET['ArtWorkID'];
		
		if(in_array($items, $_SESSION['cart'])) {
			$qty = $_SESSION['qty'][$items] + 1;
			$_SESSION['qty'][$items] = $qty;
			header('location: /ass/display-cart.php');
			
		} else {
			$items = $_GET['ArtWorkID'];
			$qty = 1;
			$_SESSION['cart'][$items] = $items;
			$_SESSION['qty'][$items] = $qty;
			header('location: /ass/display-cart.php');
		}
	}else{
		$items = $_GET['ArtWorkID'];
		$qty = 1;
		$_SESSION['cart'][$items] = $items;
		$_SESSION['qty'][$items] = $qty;
		$_SESSION['amount'][$items] = 0;
		header('location: /ass/display-cart.php');
	}
?>
