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

//on récupère tous les pays et on les affiche
//print_r($dao->getCountries());

if (isset($_GET["continent"])&&$_GET["continent"]) {
	$regions=$dao->getRegions($_GET["continent"]);
	$pays=array();
} else {
	$regions=$dao->getRegions();
	$pays=$dao->getMonde();
}



//on affiche l'erreur éventuelle
if ($dao->getLastError()) print $dao->getLastError();




?>

<form id="formfiltres">
<select id="selectcontinent" name="continent">
	<option value=""<?php if (isset($_GET["continent"])&&$_GET["continent"]=="") print " selected";?>>Monde</option>
	<?php foreach($dao->getContinents() as $row) { ?>
		<option value="<?=$row["id_continent"];?>"<?php if (isset($_GET["continent"])&&$_GET["continent"]==$row["id_continent"]) print " selected";?>><?=$row["libelle_continent"];?></option>
	<?php } ?>
</select>
<select id="selectregion" name="region">
	<?php foreach($regions as $row) { ?>
		<option value="<?=$row["id_region"];?>"><?=$row["libelle_region"];?></option>
	<?php } ?>
</select>
	
</form>

<table>
	<thead>
		<th>Nom</th>
		<th>Population</th>
		<th>Taux de natalité</th>
	</thead>
	<tbody>
		<?php foreach($pays as $row) { ?>
			<tr>
				<td><?=$row['libelle']?></td>
				<td><?=$row["pop"]?></td>
				<td><?=$row["tauxnat"]?></td>
			</tr>
		<?php } ?>
	</tbody>
</table>



<?php 
//on se déconnecte. TOUJOURS FERMER LA CONNEXION A LA BASE DE DONNEES
$dao->disconnect();
?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
