<?php
	$page = $_SERVER['PHP_SELF'];
	require_once('includes/art-config.inc.php');
	include 'includes/art-connection.inc.php';
	
	$artist_result = $pdo->query($artist);
	$artist_row = $artist_result->fetch();
	
	$artwork_result = $pdo->query($artwork);
	$artwork_row = $artwork_result->fetch();
	
	$art_result = $pdo->query($art);
	$art_row = $art_result->fetch();
	
	function outputGenres($art_row, $pdo) {
		$art_genre = 'select * from artworkgenres where Artworkid=' .$art_row['ArtWorkID'];
		$art_genre_result = $pdo->query($art_genre);
		while($art_genre_row = $art_genre_result->fetch()){
			outputGenre($art_genre_row, $pdo);
			echo ' - ';
		}
	}
	
	function outputGenre($art_genre_row, $pdo) {
		$genre = 'select * from genres where Genreid=' .$art_genre_row['GenreID'];
		$genre_result = $pdo->query($genre);
		$genre_row = $genre_result->fetch();
		
		echo '<a href="'.$genre_row['Link'].'">' .$genre_row['GenreName']. '</a>';
	}
	
	function outputSubjects($art_row, $pdo) {
		$art_subject = ' select * from artworksubjects where Artworkid=' .$art_row['ArtWorkID'];
		$art_subject_result = $pdo->query($art_subject);
		while($art_subject_row = $art_subject_result->fetch()){
			outputSubject($art_subject_row, $pdo);
			echo ' - ';
		}
	}
	
	function outputSubject($art_subject_row, $pdo) {
		$subject = 'select * from subjects where Subjectid=' .$art_subject_row['SubjectID'];
		$subject_result = $pdo->query($subject);
		$subject_row = $subject_result->fetch();
		
		echo '<a href="https://www.wikipedia.org/wiki/'.$subject_row['SubjectName'].'">' .$subject_row['SubjectName']. '</a>';
	}
	
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Assignment 3</title>

		<!-- Bootstrap core CSS  -->    
		<link href="bootstrap3_defaultTheme/dist/css/bootstrap.css" rel="stylesheet"> 
		<!-- Custom styles for this template -->
		<link href="bootstrap3_defaultTheme/theme.css" rel="stylesheet">
	</head>

	<body>

		<?php include 'includes/art-header.inc.php'; ?>

		<div class="container">
			<div class="row">

				<div class="col-md-10">
					<h2><?php echo $art_row['Title'] ?></h2>
					<p>By <?php echo $artist_row['FirstName']. ' ' .$artist_row['LastName'] ?><a href="display-artist.php?id=<?php echo $art_row['ArtistID'] ?>"></a></p>
					<div class="row">
						<div class="col-md-5">
							<img src="images/art/works/medium/<?php echo $art_row['ImageFileName']?>.jpg" class="img-thumbnail img-responsive" alt="<?php echo $art_row['Title'] ?>"/>
						</div>
						<div class="col-md-7">
							<p>
								<?php echo $art_row['Description']?>
							</p>
							<p class="price">$<?php printf("%4.2f", $art_row['MSRP']);?></p>
							<div class="btn-group btn-group-lg">
								<button type="button" class="btn btn-default">
									<a href="#"><span class="glyphicon glyphicon-gift"></span> Add to Wish List</a>  
								</button>
								<button type="button" class="btn btn-default">
									<a href="includes/addToCart.inc.php?ArtWorkID=<?php echo $art_row['ArtWorkID'] ?>"><span class="glyphicon glyphicon-shopping-cart"></span> Add to Shopping Cart</a>
								</button>
							</div>               
							<p>&nbsp;</p>
							<div class="panel panel-default">
								<div class="panel-heading"><h4>Product Details</h4></div>
								<table class="table">
									<tr>
										<th>Date:</th>
										<td><?php echo $art_row['YearOfWork']?></td>
									</tr>
									<tr>
										<th>Medium:</th>
										<td><?php echo $art_row['Medium']?></td>
									</tr>  
									<tr>
										<th>Dimensions:</th>
										<td><?php echo $art_row['Width']. ' cm X ' .$art_row['Height']. ' cm' ?></td>
									</tr> 
									<tr>
										<th>Home:</th>
										<td><a href="#"><?php echo $art_row['OriginalHome']?></a></td>
									</tr>  
									<tr>
										<th>Genres:</th>
										<td>
											<?php outputGenres($art_row, $pdo); ?>
										</td>
									</tr> 
									<tr>
										<th>Subjects:</th>
										<td>
											<?php outputSubjects($art_row, $pdo); ?>
										</td>
									</tr>     
								</table>
							</div>                              
					   
						</div>  <!-- end col-md-7 -->
					</div>  <!-- end row (product info) -->

		 
					<?php include 'includes/art-artist-works.inc.php'; ?>
							 
				</div>  <!-- end col-md-10 (main content) -->
			  
				<div class="col-md-2">   
					<?php include 'includes/art-shopping-cart.inc.php'; ?>
			  
					<?php include 'includes/art-right-nav.inc.php'; ?>
				</div> <!-- end col-md-2 (right navigation) -->           
			</div>  <!-- end main row --> 
		</div>  <!-- end container -->

		<?php include 'includes/art-footer.inc.php'; ?>


		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="bootstrap-3.0.0/assets/js/jquery.js"></script>
		<script src="bootstrap-3.0.0/dist/js/bootstrap.min.js"></script>    
	</body>
</html>
