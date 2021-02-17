<?php
//On importe notre PDO pour avoir une connexion à la base de données
require_once("./model/pdo.php");
class User {
    // Déclarations publique des attributs qui définissent ce qu'est un User et qui correspondent à ses champs dans la bdd
     public $id_user;
     public $nickname;
     public $email;
     public $password;
     public $birthday;
     public $signed_up;

    // Déclarations des méthodes de la classe User (les fonctions internes à la classe)

    //La fonction loadById sert à récupérer un utilisateur dans la base de données et à le renvoyer sous la forme d'un objet User PHP, le mot clef static signifie que cette fonction se comportera de la même façon, que que soit le user qui l'appelle, il n'est donc pas possible d'utiliser $this dans cette fonction, mais celà permet en contrepartie d'appeler directement User::loadById() sans avoir créé un User avant.
    public static function loadById(int $id_user):User{
        //On commence par préparer la base de données à recevoir une requete avec un marqueur qui lui indique quelle partie de la requete doit recevoir une variable
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM user WHERE id_user=:id_user");
        //on execute la requete préparée précédement en lui donnant sous forme d'un array les valeurs qui doivent remplacer les marqueurs
        $requete_preparee->execute([':id_user'=> $id_user]);
        //On transforme la réponse de la BDD en un objet de la classe User et on le renvoit comme résultat de la fonction
        return $requete_preparee->fetchObject("User");
        //On pourra donc dans le controleur récupérer toutes les infos d'un utilisateur depuis la base de données en utilisant la fonction `$mon_utilisateur = User::loadById($id_user);`
    }
    
    //La fonction init, nous servira de contructeur quand on veut créer un nouvel User hors de la base de données (pour inscrire un nouveau membre par exemple). On n'utilise pas directement __construct() car il interfere avec le fetchObject() que l'on utilise dans notre fonction loadById()
    public function init(int $id_user = null, string $nickname = null, string $email = null, string $password = null, string $birthday = null, string $signed_up = null){
        $this->id_user = $id_user;
        $this->nickname = $nickname;
        $this->email = $email;
        $this->password = $password;
        $this->birthday = $birthday;
        $this->signed_up = $signed_up;
        return $this;
    }
}