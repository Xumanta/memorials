CREATE DATABASE db_memorials;
CREATE USER 'memorials'@'localhost';

GRANT ALL ON db_memorials FOR 'memorials'@'localhost';

USE db_memorials;

CREATE TABLE memorials (
    id int NOT NULL AUTO_INCEMENT,
    name varchar(30),
    street varchar(30),
    zip int,
    city varchar(30),
    description varchar(255)    
);
