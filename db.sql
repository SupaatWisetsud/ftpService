CREATE DATABASE db_ftp;

CREATE TABLE tb_account(
	ac_id INT PRIMARY KEY AUTO_INCREMENT,
    ac_username VARCHAR(50) NOT NULL,
    ac_password VARCHAR(255) NOT NULL,
    ac_fristname VARCHAR(60) NOT NULL,
    ac_lastname VARCHAR(60) NOT NULL,
    ac_email VARCHAR(50) NOT NULL,
    ac_img VARCHAR(250),
    ac_status VARCHAR(1) DEFAULT 'u'
);