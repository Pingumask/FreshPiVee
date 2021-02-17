<?php
require_once("./model/pdo.php");
//La classe follow a besoin de savoir ce qu'est un User pour fonctionner car notre follower et notre followed sont des objets de cette classe.
require_once("./model/user.class.php");
class Follow {

    // Déclarations des attributs, les attributs publics correspondent aux champs dans la base de données.
    public $id_follow;
    public $id_follower;
    public $id_followed;
    //On crée en plus des attributs privés destinés à recevoir la version complete des utilisateurs correspondant à ces ids. Celà nous permet de ne charger leurs données completes que si l'on y fait appel via les méthodes getFollower et getFollowed que l'on va définir plus bas.
    private $follower;
    private $followed;

    // Déclarations des méthodes (les fonctions)

    //Voir le commentaire de la fonction similaire dans la classe User pour plus de détails, leur fonctionnement est le même
    public static function loadById(int $id_follow){
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM follow WHERE id_follow=:id_follow");
        $parametres = array(
            ':id_follow'=> $id_follow
        );
        $requete_preparee->execute($parametres);
        return $requete_preparee->fetchObject("Follow");
    }
    
    //Voir le commentaire de la fonction similaire dans la classe User pour plus de détails, leur fonctionnement est le même
    public function init(int $id_follow=null, int $id_follower = null, int $id_followed=null){
        $this->id_follow = $id_follow;
        $this->id_follower = $id_follower;
        $this->id_followed = $id_followed;
        return $this;
    }

    //On crée un "getter" pour récupérer la version complète du follower si on en a besoin
    public function getFollower():User{
        if($this->follower!=null){//Si notre follower n'est pas vide
            return $this->follower;//Ca veut dire qu'on a déjà fait appel à getFollower() et qu'on a déjà stocké ses informations, on peut donc le renvoyer directement
        }//Sinon, ça veut dire que notre follower est vide
        elseif($this->id_follower!=null){ //Si on connait l'id du follower
            $this->follower = User::loadById($this->id_follower); //On récupére le User qui correspond à l'id de notre follower et on stocke sa version complete dans l'attribut follower
            return $this->follower; //On renvoit ce follower à l'endroit où cette fonction a été appelée
        }
        else{//Sinon, ça veut dire qu'on ne connait rien du follower, même pas son id, on renvoit donc un utilisateur vide
            return new User();
        }
    }

    //Le fonctionnement de cette fonction est strictement identique à celui de la fonction getFollower pour l'attribut followed
    public function getFollowed():User{
        if($this->followed!=null){
            return $this->followed;
        }
        elseif($this->id_followed!=null){
            $this->followed = User::loadById($this->id_followed);
            return $this->followed; 
        }
        else{
            return new User();
        }
    }
}
