  -- dodanie grupy

INSERT INTO study_type (study_type_name) VALUES
  ('stacjonarne') ,
  ('niestacjonarne');


INSERT INTO user_permissions (permissions_type,quick_description) VALUES
  ('admin','Administrator'),
  ('student','Student'),
  ('lecturer','Wykladowca'),
  ('deans_office','Pracownik dziekanatu');


INSERT INTO study_degree (study_degree_name) VALUES
  ('inzynierskie'),
  ('magisterskie'),
  ('doktoranckie'),
  ('jednolite');



INSERT INTO faculty (faculty_name, faculty_abbreviation) VALUES
  ('Wydzial Artystyczny','WA'),
  ('Wydzial Budownictwa, Architektury i Inzynierii Srodowiska','WBAIS'),
  ('Wydzial Ekonomii i Zarzadzania','WEZ'),
  ('Wydzial Fizyki i Astronomii','WFA'),
  ('Wydzial Humanistyczny','WH'),
  ('Wydzial Informatyki, Elektrotechniki i Automatyki','WIEA'),
  ('Wydzial Lekarski i Nauk o Zdrowiu','WLNZ'),
  ('Wydzial Matematyki, Informatyki i Ekonometrii','WIE'),
  ('Wydzial Mechaniczny','WM'),
  ('Wydzial Nauk Biologicznych','WNB'),
  ('Wydzial Pedagogiki, Psychologii i Socjologii','WPPS'),
  ('Wydzial Prawa i Administracji','WPA');
  -- ('Wydzial Zamiejscowy w Sulechowie','WZ');



INSERT INTO institute (institute_name, institute_abbreviation, FK_faculty_id) VALUES
(
    'Instytut Metrologii, Elektroniki i Informatyki',
    'IMEI',
    (SELECT faculty_id FROM faculty WHERE faculty_abbreviation = 'WIEA')
),
(
    'Instytut Inzynierii Elektrycznej',
    'IIE',
    (SELECT faculty_id FROM faculty WHERE faculty_abbreviation = 'WIEA')
),
                                                                                     (
    'Instytut Sterowania i Systemow Informatycznych',
    'ISSI',
    (SELECT faculty_id FROM faculty WHERE faculty_abbreviation = 'WIEA')
);

# INSERT INTO student_group (student_group_name, degree_course_id, study_degree_id, study_type_id)  VALUES
# 		(
# 		  '31INF-ISM-NP',
# 		  (SELECT degree_course_id FROM degree_course WHERE degree_course_name='Informatyka'),
# 		  (SELECT study_degree_id FROM study_degree WHERE study_degree_name='studia inzynierskie'),
# 		  (SELECT study_type_id FROM study_type WHERE study_type_name='niestacjonarne')
# 		),
#     (
#       '32INF-SSI-NP',
#       (SELECT degree_course_id FROM degree_course WHERE degree_course_name='Informatyka'),
#       (SELECT study_degree_id FROM study_degree WHERE study_degree_name='studia inzynierskie'),
# 		  (SELECT study_type_id FROM study_type WHERE study_type_name='niestacjonarne')
#     );
#


INSERT INTO user_login (login, password, permissions_id, email_address) VALUES
  ('dzawrotny','$2y$10$uax8iNWESc0uCt/d910TYu7Df78xvYZ75vM8DuJ07VDufo.c0vJhm',(SELECT permissions_id FROM user_permissions WHERE permissions_type='student'),'dzawrotny@uz.zgora.pl'), -- Pa$$w.rd - $2y$10$uax8iNWESc0uCt/d910TYu7Df78xvYZ75vM8DuJ07VDufo.c0vJhm
  ('dolbrys','$2y$10$J8a5.Sojh01hylmQvdXN1.aeBv7w.PmT4BBxMfl2bzqrjuUohMEpm',(SELECT permissions_id FROM user_permissions WHERE permissions_type='student'),'dolbrys@uz.zgora.pl'), -- h4$L.
  ('ppochanke','$2y$10$ZsLMdFhrmWEpvZhY1Q4qqeqFZKh8Fvw4HW8BCpa2NFoxXZV491V6e',(SELECT permissions_id FROM user_permissions WHERE permissions_type='student'),'ppochanke@uz.zgora.pl'), -- 21abc!@#37
  ('mraczkowski','$2y$10$G4XcXZZfP.qWjo2sO1deUuetdCM13lxf9esbWEHxruVkXWl1Jl5lu',(SELECT permissions_id FROM user_permissions WHERE permissions_type='student'),'mraczkowski@uz.zgora.pl'), -- v4ry$str0ngP4ssw.Rd
  ('admin','$2y$10$DPDCc9u5UiU.hmmljFWvMe98ZTQfQIGj43eK3XsQ0hleD.fn.Yk4e',(SELECT permissions_id FROM user_permissions WHERE permissions_type='admin'),'admin@uz.zgora.pl'), -- admin - $2y$10$DPDCc9u5UiU.hmmljFWvMe98ZTQfQIGj43eK3XsQ0hleD.fn.Yk4e
  ('kwojtylak','$2y$10$1XfKv8nKKTZZD1mD44CdyOquaZBL6WPUPP3NSOh8QvxOL2E5prXnG',(SELECT permissions_id FROM user_permissions WHERE permissions_type='lecturer'),'kwojtylak@uz.zgora.pl'), -- Abc123! - $2y$10$1XfKv8nKKTZZD1mD44CdyOquaZBL6WPUPP3NSOh8QvxOL2E5prXnG
  ('gbale','$2y$10$ohomh6sYfY/zG3RhOq1AvepzrSsqN4ICueRhAi8txICzCan/6Jc7e',(SELECT permissions_id FROM user_permissions WHERE permissions_type='lecturer'),'gbale@uz.zgora.pl'); -- H@sL0


INSERT INTO student (surname, firstname, login_id, pesel,  city, street, house_no, birth_date) VALUES
  (
    'Zawrotny',
    'Dominik',
    (SELECT login_id FROM user_login WHERE login = 'dzawrotny'),
    '86111582912',
#     (SELECT student_group.student_group_id FROM student_group WHERE student_group_name = '32INF-SSI-NP'),
    'Zielona Gora',
    'Karola Wojtyly',
    '21',
    '1986-11-15'
  ),
  (
    'Olbrys',
    'Damian',
    (SELECT login_id FROM user_login WHERE login = 'dolbrys'),
    '92063021371',
#     (SELECT student_group.student_group_id FROM student_group WHERE student_group_name = '32INF-SSI-NP'),
    'Watykan',
    'Joan Paolo',
    '37',
    '1992-06-30'
  ),
  (
    'Pochanke',
    'Pioter',
    (SELECT login_id FROM user_login WHERE login = 'ppochanke'),
    '76121941321',
#     (SELECT student_group.student_group_id FROM student_group WHERE student_group_name = '32INF-SSI-NP'),
    'Wadowice',
    'Walaszka',
    '37',
    '1976-12-29'
  ),
  (
    'Raczkowski',
    'Marcin',
    (SELECT login_id FROM user_login WHERE login = 'mraczkowski'),
    '65011347604',
#     (SELECT student_group.student_group_id FROM student_group WHERE student_group_name = '32INF-SSI-NP'),
    'Grudziadz',
    'Janusza Korwin-Mikke',
    '4/76',
    '1965-01-13'
  );

  -- wykladowca

INSERT INTO lecturer (lecturer_id,title,surname, firstname, login_id, pesel, birth_date,independent_employee) VALUES
  (
    21,
    'dr inz.',
    'Karolak',
    'Wojtylak',
    (SELECT login_id FROM user_login WHERE login = 'kwojtylak'),
    '65042021370',
    '1965-04-20',
    TRUE
  ),
  (
    37,
    'dr inz. hab.',
    'Gareth',
    'Bale',
    (SELECT login_id FROM user_login WHERE login = 'gbale'),
    '73121312731',
    '1973-12-13',
    FALSE
  );

INSERT INTO BULDING (building_id,building_name) VALUES
(
    361,
    'A-9'
),
(
    462,
    'A-29'
),
(
    946,
    'A-2'
);

INSERT INTO ROOM (room_id,room_name,PK_bulding_id) VALUES
(
    450718,
    '115',
    (SELECT building_id FROM BUILDING WHERE building_name = 'A-2' )
),
(
    450727,
    '127',
    (SELECT building_id FROM BUILDING WHERE building_name = 'A-2' )

),
(
    450753,
    '219',
    (SELECT building_id FROM BUILDING WHERE building_name = 'A-2' )

),
(
    6668,
    '12a',
    (SELECT building_id FROM BUILDING WHERE building_name = 'A-9' )

),
(
    1983,
    '15',
    (SELECT building_id FROM BUILDING WHERE building_name = 'A-9' )

),
(
    2000,
    '25',
    (SELECT building_id FROM BUILDING WHERE building_name = 'A-9' )

),
(
    1095,
    '106',
    (SELECT building_id FROM BUILDING WHERE building_name = 'A-29' )

),
(
    1269,
    '2',
    (SELECT building_id FROM BUILDING WHERE building_name = 'A-29' )

),
(
    1322,
    '207',
    (SELECT building_id FROM BUILDING WHERE building_name = 'A-29' )

);


-- #### INSERT INTO subject_group (student_group_id, subject_id, lecturer_id)  VALUES
-- #      (
-- #        (SELECT student_group_id FROM student_group WHERE student_group_name='32INF-SSI-NP'),
-- #        (SELECT subject_id FROM subject_list WHERE subject_name='Programowanie gier 3D'),
-- #        (SELECT lecturer_id FROM lecturer WHERE login_id=(SELECT login_id FROM user_login WHERE login = 'kwojtylak'))
-- #      );