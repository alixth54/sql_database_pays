<?php

class DAO {
	/* Paramètres de connexion à la base de données 
	Dans l'idéal, il faudrait écrire les getters et setters correspondants pour pouvoir en modifier les valeurs
	au cas où notre serveur change
	*/
	
	private $host="127.0.0.1";
	private $user="root";
	private $password="";
	private $database="pays";
	private $charset="utf8";
	
	//instance courante de la connexion
	private $bdd;
	
	//stockage de l'erreur éventuelle du serveur mysql
	private $error;
	
	public function __construct() {
	
	}
	
	/* méthode de connexion à la base de donnée */
	public function connexion() {
		
		try
		{
			// On se connecte à MySQL
			$this->bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->database.';charset='.$this->charset, $this->user, $this->password);
		}
		catch(Exception $e)
		{
			// En cas d'erreur, on affiche un message et on arrête tout
				$this->error='Erreur : '.$e->getMessage();
		}
	}
	
	/* méthode qui renvoit tous les résultats sous forme de tableau de la requête passée en paramètre */
	public function getResults($query) {
		$results=array();
		
		$stmt = $this->bdd->query($query);
		
		if (!$stmt) {
			$this->error=$this->bdd->errorInfo();
			return false;
		} else {
			return $stmt->fetchAll();
		}
		
	}
	
	/* méthode qui renvoit tous les résultats sous forme de tableau
	*/
	public function getCountries($pays="") {
		$sql="SELECT libelle_continent, libelle_region,`libelle_pays`,`capitale`,`superficie`, `population_pays`, `taux_natalite_pays`, `taux_mortalite_pays`, `esperance_vie_pays`, `taux_mortalite_infantile_pays`, `nombre_enfants_par_femme_pays`, `taux_croissance_pays`, `population_plus_65_pays` FROM `t_pays` LEFT JOIN  t_regions ON(t_pays.region_id=t_regions.id_region)
		LEFT JOIN t_continents ON(t_continents.id_continent=t_regions.continent_id)";
if ($pays){
	if(is_numeric($pays)){
		$sql.="WHERE id_pays=".$pays;
	}else{
		$sql.="WHERE libelle_pays LIKE '".$pays."'";
	}
}
		return $this->getResults($sql);
	}
	
	public function getRegions($continent="") {
		$sql="SELECT `id_region`, `libelle_region`, `continent_id` FROM `t_regions`";
		if ($continent) {
			if (is_numeric($continent)) {
				$sql.=" WHERE continent_id=".$continent;
			} else {
				$sql.=" INNER JOIN t_continents ON (t_continents.id_continent=t_regions.continent_id) WHERE libelle_continent LIKE '".$continent."'";
			}
		}	
		return $this->getResults($sql);
		
	}
	
	/* méthode pour fermer la connexion à la base de données */
	public function disconnect() {
		$this->bdd=null;
	}
	
	/* méthode pour récupérer la dernière erreur fournie par le serveur mysql */
	public function getLastError() {
		
		return $this->error;
	}
	
}

?>
