# DROP DATABASE IF EXISTS OBRONA_2019_TEST;
CREATE DATABASE IF NOT EXISTS OBRONA_2019_TEST;
USE OBRONA_2019_TEST;
show tables;


# DROP TABLE IF EXISTS `student`,`lecturer`,`faculty`,`study_degree`,`degree_course`,`user_login`,`subject_group`,`user_permissions`,`grade_list`,`final_grade`,`grade`,`study_type`;


CREATE TABLE `FACULTY`
(
 `faculty_id`           INT NOT NULL AUTO_INCREMENT, #temp
 #docelowo: `faculty_id`           INT NOT NULL ,
 `faculty_name`         VARCHAR(60) NOT NULL ,
 `faculty_abbreviation` VARCHAR(5) NOT NULL ,

PRIMARY KEY (`faculty_id`)
);


CREATE TABLE `STUDY_DEGREE`
(
 `study_degree_id`   INT NOT NULL AUTO_INCREMENT,
 `study_degree_name` VARCHAR(20) NOT NULL ,

PRIMARY KEY (`study_degree_id`)
);


CREATE TABLE `USER_PERMISSIONS`
(
 `permissions_id`    INT NOT NULL AUTO_INCREMENT,
`permissions_type`     VARCHAR(20) NOT NULL ,
 `quick_description` VARCHAR(30) NOT NULL,

PRIMARY KEY (`permissions_id`)
);


CREATE TABLE `STUDY_TYPE`
(
 `study_type_id`   int NOT NULL AUTO_INCREMENT,
 `study_type_name` varchar(25) NOT NULL ,
PRIMARY KEY (`study_type_id`)
);

CREATE TABLE `DEGREE_COURSE`
(
 `degree_course_id`   INT NOT NULL AUTO_INCREMENT,
 `degree_course_name` VARCHAR(60) NOT NULL ,
 `faculty_id`         INT NOT NULL ,

PRIMARY KEY (`degree_course_id`),
KEY `fkIdx_110` (`faculty_id`),
CONSTRAINT `FK_110` FOREIGN KEY `fkIdx_110` (`faculty_id`) REFERENCES `FACULTY` (`faculty_id`)
);


CREATE TABLE `USER_LOGIN`
(
 `login_id`       INT NOT NULL AUTO_INCREMENT,
 `login`          VARCHAR(20) NOT NULL ,
 `password`       VARCHAR(60) NOT NULL ,
 `permissions_id` INT NOT NULL ,
 `email_address`  VARCHAR(100) NOT NULL ,

PRIMARY KEY (`login_id`),
KEY `fkIdx_28` (`permissions_id`),
CONSTRAINT `FK_28` FOREIGN KEY `fkIdx_28` (`permissions_id`) REFERENCES `USER_PERMISSIONS` (`permissions_id`)
);


CREATE TABLE `SUBJECT_LIST`
(
 `subject_id`       INT NOT NULL AUTO_INCREMENT,
 `subject_name`     VARCHAR(255) NOT NULL ,
 `degree_course_id` INT NOT NULL ,

PRIMARY KEY (`subject_id`),
KEY `fkIdx_113` (`degree_course_id`),
CONSTRAINT `FK_113` FOREIGN KEY `fkIdx_113` (`degree_course_id`) REFERENCES `DEGREE_COURSE` (`degree_course_id`)
);


CREATE TABLE `LECTURER`
(
 `lecturer_id`              INT NOT NULL ,
 # docelowo: `lecturer_id` INT NOT NULL , # wartosc id z planu
 `title`                    VARCHAR(30) NOT NULL ,
 `surname`                  VARCHAR(20) NOT NULL ,
 `firstname`                VARCHAR(20) NOT NULL ,
 `pesel`                    VARCHAR(11) NOT NULL ,
 `city`                     VARCHAR(20) ,
 `street`                   VARCHAR(20) ,
 `house_no`                 VARCHAR(5) ,
 `birth_date`               DATE NOT NULL ,
 `login_id`                 INT NOT NULL ,
 `independent_employee`     BOOLEAN NOT NULL ,

PRIMARY KEY (`lecturer_id`),
KEY `fkIdx_34` (`login_id`),
CONSTRAINT `FK_34` FOREIGN KEY `fkIdx_34` (`login_id`) REFERENCES `USER_LOGIN` (`login_id`)
);


CREATE TABLE `STUDENT`
(
 `student_id`       INT NOT NULL AUTO_INCREMENT,
 `surname`          VARCHAR(20) NOT NULL ,
 `firstname`        VARCHAR(20) NOT NULL ,
 `pesel`            VARCHAR(11) NOT NULL ,
 `city`             VARCHAR(20) ,
 `street`           VARCHAR(20) ,
 `house_no`         VARCHAR(5) ,
 `birth_date`       DATE NOT NULL ,
 `login_id`         INT NOT NULL ,

PRIMARY KEY (`student_id`),
KEY `fkIdx_44` (`login_id`),
CONSTRAINT `FK_44` FOREIGN KEY `fkIdx_44` (`login_id`) REFERENCES `USER_LOGIN` (`login_id`)
);



CREATE TABLE `BUILDING`
(
 `building_id`           INT NOT NULL AUTO_INCREMENT,
 `building_name`         VARCHAR(5) NOT NULL ,

PRIMARY KEY (`building_id`)
);


CREATE TABLE `ROOM`
(
 `room_id`           INT NOT NULL AUTO_INCREMENT,
 `room_name`         VARCHAR(5) NOT NULL ,
 `PK_bulding_id`     INT NOT NULL ,

PRIMARY KEY (`room_id`) ,
KEY `fkIdx_2110` (`PK_bulding_id`) ,
CONSTRAINT `FK_2110` FOREIGN KEY `fkIdx_2110` (`PK_bulding_id`) REFERENCES `BUILDING` (`building_id`)
);


CREATE TABLE `EXAM_GROUP`
(
    `exam_group_id`     INT NOT NULL AUTO_INCREMENT ,
    `PK_student_id`     INT NOT NULL ,
    `PK_promotor_id`    INT NOT NULL ,
    `PK_reviewer_id`    INT NULL ,

    PRIMARY KEY (`exam_group_id`) ,
    KEY `fkIdx_2137` (`PK_student_id`) ,
    CONSTRAINT `FK_2137` FOREIGN KEY `fkIdx_2137` (`PK_student_id`) REFERENCES `STUDENT` (`student_id`) ,
    KEY `fkIdx_2138` (`PK_promotor_id`) ,
    CONSTRAINT `FK_2138` FOREIGN KEY `fkIdx_2138` (`PK_promotor_id`) REFERENCES `LECTURER` (`lecturer_id`) ,
    KEY `fkIdx_2139` (`PK_reviewer_id`) ,
    CONSTRAINT `FK_2139` FOREIGN KEY `fkIdx_2139` (`PK_reviewer_id`) REFERENCES `LECTURER` (`lecturer_id`)
);

CREATE TABLE `EXAM_COMMISSION`
(
    `exam_commission_id`    INT NOT NULL AUTO_INCREMENT ,
    `PK_leader_id`          INT NOT NULL ,
    `PK_room_id`            INT NOT NULL ,
    `PK_exam_group_1_id`    INT NOT NULL ,
    `PK_exam_group_2_id`    INT NULL ,
    `PK_exam_group_3_id`    INT NULL ,
    `PK_exam_group_4_id`    INT NULL ,
    `start_time`            TIME NOT NULL ,
    `end_time`              TIME NOT NULL ,
    `exam_date`             DATE NOT NULL ,
    `exam_confirmed`        BOOLEAN NOT NULL ,

    PRIMARY KEY (`exam_commission_id`) ,
    KEY `fkIdx_2140` (`PK_leader_id`) ,
    CONSTRAINT `FK_2140` FOREIGN KEY `fkIdx_2140` (`PK_leader_id`) REFERENCES `LECTURER` (`lecturer_id`) ,
    KEY `fkIdx_2141` (`PK_exam_group_1_id`) ,
    CONSTRAINT `FK_2141` FOREIGN KEY `fkIdx_2141` (`PK_exam_group_1_id`) REFERENCES `EXAM_GROUP` (`exam_group_id`) ,
    KEY `fkIdx_2142` (`PK_exam_group_2_id`) ,
    CONSTRAINT `FK_2142` FOREIGN KEY `fkIdx_2142` (`PK_exam_group_2_id`) REFERENCES `EXAM_GROUP` (`exam_group_id`) ,
    KEY `fkIdx_2143` (`PK_exam_group_3_id`) ,
    CONSTRAINT `FK_2143` FOREIGN KEY `fkIdx_2143` (`PK_exam_group_3_id`) REFERENCES `EXAM_GROUP` (`exam_group_id`) ,
    KEY `fkIdx_2144` (`PK_exam_group_4_id`) ,
    CONSTRAINT `FK_2144` FOREIGN KEY `fkIdx_2144` (`PK_exam_group_4_id`) REFERENCES `EXAM_GROUP` (`exam_group_id`) ,
    KEY `fkIdx_2145` (`PK_room_id`) ,
    CONSTRAINT `FK_2145` FOREIGN KEY `fkIdx_2145` (`PK_room_id`) REFERENCES `ROOM` (`room_id`)
);