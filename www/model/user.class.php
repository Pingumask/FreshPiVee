<?php
//On importe notre PDO pour avoir une connexion à la base de données
require_once("./model/pdo.php");
require_once("./model/databaseObject.interface.php");
class User implements databaseObject{
    // Déclarations publique des attributs qui définissent ce qu'est un User et qui correspondent à ses champs dans la bdd
    const SALT = "%'@jygFUT1646`[|~{#";
    public $id_user;
    public $nickname;
    public $email;
    private $password;
    public $birthday;
    private $signed_up;

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
    
    //La fonction create, nous servira de contructeur quand on veut créer un nouvel User hors de la base de données (pour inscrire un nouveau membre par exemple). On n'utilise pas directement __construct() car il interfere avec le fetchObject() que l'on utilise dans notre fonction loadById()
    public static function create(string $nickname = null, string $email = null, string $password = null, string $birthday = null){
        $newUser=new User();
        $newUser->id_user = null;
        $newUser->nickname = $nickname;
        $newUser->email = $email;        
        $newUser->birthday = $birthday;
        $newUser->signed_up = date("Y-m-d H:i:s");        
        $newUser->setPassword($password);
        return $newUser;      
    }

    public function getSignedUp():string{
        return $this->signedUp;
    }

    //On met le mot de passe en privé, pour obliger à le hasher quand on le modifie
    public function setPassword(string $newPassword):string{
        return $this->password = sha1(self::SALT.$newPassword.$this->signed_up);
    }

    public function getPassword():string{
        return $this->password;
    }
    
    public function save():void{
        //AVANT d'écrire dans la base de données on vérifie que les données à sauvegarder sont cohérentes
        //Si c'est cohérent, on update ou insert selon que ce soit un nouvel utilisateur ou pas
        //sinon, on refuse d'ecrire dans la base

        if($this->id_user!=null){
            //faire un UPDATE dans la base de données
            $requete_preparee=$GLOBALS['database']->prepare("UPDATE user SET `nickname`=:nickname, `email`=:email, `password`=:pwd, `birthday`=:birthday WHERE `id_user`=:id_user");
            $requete_preparee->execute([
                ":id_user"=>$this->id_user,
                ":nickname"=>$this->nickname,
                ":email"=>$this->email, 
                ":pwd"=>$this->password, 
                ":birthday"=>$this->birthday
            ]);            
        }
        else{
            //faire un INSERT dans la BDD
            $requete_preparee=$GLOBALS['database']->prepare("INSERT INTO user (`nickname`, `email`, `password`, `birthday`, `signed_up`) VALUES(:nickname, :email, :pwd, :birthday, :signed_up)");
            $reussite=$requete_preparee->execute([
                ":nickname"=>$this->nickname,
                ":email"=>$this->email, 
                ":pwd"=>$this->password, 
                ":birthday"=>$this->birthday, 
                ":signed_up"=>$this->signed_up
            ]);
            if($reussite===true){
                $this->id_user=$GLOBALS['database']->lastInsertId();
            }
        }
    }

    public function createValidUser(string $nickname, string $email, string $password, string $confirmPassword, string $birthday){
        $errors=array();
        if(!preg_match("/[\w]{8,}/",$nickname)){
            $errors[]="Nickname must be at least 8 characters long.";
        }
        if(!preg_match("/.{8,}/",$password)){
            $errors[]="Password must be at least 8 characters long.";
        }
        if(!preg_match("/[a-z]/",$password)){
            $errors[]="Password must contain a lowercase character.";
        }
        if(!preg_match("/[A-Z]/",$password)){
            $errors[]="Password must contain an Uppercase character.";
        }
        if(!preg_match("/[0-9]/",$password)){
            $errors[]="Password must contain a number.";
        }
        if(!preg_match("/\W/",$password)){
            $errors[]="Password must contain a special character.";
        }
        if($password!=$confirmPassword){
            $errors[]="Passwords must match.";
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ 
            $errors[]="Wrong email.";
        }        
        if(!preg_match("/[0-9]{4}\-[0-9]{2}\-[0-9]{2}/",$birthday)){
            $errors[]="Wrong date format for birthday";
        }
        if(count($errors)){
            return $errors;
        }
        return $this->create($nickname, $email, $password, $birthday);
    }
}