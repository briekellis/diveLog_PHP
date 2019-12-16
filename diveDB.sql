CREATE DATABASE diveLog;
USE diveLog;

CREATE TABLE diver_name (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    date_added DATETIME,
    date_modified DATETIME,
    f_name VARCHAR (75),
    l_name VARCHAR (75)
);

CREATE TABLE lake (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,    
    master_id INT NOT NULL,
    date_added DATETIME,
    date_modified DATETIME,
    lake_name VARCHAR (255),
    address VARCHAR (255),
    city VARCHAR (30),
    state CHAR (2),
    zipcode VARCHAR (10)
);

CREATE TABLE dive_buddy (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,    
    master_id INT NOT NULL,
    date_added DATETIME,
    date_modified DATETIME,
    buddy_name VARCHAR (50)
);

CREATE TABLE charter (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,    
    master_id INT NOT NULL,
    date_added DATETIME,
    date_modified DATETIME,
    contact_number VARCHAR (25)
);

CREATE TABLE email (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,    
    master_id INT NOT NULL,
    date_added DATETIME,
    date_modified DATETIME,
    email VARCHAR (150),
    type ENUM ('home', 'work', 'other')
);

CREATE TABLE personal_notes (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,    
    master_id INT NOT NULL,
    date_added DATETIME,
    date_modified DATETIME,
    note TEXT
);

CREATE TABLE auth_users (
    id int NOT NULL PRIMARY KEY,
    f_name VARCHAR(50),
    l_name VARCHAR(50),
    email VARCHAR(150),
    username VARCHAR(25),
    password VARCHAR(41)
);

INSERT INTO auth_users VALUES ( ID, 'Brie', 'Ellis','briekellis@gmail.com', 'briekellis', 'Lavender115');