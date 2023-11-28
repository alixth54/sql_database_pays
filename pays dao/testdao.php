<html>
	<head>
		<meta charset="UTF-8">
	</head>
<body>
<pre>
<?php
/* inclusion de notre classe DAO */
require_once("dao.php");

// on crée une nouvelle instance */
$dao=new DAO();

//on se connecte
$dao->connexion();//on appelle les fonction creer en dao et on verifie par rapport au get dans le formulaire pour afficher le resultat

if (isset($_GET["continent"])&&$_GET["continent"]) {//$_GET["continent"] veut dire le get n'est pas vide
	$regions=$dao->getRegions($_GET["continent"]);
	$pays=$dao->getCountries("continent",$_GET["continent"]);
}else {
	$regions=$dao->getRegions();
	$pays=$dao->getMonde();
 
}
if (isset($_GET["region"])&&$_GET["region"]){
    $pays=$dao->getCountries("region",$_GET["region"]);
    
}



//on affiche l'erreur éventuelle
if ($dao->getLastError()) print $dao->getLastError();



?>
</pre>
<!-- pas d'action donc de base lié à la meme page et pas de methode donc de base = get -->
<form id="formfiltres">
<select id="selectcontinent" name="continent"><!-- isset retourne true si une variable est definie ou non null-->
<!-- pour monde value est vide car pas lié a id continent ou autre et pour que l'element selectionné reste dans la barre selection on fait
get["continent"]= name du select
-->
	<option value="" <?php if (isset($_GET["continent"])&&$_GET["continent"]=="") print " selected";?>>Monde</option>
	<?php foreach($dao->getContinents() as $row) { ?>
        <!-- ?php print $row['id_region'];? raccourci 
             ?=$row["id_continent"];? -->
		<option value="<?=$row["id_continent"];?>" <?php if (isset($_GET["continent"])&&$_GET["continent"]==$row["id_continent"]) print " selected";?>><?=$row["libelle_continent"];?></option>
	<?php } ?>
</select>

<?php if($_GET["continent"]!=="3" && $_GET["continent"]!=""){ ?>
<select id="selectregion" name="region">
<option value="" <?php if (isset($_GET["region"]) && $_GET["region"]=="") print " selected";?>>Toutes les régions</option>
	<?php foreach($regions as $row) { ?>
		<option value="<?=$row["id_region"];?>"<?php if (isset($_GET["region"])&&$_GET["region"]==$row["id_region"]) print " selected";?>><?=$row["libelle"];?></option>
	<?php } ?>
    
</select>
<?php }?>
	
</form>
<table >
        <thead>
            <tr>
                <th>Pays</th>
                <th>Population</th>
                <th>Taux natalité</th>
                <th>Taux mortalité</th>
				<th>Espérance de vie</th>
                <th>Taux mortalité infantile</th>
                <th>Nbre enfant par femme</th>
                <th>Taux croissance</th>
                <th>Population de +65ans</th>
                <?php if (isset($_GET["continent"])&&$_GET["continent"]) {?>
                <th>Capitale</th>
                <th>Superficie</th>
                <?php } ?>
            </tr>
        </thead>
        <tbody>
        
            <?php foreach($pays as $row) { ?>
			<tr>
				<td><?=$row['libelle']?></td>
				<td><?=$row['pop']?></td>
				<td><?=$row['tauxnat']?></td>
                <td><?=$row['tauxmort']?></td>
				<td><?=$row["esper"]?></td>
				<td><?=$row["tauxmortinf"]?></td>
                <td><?=$row['enf']?></td>
				<td><?=$row["tauxcroi"]?></td>
				<td><?=$row["+65"]?></td>
                <?php if (isset($_GET["continent"])&&$_GET["continent"]) {?>
                <td><?=$row['capitale']?></td>
				<td><?=$row['superficie']?></td>
				<?php } ?>
			</tr>
		<?php } ?>
		</tbody>
        <!-- <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </tfoot> -->
    </table>
<?php 
    //on se déconnecte. TOUJOURS FERMER LA CONNEXION A LA BASE DE DONNEES
    $dao->disconnect();
?>
	<script type="text/javascript" src="Main.js"></script>
</body>
</html>
