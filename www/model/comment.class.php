<?php
require_once("./model/pdo.php");
require_once("./model/user.class.php");
require_once("./model/upload.class.php");

class Comment{
    public $id_comment;
	public $id_user;
	public $id_upload;
	public $comment_time;
    public $comment_content;

	private $user;
	private $upload;


	public static function loadById(int $id_comment):Comment{
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM comment WHERE id_comment=:id_comment");
        $parametres = array(
            ':id_comment'=> $id_comment
        );
        $requete_preparee->execute($parametres);
        return $requete_preparee->fetchObject("Comment");
    }

	public function init(int $id_comment = null, int $id_user = null, int $id_upload = null, string $comment_time = null, string $comment_content = null):Comment{
        $this->id_comment = $id_comment;
        $this->id_user = $id_user;
        $this->id_upload = $id_upload;
        $this->comment_time = $comment_time;
        $this->comment_content = $comment_content;
        return $this;
    }

    public function getUser():User{
        if($this->user!=null){
            return $this->user;
        }
        elseif($this->id_comment!=null){
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
        elseif($this->id_comment!=null){
            $this->upload = Upload::loadById($this->id_upload);
            return $this->upload; 
        }
        else{
            return new Upload();
        }

	}

    public function save(){
        //AVANT d'écrire dans la base de données on vérifie que les données à sauvegarder sont cohérentes
        //Si c'est cohérent, on update ou insert selon que ce soit un nouvel utilisateur ou pas
        //sinon, on refuse d'ecrire dans la base

        if($this->id_comment!=null){
            //faire un UPDATE dans la base de données
            $requete_preparee=$GLOBALS['database']->prepare("UPDATE comment SET `id_user`=:id_user,`id_upload`=:id_upload, `comment_time`=:comment_time, `comment_content`=:comment_content WHERE `id_comment`=:id_comment");
            $requete_preparee->execute([
                ":id_comment"=>$this->id_comment,
                ":id_user"=>$this->id_user,
                ":id_upload"=>$this->id_upload,
                ":comment_time"=>$this->comment_time,
                ":comment_content"=>$this->comment_content 
            ]);
        }
        else{
            //faire un INSERT dans la BDD
            $requete_preparee=$GLOBALS['database']->prepare("INSERT INTO comment (`id_user`,`id_upload`,`comment_time`, `comment_content`) VALUES(:id_user, :id_upload,:comment_time, :comment_content)");
            $requete_preparee->execute([
                ":id_user"=>$this->id_user,
                ":id_upload"=>$this->id_upload,
                ":comment_time"=>$this->comment_time,
                ":comment_content"=>$this->comment_content
            ]);
        }
    }
}
