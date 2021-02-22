<?php
require_once("./model/pdo.php");
require_once("./model/databaseObject.interface.php");
require_once("./model/user.class.php");
class Follow implements databaseObject{
    public ?int $id_follow=null;
    public ?int $id_follower=null;//L'id du User qui effectue le Follow
    public ?int $id_followed=null;//L'id du User qui reçoit le Follow

    private ?User $follower=null;//Les informations complètes du User qui effectue le Follow
    private ?User $followed=null;//Les informations complètes du User qui reçoit le Follow

    /**
     * Récupère dans la base de données le Follow correspondant à l'id demandé
     * 
     * @param int $id_follow L'id de l'objet à aller chercher dans la base de données 
     * @return Follow
     */
    public static function loadById(int $id_follow):Follow{
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM follow WHERE id_follow=:id_follow");
        $parametres = array(
            ':id_follow'=> $id_follow
        );
        $requete_preparee->execute($parametres);
        if ($follow = $requete_preparee->fetchObject("Follow")){
            return $follow;
        }
        return new Follow;
    }
    
    /**
     * Crée un nouveau Follow en renseignant toutes ses informations
     * 
     * @param int $id_follower L'id du User qui effectue le follow
     * @param int $id_followed L'id du User qui recoit le follow
     * 
     * @return Follow
     */
    public static function create(int $id_follower, int $id_followed):Follow{
        $newFollow = new Follow();
        $newFollow->id_follower = $id_follower;
        $newFollow->id_followed = $id_followed;
        return $newFollow;
    }

    /**
     * Récupère les informations complètes du User qui effectue le follow
     * 
     * @return User
     */
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

    /**
     * Récupère les informations complètes du User qui recoit le follow
     * 
     * @return User
     */
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

    /**
     * Enregistre en base de données ce Follow
     * 
     * Crée un nouveau Follow si $id_follow est null
     * Met à jour le Follow correspondant si $id_follow n'est pas null
     * 
     * @return void
     */
    public function save():void{
        if($this->id_follow!=null){
            //faire un UPDATE dans la base de données
            $requete_preparee=$GLOBALS['database']->prepare("UPDATE follow SET `id_follower`=:id_follower, `id_followed`=:id_followed WHERE `id_follow`=:id_follow");
            $requete_preparee->execute([
                ":id_follow"=>$this->id_follow, 
                ":id_follower"=>$this->id_follower, 
                ":id_followed"=>$this->id_followed, 
            ]);
        }
        else{
            //faire un INSERT dans la BDD
            $requete_preparee=$GLOBALS['database']->prepare("INSERT INTO follow (`id_follower`, `id_followed`) VALUES(:id_follower, :id_followed)");
            $reussite=$requete_preparee->execute([ 
                ":id_follower"=>$this->id_follower, 
                ":id_followed"=>$this->id_followed, 
            ]);
            if($reussite===true){
                $this->id_follow=$GLOBALS['database']->lastInsertId();
            }
        }
    }
}
