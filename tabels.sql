CREATE DATABASE VOTE_NOW;

CREATE TABLE SESSIONS(SESSION_ID INT NOT NULL AUTO_INCREMENT, SESSION_USER_ID INT, SESSION_TOKEN VARCHAR(50), SESSION_USER_TYPE VARCHAR(50), PRIMARY KEY(SESSION_ID));

CREATE TABLE RESET_PASSWORDS(RESET_PASSWORD_ID INT NOT NULL PRIMARY KEY, RESET_PASSWORD_EMAIL VARCHAR(50), RESET_PASSWORD_SELECTOR VARCHAR(50), RESET_PASSWORD_TOKEN LONGTEXT, RESET_PASSWORD_EXPIRE LONGTEXT);

CREATE TABLE USERS(USER_ID INT NOT NULL AUTO_INCREMENT, USER_FIRSTNAME VARCHAR(50), USER_LASTNAME VARCHAR(50), USER_EMAIL VARCHAR(50), USER_PASSWORD VARCHAR(255), USER_PROFILE LONGBLOB, PRIMARY KEY(USER_ID));

CREATE TABLE STUDENTS(STUDENT_ID INT NOT NULL AUTO_INCREMENT, STUDENT_PRN INT, STUDENT_FIRSTNAME VARCHAR(50), STUDENT_LASTNAME VARCHAR(50), STUDENT_EMAIL VARCHAR(50), STUDENT_CONTACT VARCHAR(20), STUDENT_PASSWORD VARCHAR(255), STUDENT_PROFILE LONGBLOB, COURSE_ID INT, STUDENT_ACADEMIC_YEAR_START VARCHAR(20), STUDENT_ACADEMIC_YEAR_END VARCHAR(20), PRIMARY KEY(STUDENT_ID), FOREIGN KEY(COURSE_ID) REFERENCES COURSES(COURSE_ID) ON DELETE SET NULL);

CREATE TABLE DEPARTMENTS(DEPARTMENT_ID INT NOT NULL AUTO_INCREMENT, DEPARTMENT_NAME VARCHAR(50), PRIMARY KEY(DEPARTMENT_ID));

CREATE TABLE COURSES(COURSE_ID INT NOT NULL AUTO_INCREMENT, DEPARTMENT_ID INT, COURSE_NAME VARCHAR(50), PRIMARY KEY(COURSE_ID), FOREIGN KEY(DEPARTMENT_ID) REFERENCES DEPARTMENTS(DEPARTMENT_ID) ON DELETE CASCADE);

CREATE TABLE POSITIONS(POSITION_ID INT NOT NULL AUTO_INCREMENT, POSITION_NAME VARCHAR(50), PRIMARY KEY(POSITION_ID));

CREATE TABLE CANDIDATES(CANDIDATE_ID INT NOT NULL AUTO_INCREMENT, STUDENT_ID INT, ELECTION_ID INT, PRIMARY KEY(CANDIDATE_ID), FOREIGN KEY(STUDENT_ID) REFERENCES STUDENTS(STUDENT_ID), FOREIGN KEY(ELECTION_ID) REFERENCES ELECTIONS(ELECTION_ID) ON DELETE CASCADE);

CREATE TABLE ELECTIONS(ELECTION_ID INT NOT NULL AUTO_INCREMENT, POSITION_ID INT, COURSE_ID INT, ELECTION_DATE VARCHAR(50), ELECTION_START_TIME VARCHAR(20), ELECTION_END_TIME VARCHAR(20), PRIMARY KEY(ELECTION_ID), FOREIGN KEY(POSITION_ID) REFERENCES POSITIONS(POSITION_ID), FOREIGN KEY(COURSE_ID) REFERENCES COURSES(COURSE_ID) ON DELETE SET NULL);

CREATE TABLE VOTES(VOTE_ID INT NOT NULL AUTO_INCREMENT, ELECTION_ID INT, CANDIDATE_ID INT, NO_OF_VOTES INT, STUDENT_ID INT, PRIMARY KEY(VOTE_ID), FOREIGN KEY(ELECTION_ID) REFERENCES ELECTIONS(ELECTION_ID), FOREIGN KEY(CANDIDATE_ID) REFERENCES CANDIDATES(CANDIDATE_ID), FOREIGN KEY(STUDENT_ID) REFERENCES STUDENTS(STUDENT_ID) ON DELETE SET NULL);