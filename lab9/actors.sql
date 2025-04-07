CREATE TABLE `actors` (
   `actorid` int(10) unsigned NOT NULL AUTO_INCREMENT,
   `first_names` varchar(40) NOT NULL,
   `last_name` char(40) DEFAULT NULL,
   `dob` date DEFAULT NULL,
   PRIMARY KEY (`actorid`)
);
-- insert data into the tables
INSERT INTO actors
VALUES (1, "Christ", "Hemsworth", "1983-08-11"),
   (2, "Scarlett", "Johansson", "1984-11-22"),
   (3, "George", "Clooney", "1961-05-06"),
   (4, "Elijah", "Wood", "1981-01-28"),
   (5, "George", "Clooney", "1961-05-06"),
   (6, "Anna", "Kendrick", "1985-08-09"),
   (7, "Bradley", "Cooper", "1975-01-05"),
   (8, "Joaquin", "Phoenix", "1974-10-28"),
   (9, "Natalie", "Portman", "1981-06-09"),
   (10, "Tom", "Hanks", "1956-07-09");
   