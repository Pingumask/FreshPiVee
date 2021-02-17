<?php
require_once('./model/pdo.php');
require_once('./model/user.class.php');
class Upload{
    public $id_upload;
    public $id_uploader;
    private $uploader;
    public $upload_time;
    public $title;
    public $description;
    public $path;
    public $media_type;

    public function getUploadFromDb(int $id_upload){
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM upload WHERE id_upload=:id_upload");
        $parametres = array(
            ':id_upload'=> $id_upload
        );

        $requete_preparee->execute($parametres);
        $resultat = $requete_preparee->fetchObject("Upload");
        foreach(get_object_vars($resultat) as $param=>$value){
            $this->$param = $value;
        }
        $this->uploader;
    }
    
    public function setUpload($id_upload,$uploader,$upload_time,$title, $description,$path,$media_type){
        $this->id_upload = $id_upload;
        $this->uploader = $uploader;
        $this->upload_time= $upload_time;
        $this->title = $title;
        $this->description= $description;
        $this->path= $path;
        $this->media_type= $media_type;
    }

    public function getUploader():User{
        if($this->uploader!=null){
            return $this->uploader;
        }
        elseif($this->id_uploader!=null){
            //aller chercher l'uploader dans la base de données
            $this->uploader = new User();
            $this->uploader->getUserFromDb($this->id_uploader);
            return $this->uploader; 
        }
        else{
            return new User();
        }
    }

}
