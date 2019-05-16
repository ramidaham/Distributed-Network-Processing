 <?php 
	try {
		$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
		die( $e->getMessage() );
	}
	
	if (isset($_GET['id']) && $_GET['id'] > 0) {
		
		$artist = 'select * from Artists where Artistid=' .$_GET['id'];
		$artwork = 'select * from Artworks where Artistid=' .$_GET['id'];
		$art = 'select * from Artworks where Artistid=' .$_GET['id'];
		
	} else if (isset($_GET['ArtWorkID']) && $_GET['ArtWorkID'] > 0) {
		
		$art = 'select * from Artworks where ArtWorkID=' .$_GET['ArtWorkID'];
		$art_result = $pdo->query($art);
		$art_row = $art_result->fetch();
		
		$artist = 'select * from Artists where Artistid=' .$art_row['ArtistID'];
		$artwork = 'select * from Artworks where Artistid=' .$art_row['ArtistID'];
		
	}	else {
		
		$art = 'select * from Artworks where ArtWorkID=1';
		$artist = 'select * from Artists where Artistid=1';
		$artwork = 'select * from Artworks where Artistid=1';
		
	}
?>