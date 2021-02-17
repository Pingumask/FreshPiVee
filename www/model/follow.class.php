<?php
require_once("./model/pdo.php");
require_once("./model/user.class.php");
class Follow {
    // Déclarations des données membres (les attributs)
    public $id_follow;
    public $id_follower;
    public $id_followed;
    private $follower;
    private $followed;

    // Déclarations des méthodes(les fonctions)
    public function getFollowFromDb(int $id_follow){
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM follow WHERE id_follow=:id_follow");
        $parametres = array(
            ':id_follow'=> $id_follow
        );
        $requete_preparee->execute($parametres);
        $resultat = $requete_preparee->fetchObject("Follow");
        foreach(get_object_vars($resultat) as $param=>$value){
            $this->$param = $value;
        }
    }
    
    public function setFollow($id_follow, $follower, $followed){
        $this->id_follow = $id_follow;
        $this->follower = $follower;
        $this->followed = $followed;
        
    }

    public function getFollower():User{
        if($this->follower!=null){
            return $this->follower;
        }
        elseif($this->id_follower!=null){
            //aller chercher l'uploader dans la base de données
            $this->follower = new User();
            $this->follower->getUserFromDb($this->id_follower);
            return $this->follower; 
        }
        else{
            return new User();
        }
    }

    public function getFollowed():User{
        if($this->followed!=null){
            return $this->followed;
        }
        elseif($this->id_followed!=null){
            //aller chercher l'uploader dans la base de données
            $this->followed = new User();
            $this->followed->getUserFromDb($this->id_followed);
            return $this->followed; 
        }
        else{
            return new User();
        }
    }
}
