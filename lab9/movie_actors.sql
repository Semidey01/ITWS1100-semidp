CREATE TABLE IF NOT EXISTS `movie_actors` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `last_name` VARCHAR(100) NOT NULL,
  `movie_title` VARCHAR(255) NOT NULL,
  INDEX `idx_last_name` (`last_name`),
  INDEX `idx_movie` (`movie_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;