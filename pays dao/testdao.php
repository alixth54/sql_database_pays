<html>
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css"/>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css"/>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
	</head>
<body>
<pre>
<?php
/* inclusion de notre classe DAO */
require_once("dao.php");

// on crée une nouvelle instance */
$dao=new DAO();

//on se connecte
$dao->connexion();

//on récupère tous les pays et on les affiche
//print_r($dao->getCountries());
$col = 'ville,capitale,superficie';
    $value = 

$infoPays = ($dao->getCountries());
$jsonData = json_encode($infoPays);
print_r($jsonData);
// Puis, vous pouvez l'afficher dans votre script JavaScript
echo "<script>var myData = $jsonData;</script>";

//on affiche l'erreur éventuelle
if ($dao->getLastError()) print $dao->getLastError();




?>
</pre>
<table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Pays</th>
                <th>Capitale</th>
                <th>Superficie</th>
                <th>Population</th>
                <th>Taux natalité</th>
                <th>Taux mortalité</th>
				<th>Espérance de vie</th>
                <th>Taux mortalité infantile</th>
                <th>Nbre enfant par femme</th>
                <th>Taux croissance</th>
                <th>Population de +65ans</th>
            </tr>
        </thead>
        <tbody>
			<tr>
				<td></td>
			</tr>
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
