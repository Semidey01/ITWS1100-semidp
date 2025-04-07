CREATE TABLE IF NOT EXISTS `movie_actors` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `last_name` VARCHAR(100) NOT NULL,
  `title` VARCHAR(255) NOT NULL,
  UNIQUE KEY `unique_relationship` (`last_name`, `title`),
  INDEX `idx_last_name` (`last_name`),
  INDEX `idx_movie` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;