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
$film = $dao->getFilm();
?>

<form id="formfiltres" method="post" >
    <input list="listSearch" type="search" id="searchActor" value="" name="actor" onchange="this.form.submit()" placeholder="nom et prenom acteur">
    
    <datalist id="listSearch" name='list'>
        <?php foreach($actor as $row) { ?>
            <option value="<?=$row['first_name']?> <?=$row['last_name']?>"><?=$row['first_name']?> <?=$row['last_name']?></option>
        <?php } ?>
    </datalist>
   
       
       

</select>
	
</form>


<table>
	<thead>
        
		<th>Film</th>
	</thead>
	<tbody>
		
        <!-- ?php if(isset($_POST['actor'])== isset($_POST['list'])) {?> -->
        <?php foreach($film as $row) { ?>
			<tr>
				<td><?=$row['title']?></td>
				<td></td>
				<td></td>
			</tr>
		<?php }  ?>
        <!-- ?php }  ?> -->
	</tbody>
</table>



<?php 
//on se déconnecte. TOUJOURS FERMER LA CONNEXION A LA BASE DE DONNEES
$dao->disconnect();
?>
<script type="text/javascript" src="script.js"></script>
</body>
</html>
