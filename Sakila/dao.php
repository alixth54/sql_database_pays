<?php
// creation d'une class comme en javascript.
class DAO {
	/* Paramètres de connexion à la base de données 
	Dans l'idéal, il faudrait écrire les getters et setters correspondants pour pouvoir en modifier les valeurs
	au cas où notre serveur change
	*/
	
	// info accessible seulement dans la class DAO. si on souhaite y acceder en dehors, il faut faire un getter
	private $host="127.0.0.1";
	private $user="root";
	private $password="";
	private $database="sakila";
	private $charset="utf8";
	
	//declaration de variables
	//instance courante de la connexion
	private $bdd;
	
	//stockage de l'erreur éventuelle du serveur mysql
	private $error;
	
	//constructor comme pour js dans ce context pas besoin de mettre d'info dedans. alias les this.quelquechose
	public function __construct() {
	
	}
	
	//création d'une fonction pour se connecter à a base de donnée sql
	/* méthode de connexion à la base de donnée */
	public function connexion() {
		//pour recuperer les erreur de connection et eviter l'affichage a l'utilisateur d'information qui ne le concerne pas on fait un try, throw catch/ on met autant de catch que de throw
		try
		{
			// On se connecte à MySQL
			//equivalent js = this.bdd= reprise info PDO pour se connecter a sql
			$this->bdd = new PDO('mysql:host='.$this->host.';dbname='.$this->database.';charset='.$this->charset, $this->user, $this->password);
		}
		//si la connection ne se fait pas, le message d'erreur est enregistré dans la variable error. 
		catch(Exception $e)//ecriture de base exception $e veut dire si exception est trouvé il enclenche le catch concerné soit this.error = 'message :' . variable info collectée renvoyé dans fonction message
		{
			// En cas d'erreur, on affiche un message et on arrête tout
				$this->error='Erreur : '.$e->getMessage();//retourne la descritpion d'une erreur causée par une exception throw
		}
	}
	
	//on va interroger la bdd pour recuperer info de la base de donnée. et lors de chaque besoin pour fonction ulterieur on appelle cette fonction simplement pour avoir l'info
	public function getResults($query) {
		
		//bdd est la connection a la base de donnée sur laquelle je fais fonction query qui prepare et execute une requete sql
		$stmt = $this->bdd->query($query);
		// j'interroge la base de donnée et stocke info dans stmt
		if (!$stmt) {
			$this->error=$this->bdd->errorInfo();// retourne les informations associées à l'erreur lors d'une requete sql
			return false;
		} else {
			return $stmt->fetchAll(); //retourne le resultat en row sous forme de tableau associatif
		}
		
	}
	
	/* méthode qui renvoit tous les résultats sous forme de tableau
	*/
	public function getActor() {
		$sql="SELECT * FROM actor INNER JOIN film_actor ON (film_actor.actor_id=actor.actor_id) GROUP BY last_name,first_name ";

		return $this->getResults($sql);
	}
	
	public function getFilm() {
		$sql="SELECT * FROM film INNER JOIN film_actor ON (film_actor.film_id=film.film_id) GROUP BY title";
		return $this->getResults($sql);
	}
    
	public function getMovies($selection) {
		$sql="SELECT * FROM film INNER JOIN film_actor ON (film_actor.film_id=film.film_id)";
		if ($selection) {
			
			if(strpos($selection,' ')==true)
			{
				$t=explode(" ",$selection);
				$sql.=" INNER JOIN actor ON (actor.actor_id=film_actor.actor_id) WHERE last_name LIKE '".$t[0]."' AND first_name LIKE '".$t[1]."%' OR last_name LIKE '".$t[1]."%' AND first_name LIKE '".$t[0]."' GROUP BY title ";
				
			}else{
				$sql.=" INNER JOIN actor ON (actor.actor_id=film_actor.actor_id) WHERE last_name LIKE '".$selection."%' OR first_name LIKE '".$selection."%' GROUP BY title, last_name, first_name ORDER BY last_name, first_name ASC";
				
			}
			
		}
		
		return $this->getResults($sql);
	}

	public function getGenre() {
		
			$sql="SELECT * FROM film INNER JOIN film_category ON(film.film_id=film_category.film_id)
INNER JOIN category ON(category.category_id=film_category.category_id) GROUP BY name";
			
		
		return $this->getResults($sql);
	}

	public function getFilmByGenre($choix) {
		$sql="SELECT * FROM film INNER JOIN film_category ON(film.film_id=film_category.film_id)
		INNER JOIN category ON(category.category_id=film_category.category_id)
		WHERE name IN ('".$choix."') GROUP BY title;";
			
		
		
	
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