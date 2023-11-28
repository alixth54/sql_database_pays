<html>
	<head>
		<meta charset="UTF-8">
		
	</head>
<body>
<?php


/* inclusion de notre classe DAO */
require_once("dao.php");

// on crée une nouvelle instance */
$dao=new DAO();

//on se connecte
$dao->connexion();
if ($dao->getLastError()) print $dao->getLastError();


$actor=$dao->getActor();

// if(isset($_POST['actor'])&& ($_POST["actor"])){
// 	$film = $dao->getMovies($_POST['actor']);
	
// }else{
// 	$film = $dao->getFilm();
// }

$genre=$dao->getGenre();

if(isset($_POST['actor']) && ($_POST["actor"])==''){
	$film = $dao->getFilm();

}else{$film = $dao->getMovies($_POST['actor']);}
$array=[];

if (isset($_POST['genre']) && empty($array)){
	$array=implode("','",$_POST['genre']);
	
		$film = $dao->getFilmByGenre($array);
		
}

	


?>

<form id="formfiltres" method="post" >
	
	<?php foreach($genre as $row) { ?>
	<input type="checkbox" id="genre<?=$row['category_id']?>" name="genre[]" value="<?=$row['name']?>">
<label for="genre<?=$row['category_id']?>"><?=$row['name']?></label><br>
<?php } ?>
<input type="submit" name="formSubmit" value="Filtrer" />

    <input list="listSearch" type="search" id="searchActor" value="" name="actor"  placeholder="nom et prenom acteur">
		<datalist id="listSearch" name='list'>
			<?php foreach($actor as $row) { ?>
				<option id='option' value="<?=$row['last_name']?> <?=$row['first_name']?>"> <?=$row['last_name']?> <?=$row['first_name']?></option>
			<?php } ?>
		</datalist>
	
	
	
</form>


<table>
	<thead>
        
		<th>Film</th>
		<?php if(isset($_POST['actor']) && ($_POST["actor"])) { ?>
			<th>Acteur</th>
				<?php }  ?>

				<?php if(isset($_POST['genre']) && !empty($array)) { ?>
					<th>Genre</th>
				<?php }  ?>
		
		


	</thead>
	<tbody>
		
        
        <?php foreach($film as $row) { ?>
			
			<tr>
				<td><?=$row['title']?></td>
				<?php if(isset($_POST['actor']) && ($_POST["actor"])) { ?>
				<td><?=$row['last_name']?> <?=$row['first_name']?></td>
				<?php }  ?>

				<?php if(isset($_POST['genre']) && !empty($array)) { ?>
				<td><?=$row['name']?></td>
				<?php }  ?>
			</tr>
		<?php }  ?>
		
	</tbody>
</table>



<?php 
//on se déconnecte. TOUJOURS FERMER LA CONNEXION A LA BASE DE DONNEES
$dao->disconnect();
?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
