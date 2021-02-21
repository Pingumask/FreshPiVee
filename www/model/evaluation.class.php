<?php
require_once("./model/pdo.php");
require_once("./model/databaseObject.interface.php");
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
            $this->upload = Upload::loadById($this->id_upload);
            return $this->upload; 
        }
        else{
            return new Upload();
        }
    }

    public static function create(int $id_user = null, int $id_upload = null, string $evaluation_type = null, string $evaluation_time = null):Evaluation{
        $newEvaluation = new Evaluation();
        $newEvaluation->id_evaluation = null;
        $newEvaluation->id_user = $id_user;
        $newEvaluation->id_upload = $id_upload;
        $newEvaluation->evaluation_type = $evaluation_type;
		$newEvaluation->evaluation_time = $evaluation_time;
        return $newEvaluation;
    }

    public function save():void{
        if($this->id_evaluation!=null){
            //faire un UPDATE dans la base de données
            $requete_preparee=$GLOBALS['database']->prepare("UPDATE evaluation SET `id_user`=:id_user, `id_upload`=:id_upload, `evaluation_type`=:evaluation_type, `evaluation_time`=:evaluation_time WHERE `id_evaluation`=:id_evaluation");
            $requete_preparee->execute([
                ":id_user"=>$this->id_user, 
                ":id_upload"=>$this->id_upload,
                ":id_evaluation"=>$this->id_evaluation,
                ":evaluation_type"=>$this->evaluation_type, 
                ":evaluation_time"=>$this->evaluation_time
            ]);
        }
        else{
            //faire un INSERT dans la BDD
            $requete_preparee=$GLOBALS['database']->prepare("INSERT INTO evaluation (`id_user`, `id_upload`, `evaluation_type`, `evaluation_time`) VALUES(:id_user, :id_upload, :evaluation_type, :evaluation_time)");
            $reussite=$requete_preparee->execute([
                ":id_user"=>$this->id_user, 
                ":id_upload"=>$this->id_upload, 
                ":evaluation_type"=>$this->evaluation_type, 
                ":evaluation_time"=>$this->evaluation_time
            ]);
            if($reussite===true){
                $this->id_evaluation=$GLOBALS['database']->lastInsertId();
            }
        }
    }
}