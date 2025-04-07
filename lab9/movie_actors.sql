CREATE TABLE IF NOT EXISTS `movie_actors` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `first_names` VARCHAR(100) NOT NULL,
  `last_name` VARCHAR(100) NOT NULL,
  `movie_title` VARCHAR(255) NOT NULL,
  INDEX `idx_names` (`last_name`, `first_names`),
  INDEX `idx_movie` (`movie_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Sample data
INSERT INTO `movie_actors` (`first_names`, `last_name`, `movie_title`) VALUES
('Chris', 'Hemsworth', 'Elizabeth'),
('Scarlett', 'Johansson', 'Black Widow'),
('George', 'Clooney', 'Oh Brother Where Art Thou?'),
('Elijah', 'Wood', 'The Lord of the Rings: The Fellowship of the Ring'),
('Anna', 'Kendrick', 'Up in the Air'),
('Tom', 'Hanks', 'The Godfather'),
('Robert', 'Duvall', 'The Godfather'),
('Morgan', 'Freeman', 'The Godfather');