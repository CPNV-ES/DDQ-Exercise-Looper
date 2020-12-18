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
  `createdAt` TIMESTAMP NULL DEFAULT now(),
  `updatedAt` TIMESTAMP NULL DEFAULT now(),
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ExerciseLooper`.`QuestionFields`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ExerciseLooper`.`QuestionFields` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `label` VARCHAR(250) NULL,
  `exercisesId` INT NOT NULL,
  `valueType` ENUM('Single line text', 'List of single lines', 'Multi-line text') NULL,
  `createdAt` TIMESTAMP NULL DEFAULT now(),
  `updatedAt` TIMESTAMP NULL DEFAULT now(),
  PRIMARY KEY (`id`),
  INDEX `fk_QuestionFields_Exercises_idx` (`exercisesId` ASC) VISIBLE,
  CONSTRAINT `fk_QuestionFields_Exercises`
    FOREIGN KEY (`exercisesId`)
    REFERENCES `ExerciseLooper`.`Exercises` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ExerciseLooper`.`Answers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ExerciseLooper`.`Answers` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `answer` VARCHAR(1000) NULL,
  `questionsFieldsId` INT NOT NULL,
  `createdAt` TIMESTAMP NULL DEFAULT now(),
  `updatedAt` TIMESTAMP NULL DEFAULT now(),
  PRIMARY KEY (`id`),
  INDEX `fk_Answers_QuestionFields1_idx` (`questionsFieldsId` ASC) VISIBLE,
  CONSTRAINT `fk_Answers_QuestionFields1`
    FOREIGN KEY (`questionsFieldsId`)
    REFERENCES `ExerciseLooper`.`QuestionFields` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ExerciseLooper`.`Takes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ExerciseLooper`.`Takes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(250) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ExerciseLooper`.`Fulfillments`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ExerciseLooper`.`Fulfillments` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `answersId` INT NOT NULL,
  `exercisesId` INT NOT NULL,
  `takesId` INT NOT NULL,
  `createdAt` TIMESTAMP NULL DEFAULT now(),
  `updatedAt` TIMESTAMP NULL DEFAULT now(),
  PRIMARY KEY (`id`),
  INDEX `fk_Answers_has_Exercises_Exercises1_idx` (`exercisesId` ASC) VISIBLE,
  INDEX `fk_Answers_has_Exercises_Answers1_idx` (`answersId` ASC) VISIBLE,
  INDEX `fk_Fulfillments_Takes1_idx` (`takesId` ASC) VISIBLE,
  CONSTRAINT `fk_Answers_has_Exercises_Answers1`
    FOREIGN KEY (`answersId`)
    REFERENCES `ExerciseLooper`.`Answers` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Answers_has_Exercises_Exercises1`
    FOREIGN KEY (`exercisesId`)
    REFERENCES `ExerciseLooper`.`Exercises` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Fulfillments_Takes1`
    FOREIGN KEY (`takesId`)
    REFERENCES `ExerciseLooper`.`Takes` (`id`)
    ON DELETE SET NULL
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
