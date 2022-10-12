CREATE DATABASE IF NOT EXISTS appDB DEFAULT CHARACTER SET utf8;
CREATE USER IF NOT EXISTS 'user' @'%' IDENTIFIED BY 'password';
GRANT SELECT,
    UPDATE,
    INSERT ON appDB.* TO 'user' @'%';
FLUSH PRIVILEGES;
USE appDB;
-- Tables
CREATE TABLE IF NOT EXISTS users (
    ID INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(20) NOT NULL,
    password VARCHAR(40) NOT NULL,
    PRIMARY KEY (ID)
);
CREATE TABLE IF NOT EXISTS dishes (
    ID INT(10) NOT NULL AUTO_INCREMENT,
    title VARCHAR(32) NOT NULL,
    description VARCHAR(256) NOT NULL,
    cost INT(6) NOT NULL,
    PRIMARY KEY (ID)
);
-- Admin
INSERT INTO users (name, password)
SELECT *
FROM (
        SELECT 'iamadmin',
            'mypass'
    ) AS temp
WHERE NOT EXISTS (
        SELECT name
        FROM users
        WHERE name = 'iamadmin'
            AND password = 'mypass'
    )
LIMIT 1;
-- Dishes
INSERT INTO dishes (title, description, cost)
SELECT *
FROM (
        SELECT 'Ravioli',
            'Italian dumpling that is typically stuffed with ricotta, meat, cheese, and vegetables',
            520
    ) AS temp
WHERE NOT EXISTS (
        SELECT title
        FROM dishes
        WHERE title = 'Ravioli'
            AND description = 'Italian dumpling that is typically stuffed with ricotta, meat, cheese, and vegetables'
            AND cost = 599
    )
LIMIT 1;
INSERT INTO dishes (title, description, cost)
SELECT *
FROM (
        SELECT 'Lasagna',
            'A type of pasta, possibly one of the oldest types, made of very wide, flat sheets',
            999
    ) AS temp
WHERE NOT EXISTS (
        SELECT title
        FROM dishes
        WHERE title = 'Lasagna'
            AND description = 'A type of pasta, possibly one of the oldest types, made of very wide, flat sheets'
            AND cost = 999
    )
LIMIT 1;
INSERT INTO dishes (title, description, cost)
SELECT *
FROM (
         SELECT 'Pizza',
                'A flatbread generally topped with tomato sauce and cheese and baked in an oven',
                899
     ) AS temp
WHERE NOT EXISTS (
        SELECT title
        FROM dishes
        WHERE title = 'Pizza'
          AND description = 'A flatbread generally topped with tomato sauce and cheese and baked in an oven'
          AND cost = 899
    )
    LIMIT 1;