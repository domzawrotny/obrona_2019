
CREATE DATABASE IF NOT EXISTS students_book;
USE students_book;
show tables;


DROP TABLE IF EXISTS `student`,`lecturer`,`student_group`,`subject_list`,`faculty`,`study_degree`,`degree_course`,`user_login`,`subject_group`,`user_permissions`,`grade_list`,`final_grade`,`grade`;


CREATE TABLE `faculty`
(
 `faculty_id`           INT NOT NULL AUTO_INCREMENT,
 `faculty_name`         NVARCHAR(60) NOT NULL ,
 `faculty_abbreviation` NVARCHAR(5) NOT NULL ,

PRIMARY KEY (`faculty_id`)
);


CREATE TABLE `study_degree`
(
 `study_degree_id`   INT NOT NULL AUTO_INCREMENT,
 `study_degree_name` NVARCHAR(20) NOT NULL ,

PRIMARY KEY (`study_degree_id`)
);


CREATE TABLE `grade_list`
(
 `grade_id`        INT NOT NULL AUTO_INCREMENT,
 `grade_full_name` NVARCHAR(20) NOT NULL ,
 `grade_acr_name`  NVARCHAR(5) NOT NULL ,
 `grade_value`     FLOAT NOT NULL ,

PRIMARY KEY (`grade_id`)
);


CREATE TABLE `user_permissions`
(
 `permissions_id`   INT NOT NULL AUTO_INCREMENT,
 `permissions_type` VARCHAR(20) NOT NULL ,

PRIMARY KEY (`permissions_id`)
);


CREATE TABLE `degree_course`
(
 `degree_course_id`   INT NOT NULL AUTO_INCREMENT,
 `degree_course_name` NVARCHAR(60) NOT NULL ,
 `faculty_id`         INT NOT NULL ,

PRIMARY KEY (`degree_course_id`),
KEY `fkIdx_110` (`faculty_id`),
CONSTRAINT `FK_110` FOREIGN KEY `fkIdx_110` (`faculty_id`) REFERENCES `faculty` (`faculty_id`)
);


CREATE TABLE `user_login`
(
 `login_id`       INT NOT NULL AUTO_INCREMENT,
 `login`          VARCHAR(20) NOT NULL ,
 `password`       VARCHAR(30) NOT NULL ,
 `permissions_id` INT NOT NULL ,

PRIMARY KEY (`login_id`),
KEY `fkIdx_28` (`permissions_id`),
CONSTRAINT `FK_28` FOREIGN KEY `fkIdx_28` (`permissions_id`) REFERENCES `user_permissions` (`permissions_id`)
);


CREATE TABLE `subject_list`
(
 `subject_id`       INT NOT NULL AUTO_INCREMENT,
 `subject_name`     NVARCHAR(100) NOT NULL ,
 `degree_course_id` INT NOT NULL ,

PRIMARY KEY (`subject_id`),
KEY `fkIdx_113` (`degree_course_id`),
CONSTRAINT `FK_113` FOREIGN KEY `fkIdx_113` (`degree_course_id`) REFERENCES `degree_course` (`degree_course_id`)
);


CREATE TABLE `lecturer`
(
 `lecturer_id` INT NOT NULL AUTO_INCREMENT,
 `surname`     NVARCHAR(20) NOT NULL ,
 `firstname`   NVARCHAR(20) NOT NULL ,
 `pesel`       NVARCHAR(11) NOT NULL ,
 `city`        NVARCHAR(20) ,
 `street`      NVARCHAR(20) ,
 `house_no`    NVARCHAR(5) ,
 `birth_date`  DATE NOT NULL ,
 `login_id`    INT NOT NULL ,

PRIMARY KEY (`lecturer_id`),
KEY `fkIdx_34` (`login_id`),
CONSTRAINT `FK_34` FOREIGN KEY `fkIdx_34` (`login_id`) REFERENCES `user_login` (`login_id`)
);


CREATE TABLE `student_group`
(
 `student_group_id`   INT NOT NULL AUTO_INCREMENT,
 `student_group_name` NVARCHAR(20) NOT NULL ,
 `degree_course_id`   INT NOT NULL ,
 `study_degree_id`    INT NOT NULL ,

PRIMARY KEY (`student_group_id`),
KEY `fkIdx_95` (`degree_course_id`),
CONSTRAINT `FK_95` FOREIGN KEY `fkIdx_95` (`degree_course_id`) REFERENCES `degree_course` (`degree_course_id`),
KEY `fkIdx_102` (`study_degree_id`),
CONSTRAINT `FK_102` FOREIGN KEY `fkIdx_102` (`study_degree_id`) REFERENCES `study_degree` (`study_degree_id`)
);


CREATE TABLE `student`
(
 `student_id`       INT NOT NULL AUTO_INCREMENT,
 `surname`          NVARCHAR(20) NOT NULL ,
 `firstname`        NVARCHAR(20) NOT NULL ,
 `pesel`            NVARCHAR(11) NOT NULL ,
 `city`             NVARCHAR(20) ,
 `street`           NVARCHAR(20) ,
 `house_no`         NVARCHAR(5) ,
 `birth_date`       DATE NOT NULL ,
 `student_group_id` INT NOT NULL ,
 `login_id`         INT NOT NULL ,

PRIMARY KEY (`student_id`),
KEY `fkIdx_16` (`student_group_id`),
CONSTRAINT `FK_16` FOREIGN KEY `fkIdx_16` (`student_group_id`) REFERENCES `student_group` (`student_group_id`),
KEY `fkIdx_44` (`login_id`),
CONSTRAINT `FK_44` FOREIGN KEY `fkIdx_44` (`login_id`) REFERENCES `user_login` (`login_id`)
);


CREATE TABLE `grade`
(
 `grade_id`    INT NOT NULL AUTO_INCREMENT,
 `date`        DATE NOT NULL ,
 `time`        TIME NOT NULL ,
 `student_id`  INT NOT NULL ,
 `lecturer_id` INT NOT NULL ,
 `grade_id_1`  INT NOT NULL ,
 `subject_id`  INT NOT NULL ,

PRIMARY KEY (`grade_id`),
KEY `fkIdx_70` (`student_id`),
CONSTRAINT `FK_70` FOREIGN KEY `fkIdx_70` (`student_id`) REFERENCES `student` (`student_id`),
KEY `fkIdx_76` (`lecturer_id`),
CONSTRAINT `FK_76` FOREIGN KEY `fkIdx_76` (`lecturer_id`) REFERENCES `lecturer` (`lecturer_id`),
KEY `fkIdx_82` (`grade_id_1`),
CONSTRAINT `FK_82` FOREIGN KEY `fkIdx_82` (`grade_id_1`) REFERENCES `grade_list` (`grade_id`),
KEY `fkIdx_85` (`subject_id`),
CONSTRAINT `FK_85` FOREIGN KEY `fkIdx_85` (`subject_id`) REFERENCES `subject_list` (`subject_id`)
);


CREATE TABLE `final_grade`
(
 `final_grade_id` INT NOT NULL AUTO_INCREMENT,
 `date`           DATE NOT NULL ,
 `time`           TIME NOT NULL ,
 `student_id`     INT NOT NULL ,
 `lecturer_id`    INT NOT NULL ,
 `grade_id`       INT NOT NULL ,
 `subject_id`     INT NOT NULL ,

PRIMARY KEY (`final_grade_id`),
KEY `fkIdx_67` (`student_id`),
CONSTRAINT `FK_67` FOREIGN KEY `fkIdx_67` (`student_id`) REFERENCES `student` (`student_id`),
KEY `fkIdx_73` (`lecturer_id`),
CONSTRAINT `FK_73` FOREIGN KEY `fkIdx_73` (`lecturer_id`) REFERENCES `lecturer` (`lecturer_id`),
KEY `fkIdx_79` (`grade_id`),
CONSTRAINT `FK_79` FOREIGN KEY `fkIdx_79` (`grade_id`) REFERENCES `grade_list` (`grade_id`),
KEY `fkIdx_88` (`subject_id`),
CONSTRAINT `FK_88` FOREIGN KEY `fkIdx_88` (`subject_id`) REFERENCES `subject_list` (`subject_id`)
);