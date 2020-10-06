-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ExerciseLooper
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ExerciseLooper
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ExerciseLooper` DEFAULT CHARACTER SET utf8 ;
USE `ExerciseLooper` ;

-- -----------------------------------------------------
-- Table `ExerciseLooper`.`Exercises`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ExerciseLooper`.`Exercises` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(250) NULL,
  `state` ENUM('Building', 'Answering', 'Closed') NULL,
  `createdAt` DATETIME NULL,
  `updatedAt` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ExerciseLooper`.`QuestionFields`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ExerciseLooper`.`QuestionFields` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(250) NULL,
  `Exercises_id` INT NOT NULL,
  `valueType` ENUM('Single line text', 'List of single lines', 'Multi-line text') NULL,
  `createdAt` DATETIME NULL,
  `updatedAt` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_QuestionFields_Exercises_idx` (`Exercises_id` ASC) ,
  CONSTRAINT `fk_QuestionFields_Exercises`
    FOREIGN KEY (`Exercises_id`)
    REFERENCES `ExerciseLooper`.`Exercises` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ExerciseLooper`.`Answers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ExerciseLooper`.`Answers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `answer` VARCHAR(1000) NULL,
  `QuestionFields_id` INT NOT NULL,
  `createdAt` DATETIME NULL,
  `updatedAt` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Answers_QuestionFields1_idx` (`QuestionFields_id` ASC) ,
  CONSTRAINT `fk_Answers_QuestionFields1`
    FOREIGN KEY (`QuestionFields_id`)
    REFERENCES `ExerciseLooper`.`QuestionFields` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ExerciseLooper`.`Takes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ExerciseLooper`.`Takes` (
  `id` INT NOT NULL,
  `title` VARCHAR(250) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ExerciseLooper`.`Fulfillments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ExerciseLooper`.`Fulfillments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `Answers_id` INT NOT NULL,
  `Exercises_id` INT NOT NULL,
  `Takes_id` INT NOT NULL,
  `createdAt` DATETIME NULL,
  `updatedAt` DATETIME NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Answers_has_Exercises_Exercises1_idx` (`Exercises_id` ASC) ,
  INDEX `fk_Answers_has_Exercises_Answers1_idx` (`Answers_id` ASC) ,
  INDEX `fk_Fulfillments_Takes1_idx` (`Takes_id` ASC) ,
  CONSTRAINT `fk_Answers_has_Exercises_Answers1`
    FOREIGN KEY (`Answers_id`)
    REFERENCES `ExerciseLooper`.`Answers` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Answers_has_Exercises_Exercises1`
    FOREIGN KEY (`Exercises_id`)
    REFERENCES `ExerciseLooper`.`Exercises` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fulfillments_Takes1`
    FOREIGN KEY (`Takes_id`)
    REFERENCES `ExerciseLooper`.`Takes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
