CREATE DATABASE DB_VACCINECOMPANY;

use DB_VACCINECOMPANY;

CREATE TABLE HOSPITAL(
	HOSPITALID INT PRIMARY KEY AUTO_INCREMENT,
	HOSPITAL_NAME VARCHAR(100) NOT NULL UNIQUE,
	HOSPITAL_ADDRESS VARCHAR(100) NOT NULL UNIQUE,
	HOSPITAL_CONTACTNUMBER VARCHAR(100) NOT NULL UNIQUE  ,
	HOSPITAL_EMAIL VARCHAR(100) NOT NULL,
	HOSPITAL_PASSOWRD VARCHAR(100)

);

CREATE TABLE VACCINE(
	VACCINEID INT PRIMARY KEY AUTO_INCREMENT,
	VACCINE_NAME VARCHAR(100) NOT NULL UNIQUE,
	VACCINE_ISSUEDATE DATE NOT NULL,
	VACCINE_EXPIREDATE DATE NOT NULL,
	VACCINE_STATUS VARCHAR(100), -- AVAILABLE / NOT AVAILABLE
	VACCINE_DESC VARCHAR(100) NOT NULL
);

CREATE TABLE PARENT(
	PARENTID INT  PRIMARY KEY AUTO_INCREMENT,
	PARENT_NAME VARCHAR(100) NOT NULL,
	PARENT_CNIC VARCHAR(100) UNIQUE NOT NULL,
	PARENT_EMAIL VARCHAR(100) NOT NULL,
	PARENT_PASSWORD VARCHAR(100)
);

CREATE TABLE CHILDREN(
	CHILDRENID INT PRIMARY KEY AUTO_INCREMENT,
	CHILDREN_NAME VARCHAR(100) NOT NULL,
	CHILDREN_DATEOFBIRTH DATE NOT NULL,
	PARENTID INT NOT NULL,
	FOREIGN KEY (PARENTID) REFERENCES PARENT(PARENTID)
);



CREATE TABLE REQUEST(
	REQUESTID INT PRIMARY KEY AUTO_INCREMENT,
	CHILDRENID INT NOT NULL,
	VACCINEID INT NOT NULL,
	HOSPITALID INT NOT NULL,
	STATUS VARCHAR(100), -- APPROVE OR REJECTED
	FOREIGN KEY (CHILDRENID) REFERENCES CHILDREN(CHILDRENID),
	FOREIGN KEY (VACCINEID) REFERENCES VACCINE(VACCINEID),
	FOREIGN KEY (HOSPITALID) REFERENCES HOSPITAL(HOSPITALID)
);

CREATE TABLE APPOINTMENT(
	APPOINTMENTID INT PRIMARY KEY AUTO_INCREMENT,
	CHILDRENID INT NOT NULL,
	VACCINEID INT NOT NULL,
	HOSPITALID INT NOT NULL,
	RESULT VARCHAR(100), -- VACCINATED AUR NOT VACCINATED
	REPORT VARCHAR(100),
	FOREIGN KEY (CHILDRENID) REFERENCES CHILDREN(CHILDRENID),
	FOREIGN KEY (VACCINEID) REFERENCES VACCINE(VACCINEID),
	FOREIGN KEY (HOSPITALID) REFERENCES HOSPITAL(HOSPITALID)
);

CREATE TABLE ADMIN(
ADMINid INT PRIMARY KEY AUTO_INCREMENT,
ADMIN_NAME VARCHAR(100) NOT NULL,
ADMIN_EMAILID VARCHAR(100) VARCHAR(100) NOT NULL,
ADMIN_PASSWORD VARCHAR(100) NOT NULL,

);