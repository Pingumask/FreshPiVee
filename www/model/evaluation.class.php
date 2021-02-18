<?php
require_once("./model/pdo.php");
require_once("./model/user.class.php");
require_once("./model/upload.class.php");

class Evaluation{
    public $id_evaluation;
    public $id_user;
    public $id_upload;
    public $evaluation_type;
    public $evaluation_time;

    private $user;
    private $upload;
    
    // Déclarations des méthodes(les fonctions)
    
    public static function loadById($id_evaluation):Evaluation{
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM evaluation WHERE id_evaluation=:id_evaluation");
        $requete_preparee->execute([':id_evaluation'=> $id_evaluation]);
        return $requete_preparee->fetchObject("Evaluation");
    }
    
    public function getUser():User{
        if($this->user!=null){
            return $this->user;
        }
        elseif($this->id_user!=null){
            //aller chercher l'evaluation dans la base de données
            $this->user = User::loadById($this->id_user);
            return $this->user; 
        }
        else{
            return new User();
        }
    }

    public function getUpload():Upload{
        if($this->upload!=null){
            return $this->upload;
        }
        elseif($this->id_upload!=null){
            //aller chercher l'uploader dans la base de données
            $this->upload = Upload::loadById($this->id_upload);
            return $this->upload; 
        }
        else{
            return new Upload();
        }
    }

    public function init(int $id_evaluation = null, int $id_user = null, int $id_upload = null, string $evaluation_type = null, string $evaluation_time = null){
        $this->id_evaluation = $id_evaluation;
        $this->id_user = $id_user;
        $this->id_upload = $id_upload;
        $this->evaluation_type = $evaluation_type;
		$this->evaluation_time = $evaluation_time;
        return $this;
    }
}
