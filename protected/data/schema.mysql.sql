SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `fahrenheit` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `fahrenheit` ;

-- -----------------------------------------------------
-- Table `fahrenheit`.`user`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `lastname` VARCHAR(45) NULL ,
  `username` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `about` TEXT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `ip` VARCHAR(45) NULL ,
  `active` INT NOT NULL ,
  `power` INT NOT NULL ,
  `ban` INT NOT NULL ,
  `sec_ques` VARCHAR(45) NULL ,
  `answer` VARCHAR(45) NULL ,
  `course` VARCHAR(45) NULL ,
  `profilepic` VARCHAR(255) NULL ,
  `thumbnail` VARCHAR(255) NULL ,
  `email` VARCHAR(100) NULL ,
  `mobile` BIGINT NULL ,
  `slug` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`module`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`module` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `category` VARCHAR(100) NOT NULL ,
  `description` TEXT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`status`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`status` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `status` TEXT NOT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `user_agent` VARCHAR(100) NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_status_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_status_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`comment` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `content` TEXT NOT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `ip` VARCHAR(45) NULL ,
  `user_agent` VARCHAR(100) NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  `module_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_comment_user1_idx` (`user_id` ASC) ,
  INDEX `fk_comment_module1_idx` (`module_id` ASC) ,
  CONSTRAINT `fk_comment_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_module1`
    FOREIGN KEY (`module_id` )
    REFERENCES `fahrenheit`.`module` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`resource`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`resource` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `link` VARCHAR(255) NOT NULL ,
  `info` TEXT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_resource_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_resource_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`complaint`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`complaint` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `complaint` TEXT NOT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `user_agent` VARCHAR(100) NULL ,
  `ip` VARCHAR(45) NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_complaint_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_complaint_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`feedback`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`feedback` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `content` TEXT NOT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `reply` TEXT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_feedback_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_feedback_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`money`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`money` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `amount` INT UNSIGNED NULL ,
  `reason` VARCHAR(45) NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_money_user_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_money_user`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`report`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`report` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `report_data` TEXT NOT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_report_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_report_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`faq`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`faq` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `faq` TEXT NOT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`post`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`post` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NOT NULL ,
  `content` TEXT NOT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `status` INT NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_post_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_post_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`tag`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`tag` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `tag` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`post_comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`post_comment` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `comment` TEXT NOT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `post_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_post_comment_post1_idx` (`post_id` ASC) ,
  CONSTRAINT `fk_post_comment_post1`
    FOREIGN KEY (`post_id` )
    REFERENCES `fahrenheit`.`post` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`todo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`todo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `todocol` VARCHAR(255) NOT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `deadline` DATETIME NULL ,
  `module_id` INT UNSIGNED NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  `description` TEXT NULL ,
  `completed` SMALLINT NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_todo_module1_idx` (`module_id` ASC) ,
  INDEX `fk_todo_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_todo_module1`
    FOREIGN KEY (`module_id` )
    REFERENCES `fahrenheit`.`module` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_todo_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`bug_feature`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`bug_feature` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `content` VARCHAR(45) NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `todo_id` INT UNSIGNED NOT NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_bug_feature_todo1_idx` (`todo_id` ASC) ,
  INDEX `fk_bug_feature_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_bug_feature_todo1`
    FOREIGN KEY (`todo_id` )
    REFERENCES `fahrenheit`.`todo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_bug_feature_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`tag_has_post`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`tag_has_post` (
  `tag_id` INT UNSIGNED NOT NULL ,
  `post_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`tag_id`, `post_id`) ,
  INDEX `fk_tag_has_post_post1_idx` (`post_id` ASC) ,
  INDEX `fk_tag_has_post_tag1_idx` (`tag_id` ASC) ,
  CONSTRAINT `fk_tag_has_post_tag1`
    FOREIGN KEY (`tag_id` )
    REFERENCES `fahrenheit`.`tag` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tag_has_post_post1`
    FOREIGN KEY (`post_id` )
    REFERENCES `fahrenheit`.`post` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`status_comment`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`status_comment` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `content` TEXT NOT NULL ,
  `created_on` DATETIME NULL ,
  `updated_on` DATETIME NULL ,
  `user_agent` VARCHAR(100) NULL ,
  `ip` VARCHAR(45) NULL ,
  `user_id` INT UNSIGNED NOT NULL ,
  `status_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) ,
  INDEX `fk_status_comment_user1_idx` (`user_id` ASC) ,
  INDEX `fk_status_comment_status1_idx` (`status_id` ASC) ,
  CONSTRAINT `fk_status_comment_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_status_comment_status1`
    FOREIGN KEY (`status_id` )
    REFERENCES `fahrenheit`.`status` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `fahrenheit`.`user_has_module`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `fahrenheit`.`user_has_module` (
  `user_id` INT UNSIGNED NOT NULL ,
  `module_id` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`user_id`, `module_id`) ,
  INDEX `fk_user_has_module_module1_idx` (`module_id` ASC) ,
  INDEX `fk_user_has_module_user1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_user_has_module_user1`
    FOREIGN KEY (`user_id` )
    REFERENCES `fahrenheit`.`user` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_module_module1`
    FOREIGN KEY (`module_id` )
    REFERENCES `fahrenheit`.`module` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `fahrenheit` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
