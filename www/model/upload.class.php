<?php
require_once('./model/pdo.php');
require_once("./model/databaseObject.interface.php");
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
    public static function create($id_uploader,$upload_time,$title, $description,$path,$media_type):Upload{
        $newUpload = new Upload();
        $newUpload->id_upload = null;
        $newUpload->id_uploader = $id_uploader;
        $newUpload->upload_time= $upload_time;
        $newUpload->title = $title;
        $newUpload->description= $description;
        $newUpload->path= $path;
        $newUpload->media_type= $media_type;
        return $newUpload;
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

    public function save():void{
        //AVANT d'écrire dans la base de données on vérifie que les données à sauvegarder sont cohérentes
        //Si c'est cohérent, on update ou insert selon que ce soit un nouvel utilisateur ou pas
        //sinon, on refuse d'ecrire dans la base

        if($this->id_upload!=null){
            //faire un UPDATE dans la base de données
            $requete_preparee=$GLOBALS['database']->prepare("UPDATE upload SET `id_uploader`=:id_uploader,`upload_time`=:upload_time, `title`=:title, `description`=:descript, `path`=:chemin, `media_type`=:media_type WHERE `id_upload`=:id_upload");
            $requete_preparee->execute([
                ":id_upload"=>$this->id_upload,
                ":id_uploader"=>$this->id_uploader,
                ":upload_time"=>$this->upload_time, 
                ":title"=>$this->title, 
                ":descript"=>$this->description, 
                ":chemin"=>$this->path,
                ":media_type"=>$this->media_type
            ]);
        }
        else{
            //faire un INSERT dans la BDD
            $requete_preparee=$GLOBALS['database']->prepare("INSERT INTO upload (`id_uploader`,`upload_time`, `title`, `description`, `path`, `media_type`) VALUES(:id_uploader,:upload_time, :title, :descript, :chemin, :media_type)");
            $reussite=$requete_preparee->execute([
                ":id_uploader"=>$this->id_uploader,
                ":upload_time"=>$this->upload_time,
                ":title"=>$this->title, 
                ":descript"=>$this->description, 
                ":chemin"=>$this->path, 
                ":media_type"=>$this->media_type
            ]);
            if($reussite===true){
                $this->id_upload=$GLOBALS['database']->lastInsertId();
            }
        }
    }
}
