CREATE TABLE `user` (
	`id_user` INT NOT NULL AUTO_INCREMENT,
	`nickname` TEXT NOT NULL ,
	`email` TEXT NOT NULL ,
	`password` TEXT NOT NULL,
	`birthday` DATE NOT NULL,
	`signed_up` DATETIME NOT NULL,
	PRIMARY KEY (`id_user`)
) ENGINE=INNODB CHARACTER SET utf8;

CREATE TABLE `follow` (
	`id_follow` INT NOT NULL AUTO_INCREMENT,
	`id_follower` INT NOT NULL,
	`id_followed` INT NOT NULL,
	PRIMARY KEY (`id_follow`)
) ENGINE=INNODB CHARACTER SET utf8;

CREATE TABLE `upload` (
	`id_upload` INT NOT NULL AUTO_INCREMENT,
	`uploader` INT NOT NULL,
	`upload_time` DATETIME NOT NULL,
	`title` TEXT NOT NULL,
	`description` TEXT NOT NULL,
	`path` TEXT NOT NULL,
	`media_type` ENUM('picture', 'video') NOT NULL,
	PRIMARY KEY (`id_upload`)
) ENGINE=INNODB CHARACTER SET utf8;

CREATE TABLE `evaluation` (
	`id_evaluation` INT NOT NULL AUTO_INCREMENT,
	`id_user` INT NOT NULL,
	`id_upload` INT NOT NULL,
	`evaluation_type` ENUM('dislike', 'like', 'favorite') NOT NULL,
	`evaluation_time` DATETIME NOT NULL,
	PRIMARY KEY (`id_evaluation`)
) ENGINE=INNODB CHARACTER SET utf8;

CREATE TABLE `comment` (
	`id_comment` INT NOT NULL AUTO_INCREMENT,
	`id_user` INT NOT NULL,
	`id_upload` INT NOT NULL,
	`comment_time` DATETIME NOT NULL,
	`comment_content` TEXT NOT NULL,
	PRIMARY KEY (`id_comment`)
) ENGINE=INNODB CHARACTER SET utf8;

ALTER TABLE `follow` ADD CONSTRAINT `follower` FOREIGN KEY (`id_follower`) REFERENCES `user`(`id_user`);

ALTER TABLE `follow` ADD CONSTRAINT `followed` FOREIGN KEY (`id_followed`) REFERENCES `user`(`id_user`);

ALTER TABLE `upload` ADD CONSTRAINT `uploader` FOREIGN KEY (`uploader`) REFERENCES `user`(`id_user`);

ALTER TABLE `evaluation` ADD CONSTRAINT `evaluater` FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`);

ALTER TABLE `evaluation` ADD CONSTRAINT `evaluated` FOREIGN KEY (`id_upload`) REFERENCES `upload`(`id_upload`);

ALTER TABLE `comment` ADD CONSTRAINT `commenter` FOREIGN KEY (`id_user`) REFERENCES `user`(`id_user`);

ALTER TABLE `comment` ADD CONSTRAINT `commented` FOREIGN KEY (`id_upload`) REFERENCES `upload`(`id_upload`);