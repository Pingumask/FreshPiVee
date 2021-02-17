<?php

require_once("./model/pdo.php");
class User {
    // Déclarations des données membres (les attributs)
     public $id_user;
     public $nickname;
     public $email;
     public $password;
     public $birthday;
     public $signed_up;

    // Déclarations des méthodes(les fonctions)
    public function getUserFromDb(int $id_user){
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM user WHERE id_user=:id_user");
        $parametres = array(
            ':id_user'=> $id_user
        );
        $requete_preparee->execute($parametres);
        $resultat = $requete_preparee->fetch();
        $this->setUser($resultat['id_user'],$resultat['nickname'],$resultat['email'],$resultat['password'],$resultat['birthday'],$resultat['signed_up']);
    }
    
    public function setUser($id_user, $nickname, $email, $password, $birthday, $signed_up){
        $this->id_user = $id_user;
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
        $this->birthday = $birthday;
        $this->signed_up = $signed_up;
    }

}
?>