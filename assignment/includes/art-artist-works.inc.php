<?php 
	function outputPaintings($artwork, $pdo) {
			
		$result = $pdo->query($artwork);
		
		while ($row = $result->fetch()) {
			outputSinglePainting($row);          
		}
	}
	
	function outputSinglePainting($row) {
		echo '<div class="col-md-3">';
		echo '<div class="thumbnail">';
		
		echo '<img class="img-thumbnail img-responsive" src="images/art/works/square-medium/' . $row['ImageFileName'] .'.jpg">';
		
		echo '<div class="caption">';
		echo '<a class="btn btn-primary btn-xs" href="display-art-work.php?ArtWorkID='.$row['ArtWorkID'].'"><span class="glyphicon glyphicon-info-sign"></span> View</a>';
		echo '<button type="button" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-gift"></span> Wish</button>';
		echo '<button type="button" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-shopping-cart"></span>';
		echo '<a href= "includes/addToCart.inc.php?ArtWorkID=' .$row['ArtWorkID']. '">Cart</a></button>';
		
		echo '</div>';
		echo '</div>';
		echo '</div>';
	}
?>

<h3>Art by <?php echo $artist_row['FirstName']. ' ' .$artist_row['LastName'] ?></h3>  

<div class="row">
	<?php outputPaintings($artwork, $pdo); ?>
</div>  <!-- end artist's works row -->