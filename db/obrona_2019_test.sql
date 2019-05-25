-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 25 Maj 2019, 12:57
-- Wersja serwera: 10.1.40-MariaDB
-- Wersja PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `obrona_2019_test`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `degree_course`
--

CREATE TABLE `degree_course` (
  `degree_course_id` int(11) NOT NULL,
  `degree_course_name` varchar(60) NOT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(60) NOT NULL,
  `faculty_abbreviation` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `faculty_abbreviation`) VALUES
(1, 'Wydzial Artystyczny', 'WA'),
(2, 'Wydzial Budownictwa, Architektury i Inzynierii Srodowiska', 'WBAIS'),
(3, 'Wydzial Ekonomii i Zarzadzania', 'WEZ'),
(4, 'Wydzial Fizyki i Astronomii', 'WFA'),
(5, 'Wydzial Humanistyczny', 'WH'),
(6, 'Wydzial Informatyki, Elektrotechniki i Automatyki', 'WIEA'),
(7, 'Wydzial Lekarski i Nauk o Zdrowiu', 'WLNZ'),
(8, 'Wydzial Matematyki, Informatyki i Ekonometrii', 'WIE'),
(9, 'Wydzial Mechaniczny', 'WM'),
(10, 'Wydzial Nauk Biologicznych', 'WNB'),
(11, 'Wydzial Pedagogiki, Psychologii i Socjologii', 'WPPS'),
(12, 'Wydzial Prawa i Administracji', 'WPA');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lecturer`
--

CREATE TABLE `lecturer` (
  `lecturer_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `pesel` varchar(11) NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `street` varchar(20) DEFAULT NULL,
  `house_no` varchar(5) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `login_id` int(11) NOT NULL,
  `independent_employee` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `lecturer`
--

INSERT INTO `lecturer` (`lecturer_id`, `title`, `surname`, `firstname`, `pesel`, `city`, `street`, `house_no`, `birth_date`, `login_id`, `independent_employee`) VALUES
(21, 'dr inz.', 'Karolak', 'Wojtylak', '65042021370', NULL, NULL, NULL, '1965-04-20', 6, 1),
(37, 'dr inz. hab.', 'Gareth', 'Bale', '73121312731', NULL, NULL, NULL, '1973-12-13', 7, 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `pesel` varchar(11) NOT NULL,
  `city` varchar(20) DEFAULT NULL,
  `street` varchar(20) DEFAULT NULL,
  `house_no` varchar(5) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `login_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `student`
--

INSERT INTO `student` (`student_id`, `surname`, `firstname`, `pesel`, `city`, `street`, `house_no`, `birth_date`, `login_id`) VALUES
(1, 'Zawrotny', 'Dominik', '86111582912', 'Zielona Gora', 'Karola Wojtyly', '21', '1986-11-15', 1),
(2, 'Olbrys', 'Damian', '92063021371', 'Watykan', 'Joan Paolo', '37', '1992-06-30', 2),
(3, 'Pochanke', 'Pioter', '76121941321', 'Wadowice', 'Walaszka', '37', '1976-12-29', 3),
(4, 'Raczkowski', 'Marcin', '65011347604', 'Grudziadz', 'Janusza Korwin-Mikke', '4/76', '1965-01-13', 4);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `study_degree`
--

CREATE TABLE `study_degree` (
  `study_degree_id` int(11) NOT NULL,
  `study_degree_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `study_degree`
--

INSERT INTO `study_degree` (`study_degree_id`, `study_degree_name`) VALUES
(1, 'inzynierskie'),
(2, 'magisterskie'),
(3, 'doktoranckie'),
(4, 'jednolite');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `study_type`
--

CREATE TABLE `study_type` (
  `study_type_id` int(11) NOT NULL,
  `study_type_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `study_type`
--

INSERT INTO `study_type` (`study_type_id`, `study_type_name`) VALUES
(1, 'stacjonarne'),
(2, 'niestacjonarne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subject_list`
--

CREATE TABLE `subject_list` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(255) NOT NULL,
  `degree_course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_login`
--

CREATE TABLE `user_login` (
  `login_id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(60) NOT NULL,
  `permissions_id` int(11) NOT NULL,
  `email_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `user_login`
--

INSERT INTO `user_login` (`login_id`, `login`, `password`, `permissions_id`, `email_address`) VALUES
(1, 'dzawrotny', '$2y$10$uax8iNWESc0uCt/d910TYu7Df78xvYZ75vM8DuJ07VDufo.c0vJhm', 2, 'dzawrotny@uz.zgora.pl'),
(2, 'dolbrys', '$2y$10$J8a5.Sojh01hylmQvdXN1.aeBv7w.PmT4BBxMfl2bzqrjuUohMEpm', 2, 'dolbrys@uz.zgora.pl'),
(3, 'ppochanke', '$2y$10$ZsLMdFhrmWEpvZhY1Q4qqeqFZKh8Fvw4HW8BCpa2NFoxXZV491V6e', 2, 'ppochanke@uz.zgora.pl'),
(4, 'mraczkowski', '$2y$10$G4XcXZZfP.qWjo2sO1deUuetdCM13lxf9esbWEHxruVkXWl1Jl5lu', 2, 'mraczkowski@uz.zgora.pl'),
(5, 'admin', '$2y$10$DPDCc9u5UiU.hmmljFWvMe98ZTQfQIGj43eK3XsQ0hleD.fn.Yk4e', 1, 'admin@uz.zgora.pl'),
(6, 'kwojtylak', '$2y$10$1XfKv8nKKTZZD1mD44CdyOquaZBL6WPUPP3NSOh8QvxOL2E5prXnG', 3, 'kwojtylak@uz.zgora.pl'),
(7, 'gbale', '$2y$10$ohomh6sYfY/zG3RhOq1AvepzrSsqN4ICueRhAi8txICzCan/6Jc7e', 3, 'gbale@uz.zgora.pl'),
(8, 'test', '$2y$10$1XfKv8nKKTZZD1mD44CdyOquaZBL6WPUPP3NSOh8QvxOL2E5prXnG', 2, 'test@uz.zgora.pl');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_permissions`
--

CREATE TABLE `user_permissions` (
  `permissions_id` int(11) NOT NULL,
  `permissions_type` varchar(20) NOT NULL,
  `quick_description` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `user_permissions`
--

INSERT INTO `user_permissions` (`permissions_id`, `permissions_type`, `quick_description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'student', 'Student'),
(3, 'lecturer', 'Wykladowca'),
(4, 'deans_office', 'Pracownik dziekanatu');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `degree_course`
--
ALTER TABLE `degree_course`
  ADD PRIMARY KEY (`degree_course_id`),
  ADD KEY `fkIdx_110` (`faculty_id`);

--
-- Indeksy dla tabeli `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indeksy dla tabeli `lecturer`
--
ALTER TABLE `lecturer`
  ADD PRIMARY KEY (`lecturer_id`),
  ADD KEY `fkIdx_34` (`login_id`);

--
-- Indeksy dla tabeli `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `fkIdx_44` (`login_id`);

--
-- Indeksy dla tabeli `study_degree`
--
ALTER TABLE `study_degree`
  ADD PRIMARY KEY (`study_degree_id`);

--
-- Indeksy dla tabeli `study_type`
--
ALTER TABLE `study_type`
  ADD PRIMARY KEY (`study_type_id`);

--
-- Indeksy dla tabeli `subject_list`
--
ALTER TABLE `subject_list`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `fkIdx_113` (`degree_course_id`);

--
-- Indeksy dla tabeli `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `fkIdx_28` (`permissions_id`);

--
-- Indeksy dla tabeli `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`permissions_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `degree_course`
--
ALTER TABLE `degree_course`
  MODIFY `degree_course_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `lecturer`
--
ALTER TABLE `lecturer`
  MODIFY `lecturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT dla tabeli `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `study_degree`
--
ALTER TABLE `study_degree`
  MODIFY `study_degree_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `study_type`
--
ALTER TABLE `study_type`
  MODIFY `study_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `subject_list`
--
ALTER TABLE `subject_list`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `user_login`
--
ALTER TABLE `user_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT dla tabeli `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `permissions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `degree_course`
--
ALTER TABLE `degree_course`
  ADD CONSTRAINT `FK_110` FOREIGN KEY (`faculty_id`) REFERENCES `faculty` (`faculty_id`);

--
-- Ograniczenia dla tabeli `lecturer`
--
ALTER TABLE `lecturer`
  ADD CONSTRAINT `FK_34` FOREIGN KEY (`login_id`) REFERENCES `user_login` (`login_id`);

--
-- Ograniczenia dla tabeli `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_44` FOREIGN KEY (`login_id`) REFERENCES `user_login` (`login_id`);

--
-- Ograniczenia dla tabeli `subject_list`
--
ALTER TABLE `subject_list`
  ADD CONSTRAINT `FK_113` FOREIGN KEY (`degree_course_id`) REFERENCES `degree_course` (`degree_course_id`);

--
-- Ograniczenia dla tabeli `user_login`
--
ALTER TABLE `user_login`
  ADD CONSTRAINT `FK_28` FOREIGN KEY (`permissions_id`) REFERENCES `user_permissions` (`permissions_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
