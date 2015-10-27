CREATE DATABASE db_memorials;
CREATE USER 'memorials'@'localhost';

GRANT ALL ON db_memorials FOR 'memorials'@'localhost';

USE db_memorials;

CREATE TABLE memorials (
    id int AUTO_INCEMENT PRIMARY KEY,
    name varchar(30),
    street varchar(30),
    zip int,
    city varchar(30),
    description varchar(255)    
) ENGINE=InnoDB;

CREATE TABLE pictures (
	id int AUTO_INCEMENT PRIMARY KEY,
	picsum varchar(255) NOT NULL,
	title varchar(255)
) ENGINE=InnoDB;

CREATE TABLE keywords (
	id int AUTO_INCEMENT PRIMARY KEY,
	word varchar(255) NOT NULL,
) ENGINE=InnoDB;

CREATE TABLE memorialspictures (
	picid int,
	memorialid int,
	PRIMARY KEY(picid, memorialid),
	CONSTRAINT pic4mem FOREIGN KEY (picid) REFERENCES pictures(id) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT mem4pic FOREIGN KEY (memorialid) REFERENCES memorials(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE memorialkeyword (
	wordid int,
	memorialid int,
	PRIMARY KEY(wordid, memorialid),
	CONSTRAINT word4mem FOREIGN KEY (wordid) REFERENCES keywords(id) ON UPDATE CASCADE ON DELETE CASCADE,
	CONSTRAINT mem4word FOREIGN KEY (memorialid) REFERENCES memorials(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;