<html>

<head>
	<meta charset="UTF-8">

</head>

<body>
	<?php


	/* inclusion de notre classe DAO */
	require_once("dao.php");

	// on crée une nouvelle instance */
	$dao = new DAO();

	//on se connecte
	$dao->connexion();
	if ($dao->getLastError()) print $dao->getLastError();


	$actor = $dao->getActor();

	// if(isset($_POST['actor'])&& ($_POST["actor"])){
	// 	$film = $dao->getMovies($_POST['actor']);

	// }else{
	// 	$film = $dao->getFilm();
	// }

	$genre = $dao->getGenre();
	$array = [];

	//si choix acteur seulement
	if (isset($_POST['actor']) && ($_POST["actor"])) {
		$film = $dao->getMovies($_POST['actor'], '');
	} else {
		$film = $dao->getFilm();
	}

	//si coix acteur + genre
	if (isset($_POST['actor']) && ($_POST["actor"]) && isset($_POST['genre']) && empty($array)) {
		$array = implode("','", $_POST['genre']);
		$film = $dao->getMovies($_POST['actor'], $array);
		
		if(empty($film)){

			echo ( $_POST['actor']." ne fait pas de film de genre :'".$array);
			
		}
	}

	// si choix genre seulement
	if (isset($_POST['genre']) && empty($array)) {
		$array = implode("','", $_POST['genre']);
		$film = $dao->getFilmByGenre($array);
	}



// pour regler erreur affichage checkbox a cause category_id
	$category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : 1;

	?>

	<form id="formfiltres" method="post">

		<?php foreach ($genre as $row) { ?>
			<input type="checkbox" id="type<?= $row[$category_id] ?>" name="genre[]" value="<?= $row['name'] ?>">
			<label for="type"><?= $row['name'] ?></label><br>
		<?php } ?>


		<input list="listSearch" type="search" id="searchActor" value="" name="actor" placeholder="nom et prenom acteur">
		<datalist id="listSearch" name='list'>
			<?php foreach ($actor as $row) { ?>
				<option id='option' value="<?= $row['last_name'] ?> <?= $row['first_name'] ?>"> <?= $row['last_name'] ?> <?= $row['first_name'] ?></option>
			<?php } ?>
		</datalist>

		<input type="submit" name="formSubmit" value="Filtrer" />

	</form>


	<table>
		<thead>

			<th>Film</th>
			<th>Acteur</th>
			<th>Description</th>
			<th>Genre</th>



<?php ?>

		</thead>
		<tbody>


			<?php foreach ($film as $row) { ?>

				<tr>
					<td><?= $row['title'] ?></td>
					<td><?= $row['last_name'] ?> <?= $row['first_name'] ?></td>
					<td><?= $row['description'] ?> </td>
					<td><?= $row['name'] ?></td>

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