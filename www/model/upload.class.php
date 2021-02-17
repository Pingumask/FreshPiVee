<?php
require_once('./model/pdo.php');
require_once('./model/user.class.php');
class Upload{
    //Liste des attributs qui définissent ce qu'est un upload. Les attributs publics correspondent à ceux de la table dans la base de données
    public $id_upload;
    public $id_uploader;
    public $upload_time;
    public $title;
    public $description;
    public $path;
    public $media_type;
    //Uploader servira à stocker la version complete du User concerné si on a besoin de le récupérer à partir de son id en utilisant la fonction getUploader()
    private $uploader;

    //Chargement d'un objet de la classe Upload à partir de la base de données
    public static function loadById(int $id_upload):Upload{
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM upload WHERE id_upload=:id_upload");
        $parametres = array(
            ':id_upload'=> $id_upload
        );
        $requete_preparee->execute($parametres);
        return $requete_preparee->fetchObject("Upload");
    }
    
    //Chargement des informations dans un objet de la classe Upload en dehors de la base de données
    public function init($id_upload,$uploader,$upload_time,$title, $description,$path,$media_type){
        $this->id_upload = $id_upload;
        $this->uploader = $uploader;
        $this->upload_time= $upload_time;
        $this->title = $title;
        $this->description= $description;
        $this->path= $path;
        $this->media_type= $media_type;
        return $this;
    }

    //Récupération des informations complètes du User qui a réalisé l'upload (voir la methode getFollower() de la classe Follow qui est très similaire pour plus de détails)
    public function getUploader():User{
        if($this->uploader!=null){
            return $this->uploader;
        }
        elseif($this->id_uploader!=null){
            $this->uploader = User::loadById($this->id_uploader);
            return $this->uploader; 
        }
        else{
            return new User();
        }
    }
}
