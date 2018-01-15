CREATE DATABASE kazi_projects;
use kazi_projects;

CREATE TABLE tbl_kazi_domain (
	domain_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	domain_name VARCHAR(255) NOT NULL,
	hosting VARCHAR(1),
	hosting_date DATE,
	expiry_date DATE
);

