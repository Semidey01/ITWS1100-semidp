CREATE TABLE IF NOT EXISTS `movie_actors` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `first_names` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `movie_title` VARCHAR(255) NOT NULL,
  `year` INT,
  INDEX `idx_names` (`last_name`, `first_names`),
  INDEX `idx_movie` (`movie_title`)
);