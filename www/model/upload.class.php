<?php
require_once('./model/pdo.php');
require_once("./model/databaseObject.interface.php");
require_once('./model/user.class.php');

class Upload implements databaseObject{
    public ?int $id_upload=null;
    public int $id_uploader;//L'id du User qui a effectué cet upload
    private string $upload_time;//L'heure à laquelle cet upload a été effectué
    public string $title;//Le titre de cet upload
    public string $description;//La description de cet upload
    public string $path;//Le chemin sur le disque dur vers cet upload
    public string $media_type;//Le type de media de cet upload (picture,video)

    private ?User $uploader=null;//Les informations complètes sur le user qui a effectué cet Upload

    /**
     * Récupère un Upload dans la base de données à partir de son id
     * 
     * @param int $id_upload
     * 
     * @return Upload
     */
    public static function loadById(int $id_upload):Upload{
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM upload WHERE id_upload=:id_upload");
        $parametres = array(
            ':id_upload'=> $id_upload
        );
        $requete_preparee->execute($parametres);
        return $requete_preparee->fetchObject("Upload");
    }
    
    /**
     * Crée un Upload tout en remplissant toutes ses infos
     * 
     * @param int $id_uploader L'id du User qui a effectué l'upload
     * @param string $upload_time L'heure à laquelle l'upload a été effectué
     * @param string $title Le titre de l'Upload
     * @param string $description La description de l'upload
     * @param string $path Le chemin sur le disque dur vers le fichier de cet upload
     * @param string $media_type Le type de media (picture,video)
     * 
     * @return Upload
     */
    public static function create($id_uploader,$title, $description,$path,$media_type):Upload{
        $newUpload = new Upload();
        $newUpload->id_uploader = $id_uploader;
        $newUpload->upload_time = date("Y-m-d H:i:s");  
        $newUpload->title = $title;
        $newUpload->description= $description;
        $newUpload->path= $path;
        $newUpload->media_type= $media_type;
        return $newUpload;
    }

    /**
     * Récupère les informations complètes du User qui a effectué cet upload
     * 
     * @return User
     */
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

    /**
     * Récupère la date d'upload qui est privée pour la renvoyer publiquement
     * 
     * @return string La date de création de l'upload
     */
    public function getUploadTime(){
        return $this->upload_time;
    }

    /**
     * Enregistre en base de données cet Upload
     * 
     * Crée un nouvel Upload si $id_upload est vide
     * Modifie l'upload correspondant à $id_upload dans la base de données si il n'est pas vide
     * 
     * @return void
     */
    public function save():void{
        if($this->id_upload!=null){
            //faire un UPDATE dans la base de données
            $requete_preparee=$GLOBALS['database']->prepare("UPDATE upload SET `id_uploader`=:id_uploader, `title`=:title, `description`=:descript, `path`=:chemin, `media_type`=:media_type WHERE `id_upload`=:id_upload");
            $requete_preparee->execute([
                ":id_upload"=>$this->id_upload,
                ":id_uploader"=>$this->id_uploader,
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
