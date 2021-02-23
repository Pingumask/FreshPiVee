<?php
require_once("./model/pdo.php");
require_once("./model/databaseObject.interface.php");
require_once("./model/user.class.php");
require_once("./model/upload.class.php");

class Comment implements databaseObject{
    public $id_comment=null;
	public $id_user=null;//L'id du User qui a laissé ce commentaire
	public $id_upload=null;//L'id de l'Upload qui a reçu ce commentaire
	private $comment_time="";//Le Datetime auquel ce commentaire a été fait
    public $comment_content="";//Le texte contenu dans ce commentaire

	private $user=null;//La version complete sous forme d'un objet de la classe User de l'utilisateur qui a laissé ce commentaire
	private $upload=null;//La version complete sous forme d'un objet de la classe Upload de l'element qui a été commenté

    /**
     * Récupère dans la base de données le commentaire correspondant à l'id demandé
     * 
     * @param int $id_comment L'id de l'objet à aller chercher dans la base de données 
     * @return Comment
     */
	public static function loadById(int $id_comment):Comment{
        $requete_preparee = $GLOBALS['database']->prepare("SELECT * FROM comment WHERE id_comment=:id_comment");
        $parametres = array(
            ':id_comment'=> $id_comment
        );
        $requete_preparee->execute($parametres);
        if($comment = $requete_preparee->fetchObject("Comment")){
            return $comment;
        }
        return new Comment();
    }

    /**
     * Crée un nouvel objet de la classe Comment avec tous les champs renseignés pendant la création
     * 
     * @param int $id_user L'id de l'utilisateur qui fait le commentaire
     * @param int $id_upload L'id de l'Upload qui est commenté
     * @param string $comment_time L'heure de création du commentaire
     * @param string $comment_content Le texte contenu dans le commentaire
     * 
     * @return Comment
     */
	public static function create(int $id_user, int $id_upload, string $comment_content):Comment{
        $newComment = new Comment();
        $newComment->id_user = $id_user;
        $newComment->id_upload = $id_upload;
        $newComment->comment_time = date("Y-m-d H:i:s"); 
        $newComment->comment_content = $comment_content;
        return $newComment;
    }

    /**
     * Récupère les information completes du User qui a effectué le commentaire
     * 
     * @return User
     */
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

    /**
     * Récupére les informations complètes de l'Upload qui est commenté
     * 
     * @return Upload
     */
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

    /**
     * Récupère l'heure à laquelle le commentaire a été effectué
     */
    public function getCommentTime():string{
        return $this->comment_time;
    }

    /**
     * Enregistre en base de données ce Comment
     * 
     * Crée un nouveau commentaire si $id_comment est null
     * Met à jour le commentaire correspondant si $id_comment n'est pas null
     * 
     * @return void
     */
    public function save():void{
        if($this->id_comment!=null){
            //faire un UPDATE dans la base de données
            $requete_preparee=$GLOBALS['database']->prepare("UPDATE comment SET `id_user`=:id_user,`id_upload`=:id_upload, `comment_content`=:comment_content WHERE `id_comment`=:id_comment");
            $requete_preparee->execute([
                ":id_comment"=>$this->id_comment,
                ":id_user"=>$this->id_user,
                ":id_upload"=>$this->id_upload,
                ":comment_content"=>$this->comment_content 
            ]);
        }
        else{
            //faire un INSERT dans la BDD
            $requete_preparee=$GLOBALS['database']->prepare("INSERT INTO comment (`id_user`,`id_upload`,`comment_time`, `comment_content`) VALUES(:id_user, :id_upload,:comment_time, :comment_content)");
            $reussite=$requete_preparee->execute([
                ":id_user"=>$this->id_user,
                ":id_upload"=>$this->id_upload,
                ":comment_time"=>$this->comment_time,
                ":comment_content"=>$this->comment_content
            ]);
            if($reussite===true){
                $this->id_comment=$GLOBALS['database']->lastInsertId();
            }
        }
    }
}
