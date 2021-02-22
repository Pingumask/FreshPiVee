<?php
require_once("./model/pdo.php");
require_once("./model/databaseObject.interface.php");
require_once("./model/user.class.php");
require_once("./model/upload.class.php");

class Evaluation implements databaseObject{
    public ?int $id_evaluation=null;
    public ?int $id_user=null;//L'id du User qui a fait l'évaluation
    public ?int $id_upload=null;//L'id de l'Upload qui est évalué
    public string $evaluation_type="";//Le type d'évaluation ("like","dislike","favorite")
    private string $evaluation_time="";//L'heure de création de l'évaluation

    private ?User $user=null;//Les informations completes de l'utilisateur qui a créé l'évaluation
    private ?Upload $upload=null;//Les informations completes de l'upload qui est évalué
    
    /**
     * Récupère dans la base de données l'évaluation correspondant à l'id demandé
     * 
     * @param int $id_evaluation L'id de l'objet à aller chercher dans la base de données 
     * @return Evaluation
     */
    public static function loadById( int $id_evaluation):Evaluation{
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM evaluation WHERE id_evaluation=:id_evaluation");
        $requete_preparee->execute([':id_evaluation'=> $id_evaluation]);
        if($evaluation = $requete_preparee->fetchObject("Evaluation")){
            return $evaluation;
        }
        return new Evaluation();
    }
    
    /**
     * Récupère les informations completes sur le User qui a fait cette évaluation
     * 
     * @return User
     */
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

    /**
     * Récupère les informations complètes sur l'Upload qui est évalué
     * 
     * @return Upload
     */
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

    /**
     * Récupère l'heure à laquelle l'évaluation a été effectuée
     */
    public function getEvaluationTime():string{
        return $this->evaluation_time;
    }

    /**
     * Crée une nouvelle évaluation tout en remplissant ses informations
     * 
     * @param int $id_user l'id du User qui effectue l'évaluation
     * @param int $id_upload l'id de l'Upload qui est évalué
     * @param string $evaluation_type le type d'évaluation (like, dislike, favorite)
     * @param string $evaluation_time L'heure de création de l'évaluation
     * 
     * @return Evaluation
     */
    public static function create(int $id_user, int $id_upload, string $evaluation_type):Evaluation{
        $newEvaluation = new Evaluation();
        $newEvaluation->id_user = $id_user;
        $newEvaluation->id_upload = $id_upload;
        $newEvaluation->evaluation_type = $evaluation_type;
		$newEvaluation->evaluation_time = date("Y-m-d H:i:s"); 
        return $newEvaluation;
    }

    /**
     * Enregistre en base de données cette Evaluation
     * 
     * Crée une nouvelle Evaluation si $id_evaluation est null
     * Met à jour l'Evaluation correspondante si $id_evaluation n'est pas null
     * 
     * @return void
     */
    public function save():void{
        if($this->id_evaluation!=null){
            //faire un UPDATE dans la base de données
            $requete_preparee=$GLOBALS['database']->prepare("UPDATE evaluation SET `id_user`=:id_user, `id_upload`=:id_upload, `evaluation_type`=:evaluation_type, WHERE `id_evaluation`=:id_evaluation");
            $requete_preparee->execute([
                ":id_user"=>$this->id_user, 
                ":id_upload"=>$this->id_upload,
                ":id_evaluation"=>$this->id_evaluation,
                ":evaluation_type"=>$this->evaluation_type
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