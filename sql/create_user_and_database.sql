CREATE USER 'memorials'@'localhost';
GRANT ALL ON db_memorials TO 'memorials'@'localhost';

# Down is important for the Website to Work in any way!
CREATE DATABASE db_memorials;

USE db_memorials;

CREATE TABLE memorials (
    id int AUTO_INCREMENT PRIMARY KEY,
    name varchar(255),
    street varchar(30),
    zip int,
    city varchar(30),
    description varchar(500)
) ENGINE=InnoDB;

CREATE TABLE pictures (
	id int AUTO_INCREMENT PRIMARY KEY,
	picsum varchar(255) NOT NULL,
	title varchar(255)
) ENGINE=InnoDB;

CREATE TABLE keywords (
	id int AUTO_INCREMENT PRIMARY KEY,
	word varchar(255) NOT NULL
) ENGINE=InnoDB;

CREATE TABLE memorialspictures (
	id int PRIMARY KEY AUTO_INCREMENT,
	picid int,
	memorialid int,
	CONSTRAINT pic4mem FOREIGN KEY (picid) REFERENCES pictures(id) ON UPDATE CASCADE ON DELETE SET NULL,
	CONSTRAINT mem4pic FOREIGN KEY (memorialid) REFERENCES memorials(id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE memorialkeyword (
	id int PRIMARY KEY AUTO_INCREMENT,
	wordid int,
	memorialid int,
	CONSTRAINT word4mem FOREIGN KEY (wordid) REFERENCES keywords(id) ON UPDATE CASCADE ON DELETE SET NULL,
	CONSTRAINT mem4word FOREIGN KEY (memorialid) REFERENCES memorials(id) ON UPDATE CASCADE ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE vars (
  id int PRIMARY KEY AUTO_INCREMENT,
  var_name varchar(255) NOT NULL,
  var_value varchar(255)
) ENGINE=InnoDB;