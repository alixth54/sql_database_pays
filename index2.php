<?php
/* Connexion à une base MySQL avec l'invocation de pilote */
$dsn = 'mysql:dbname=pays;host=127.0.0.1';
$user = 'userAlix54';
$password = 'M5129lpq[d*JxEd)';

$dbh = new PDO($dsn, $user, $password);

$all='SELECT * FROM t_pays';
$continent= 'SELECT * FROM t_continents LEFT JOIN t_regions ON(t_continents.id_continent=t_regions.continent_id) GROUP BY libelle_continent ORDER BY libelle_continent';
$sql =  'SELECT * FROM t_pays ORDER BY libelle_pays';

if (isset($_POST["continent"])) {
    $continent_id = $_POST["continent"];
	$region = 'SELECT * FROM t_regions INNER JOIN t_continents ON(t_continents.id_continent=t_regions.continent_id)  WHERE continent_id=' . $continent_id ;

	$sql = 'SELECT * FROM t_pays LEFT JOIN t_continents ON(t_pays.continent_id=t_continents.id_continent) WHERE continent_id='. $continent_id .' ORDER BY libelle_pays';
    
}

// if (isset($_POST["region"])) {
//     $region_id = $_POST["region"];

// 	$sql = 'SELECT * FROM t_pays LEFT JOIN t_regions ON(t_pays.region_id=t_regions.id_region) WHERE region_id='. $region_id.' ORDER BY libelle_pays';
    
// }

?>


<!DOCTYPE html> 
<html lang="fr"> 
    <head>
        <meta charset="utf-8">
        <title>Liste des pays</title>
		<link href="style.css" rel="stylesheet">
    </head>
    <body> 
	<form id="selection" method="POST" action="">
		<label for="continent">
			<span>par continent</span>
			<select name="continent" onchange="this.form.submit()" >
			
					<option value=''>Monde</option>
					
				<?php foreach  ($dbh->query($continent) as $row) { ?>
					<option  value="<?php print $row['id_continent'];?>"><?php print $row['libelle_continent'];?></option>
				
				<?php } ?>
				
			</select><br>
			
			</label>
		<label>
			<span>par région</span>
			<select name="region" onchange="this.form.submit()">
			<option value=''>Toutes les régions</option>
			<?php if (isset($_POST["region"])) {?>
				<?php if ($_POST["region"]!=3) {?>
				<?php foreach  ($dbh->query($region) as $row) { ?>
					 <option value=<?php print $row['id_region'];?>><?php print $row['libelle_region'];?></option>
					<?php } ?>
				<?php } ?>
				<?php } ?>
			</select>
			
		</label>
		
	</form>
	

		<?php if (isset($_POST["continent"])) {?>
		
			
		
		<table>
		
			<thead>
				<th>Nom du pays</th>
				<th>Capitale</th>
				<th>Superficie</th>
				<th>Taux de natalité</th>
				<th>Population</th>
				
			</thead>
			<tbody>	
				<?php foreach  ($dbh->query($sql) as $row) { ?>
				<tr>
					<td><?php print $row['libelle_pays'];?>
					</td>
					<td><?php print $row['capitale'];?>
					</td>
					<td><?php print $row['superficie'];?>
					</td>
					<td><?php print $row['taux_natalite_pays'];?>
					</td>
					<td><?php print $row['population_pays'];?>
					</td>
				</tr>
				<?php } ?>
			</tbody>
			</table>
			<?php } ?>
			
	</body>
</html>