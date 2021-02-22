<?php
//On importe notre PDO pour avoir une connexion à la base de données
require_once("./model/pdo.php");
require_once("./model/databaseObject.interface.php");
class User implements databaseObject{
    const SALT = "%'@jygFUT1646`[|~{#";//Le sel qui sera utilisé pour le Hash de nos mots de passe
    public ?int $id_user=null;
    public string $nickname="";//Le pseudo du User
    public string $email="";//Le courriel du User
    private string $password="";//Le mot de passe du User
    public string $birthday="";//La date de naissance du User
    private string $signed_up="";//L'heure d'inscription du User, elle est private pour interdire sa modification car elle servira de poivre dans le hash de nos mots de passe

    /**
     * Récupère un User dans la base de données en fonction de son id
     * 
     * @param int $id_user l'identifiant du User que l'on souhaite récupérer
     * 
     * @return User
     */
    public static function loadById(int $id_user):User{
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM user WHERE id_user=:id_user");
        //On commence par préparer la base de données à recevoir une requete avec un marqueur qui lui indique quelle partie de la requete doit recevoir une variable        
        $requete_preparee->execute([':id_user'=> $id_user]);//on execute la requete préparée précédement en lui donnant sous forme d'un array les valeurs qui doivent remplacer les marqueurs
        if ($user = $requete_preparee->fetchObject("User")){
            return $user;//On transforme la réponse de la BDD en un objet de la classe User et on le renvoit comme résultat de la fonction
        }   
        return new User();   
    }
    
    /**
     * Crée un nouveau User tout en renseignant toutes ses infos
     * 
     * La date d'inscription est créée automatiquement par cette fonction
     * Le mot de passe donné à cette fonction n'est pas encore hashé, c'est elle qui s'en charge après avoir généré la date d'inscription car celle-ci doit servir de poivre
     * 
     * @param string $nickname Le pseudo du User
     * @param string $email L'adresse courriel du User
     * @param string $password Le mot de passe pas encore hashé du user
     * @param string $birthday La date de naissance du user
     * 
     * @return User Le user qui vient d'être créé
     */
    public static function create(string $nickname, string $email, string $password, string $birthday){
        $newUser=new User();
        $newUser->nickname = $nickname;
        $newUser->email = $email;        
        $newUser->birthday = $birthday;
        $newUser->signed_up = date("Y-m-d H:i:s");
        $newUser->setPassword($password);
        return $newUser;      
    }

    /**
     * Récupère la date d'inscription
     * 
     * Ce getter est necessaire, car la date d'inscription servant de poivre elle ne doit pas pouvoir être changée et est donc privée
     * 
     * @return string La date d'inscription
     */
    public function getSignedUp():string{
        return $this->signedUp;
    }

    /**
     * Change le mot de passe de ce user
     * 
     * Effectue le hash du mot de passe pendant la modification
     * 
     * @param string $newPassword Nouveau mot de passe non-hashé
     * @return string Nouveau mot de passe hashé 
     *
     */
    public function setPassword(string $newPassword):string{
        return $this->password = sha1(self::SALT.$newPassword.$this->signed_up);
    }

    /**
     * Récupère le mot de passe hashé de ce User
     * 
     * Ce getter est necessaire pour que le mot de passe puisse être private et que son hash soit effectué automatiquement lors de sa modification par la fonction setPassword
     * 
     * @return string Le mot de passe hashé
     */
    public function getPassword():string{
        return $this->password;
    }
    
    /**
     * Enregistre en base de données ce User
     * 
     * Crée un nouveau User si $id_user est vide
     * Modifie le User correspondant à $id_user dans la base de données si il n'est pas vide
     * 
     * @return void
     */
    public function save():void{
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

    /**
     * Crée un User tout en vérifiant que les données envoyées soient valides
     * 
     * Vérifie que le pseudo fasse minimum 8 caracteres
     * Vérifie que le mot de passe fasse minimum 8 caraacteres
     * Vérifie que le mot de passe contient une lettre minuscule
     * Vérifie que le mot de passe contient une lettre majuscule
     * Vérifie que le mot de passe contient un chiffre
     * Vérifie que le mot de passe contient un caractere special
     * Vérifie que les deux mots de passe soient identiques
     * Vérifie que l'adresse mail est valide
     * Vérifie que la date de naissance est au format yyyy-mm-dd
     * 
     * @param string $nickname Le pseudo
     * @param string $email l'email
     * @param string $password le mot de passe non hashé
     * @param string $confirmPassword la confirmation du mot de passe
     * @param string $birthday la date de naissance
     * 
     * @return mixed Le user qui vient d'être créé (sans id) ou un array qui liste les erreurs rencontrées
     */
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

    /**
     * Récupère un User dans la base de données en fonction de son email et de son mot de passe
     * 
     * @param string $email le courriel recherché
     * @param string $password le mot de passe non hashé recherché
     * 
     * @return User Le User trouvé ou un User vide si pas de correspondance
     */
    public static function loadByEmailAndPassword(string $email, string $password):User{
        $requete_preparee = $GLOBALS['database']->prepare(
            "SELECT * FROM user 
            WHERE `email`=:email 
            `password`= SHA1(CONCAT(self::SALT,:pwd,`signed_up`))
            LIMIT 1"
        );
        $reussite = $requete_preparee->execute([':email'=> $email,':pwd'=>$password]);
        if($reussite){
            return $requete_preparee->fetchObject("User");   
        }
        return new User();
    }
}