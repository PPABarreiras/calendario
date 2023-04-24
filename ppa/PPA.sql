CREATE SCHEMA ppa;
USE ppa;

CREATE TABLE course(
	id_course INTEGER AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(50) NOT NULL UNIQUE,
    created_at DATETIME NOT NULL,
	updated_at DATETIME
);

CREATE TABLE class(
	id_class INTEGER AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(50) NOT NULL,
    period VARCHAR(6) NOT NULL,
    id_course INTEGER NOT NULL,
    created_at DATETIME NOT NULL,
	updated_at DATETIME,
    FOREIGN KEY (id_course) REFERENCES course(id_course)
);

CREATE TABLE matter(
	id_matter INTEGER AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(50) NOT NULL,
    id_class INTEGER NOT NULL,
    FOREIGN KEY (id_class) REFERENCES class(id_class)
);


CREATE TABLE admin(
	id_admin INTEGER AUTO_INCREMENT PRIMARY KEY,
    siape VARCHAR(15) NOT NULL UNIQUE,
    name VARCHAR(60) NOT NULL,
    email VARCHAR(60) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    admin INTEGER NOT NULL,
    active INTEGER,
    created_at DATETIME NOT NULL,
	updated_at DATETIME
);

CREATE TABLE teacher(
	id_teacher INTEGER AUTO_INCREMENT PRIMARY KEY,
    siape VARCHAR(15) NOT NULL UNIQUE,
    name VARCHAR(60) NOT NULL,
    email VARCHAR(60) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    active INTEGER,
    created_at DATETIME NOT NULL,
	updated_at DATETIME
);

CREATE TABLE teacher_matter(
	id_teacher  INTEGER NOT NULL,
    id_matter INTEGER NOT NULL,
    PRIMARY KEY(id_teacher, id_matter),
    FOREIGN KEY (id_teacher) REFERENCES teacher(id_teacher),
    FOREIGN KEY (id_matter) REFERENCES matter(id_matter)
);

CREATE TABLE teacher_course(
	id_teacher  INTEGER NOT NULL,
    id_course INTEGER NOT NULL,
    id_class INTEGER NOT NULL,
    PRIMARY KEY(id_teacher, id_class, id_course),
    FOREIGN KEY (id_teacher) REFERENCES teacher(id_teacher),
    FOREIGN KEY (id_course) REFERENCES course(id_course),
    FOREIGN KEY (id_class) REFERENCES class(id_class)
);

CREATE TABLE student(
	id_student INTEGER AUTO_INCREMENT PRIMARY KEY,
    registration VARCHAR(20) NOT NULL UNIQUE,
    name VARCHAR(60) NOT NULL,
    email VARCHAR(60) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    id_class INTEGER NOT NULL,
    active INTEGER,
    created_at DATETIME NOT NULL,
	updated_at DATETIME,
    FOREIGN KEY (id_class) REFERENCES class(id_class) 
);


CREATE TABLE student_matter(
    id_student INTEGER NOT NULL,
    id_matter INTEGER NOT NULL,
    PRIMARY KEY (id_student, id_matter),
    FOREIGN KEY (id_student) REFERENCES student(id_student),
	FOREIGN KEY (id_matter) REFERENCES matter(id_matter)
);

CREATE TABLE type(
    id_type INTEGER AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(60) UNIQUE
);

CREATE TABLE job(
	id_job INTEGER AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(60) NOT NULL,
    description VARCHAR(60) NOT NULL,
    deadline datetime NOT NULL,
    id_type INTEGER NOT NULL,
    created_at DATETIME NOT NULL,
    note DECIMAL(5,2),
	updated_at DATETIME,
    FOREIGN KEY (id_type) REFERENCES type(id_type) 
);

CREATE TABLE job_matter(
	id_job INTEGER,
    id_matter INTEGER,
    PRIMARY KEY (id_job, id_matter),
    FOREIGN KEY (id_job) REFERENCES job(id_job),
    FOREIGN KEY (id_matter) REFERENCES matter(id_matter)
);


CREATE TABLE vacant_classes(
	id_vacant_class INTEGER AUTO_INCREMENT PRIMARY KEY,
    id_class INTEGER,
    id_teacher INTEGER,
    id_matter INTEGER,
    start TIME,
    end TIME,
    date Date,
    captured BOOLEAN,
    FOREIGN KEY (id_class) REFERENCES class(id_class),
    FOREIGN KEY (id_teacher) REFERENCES teacher(id_teacher),
    FOREIGN KEY (id_matter) REFERENCES matter(id_matter)
);


CREATE TABLE captured_vacant_classes(
	id_captured_class INTEGER AUTO_INCREMENT PRIMARY KEY,
    id_vacant_class INTEGER,
    id_teacher INTEGER,
    id_matter INTEGER,
    description VARCHAR(255),
    FOREIGN KEY (id_teacher) REFERENCES teacher(id_teacher),
    FOREIGN KEY (id_matter) REFERENCES matter(id_matter)
);


CREATE TABLE alert_day(
    id_alert_day INTEGER AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(60),
    date Date
);


CREATE TABLE horary_class(
    id_horary_class INTEGER AUTO_INCREMENT PRIMARY KEY,
    id_teacher INTEGER,
    id_matter INTEGER,
    day VARCHAR(20),
    start Time, 
    end Time,
    FOREIGN KEY (id_teacher) REFERENCES teacher(id_teacher),
    FOREIGN KEY (id_matter) REFERENCES matter(id_matter)    
);




