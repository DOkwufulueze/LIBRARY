create database lib;

USE lib;

CREATE TABLE IF NOT EXISTS admin(
USERNAME varchar(15),
PASSWORD varchar(32)
);

CREATE TABLE IF NOT EXISTS users(
USERNAME VARCHAR(80),
SURNAME VARCHAR(80),
FIRST_NAME VARCHAR(80),
TITLE VARCHAR(5),
MATRIC_NUMBER VARCHAR(12),
FACULTY VARCHAR(30),
DEPARTMENT VARCHAR(80),
SEX VARCHAR(80),
EMAIL VARCHAR(80),
PHONE_NUMBER VARCHAR(80),
ADDRESS VARCHAR(80),
NATIONALITY VARCHAR(80)
);

CREATE TABLE IF NOT EXISTS books(
TITLE VARCHAR(200),
AUTHOR VARCHAR(200),
ISBN VARCHAR(200),
CALL_NUMBER VARCHAR(200),
QUANTITY VARCHAR(200),
EDITION VARCHAR(200),
PUBLISHER VARCHAR(200),
DATE_RECEIVED date
);

CREATE TABLE IF NOT EXISTS today(
DAY char(3)
);
# insert into today(DAY) values('-1');

CREATE TABLE IF NOT EXISTS borrow(
SN int(6) auto_increment,
USERNAME varchar(120),
BOOK varchar(200),
AUTHOR VARCHAR(200),
EDITION varchar(50),
DATE_ORDERED varchar(30),
DATE_RETURNED varchar(30),
DAY char(3),
STATUS char(15),
constraint pk primary key(SN)
);

CREATE TABLE IF NOT EXISTS uploads(
ID INT auto_increment,
BOOK varchar(200),
BOOK_TITLE varchar(200),
AUTHOR VARCHAR(200),
EDITION varchar(50),
FIELD VARCHAR(200),
SUBFIELD VARCHAR(200),
USAGE_COUNT INT,
DATE date,
constraint pk primary key(ID)
);

CREATE TABLE IF NOT EXISTS fields(
ID INT auto_increment,
FIELD VARCHAR(200),
SUBFIELD VARCHAR(200),
constraint pk primary key(ID)
);

INSERT INTO admin(USERNAME,PASSWORD)
VALUES
('smart',md5('smart'));

INSERT INTO fields(FIELD,SUBFIELD)
VALUES
('Arts','Dance'),
('Arts','Literature'),
('Arts','English Language'),
('Arts','Philosophy'),
('Arts','Mass Communications'),
('Arts','Theatre Arts'),
('Arts','Music'),
('Arts','Languages'),
('Engineering','Chemical Engineering'),
('Engineering','Computer Engineering'),
('Engineering','Electrical Engineering'),
('Engineering','Mechanical Engineering'),
('Fiction','Science Fiction'),
('Fiction','Warfare'),
('Fiction','Novels'),
('Fiction','Paranormals'),
('Kiddies','Fairies'),
('Management Science','Accounting'),
('Management Science','Marketing'),
('Management Science','Banking and Finance'),
('Science','Biochemistry'),
('Science','Botany'),
('Science','Chemistry'),
('Science','Computer Science'),
('Science','Mathematics'),
('Science','Microbiology'),
('Science','Physics'),
('Science','Zoology'),
('Social Science','Economics'),
('Social Science','Psychology'),
('Social Science','Sociology'),
('Social Science','Political Science')
;

