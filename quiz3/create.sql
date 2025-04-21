-- Table for storing lab information
CREATE TABLE myLabs (
    lab_id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- 2-byte primary key
    lab_name VARCHAR(100) NOT NULL,
    lab_readme VARCHAR(255),
    lab_page VARCHAR(255)
);

INSERT INTO myLabs (lab_name, lab_readme, lab_page) VALUES
('Lab 1 - GitHub and Azure VM Setup', '../../Lab 1/README.md', '../../Lab 1/semidp-AzureStatus.png'),
('Lab 2 - Create Your Resume', '../../Lab2/README.md', '../../Lab2/Resume.html'),
('Lab 3 - Create a Website', '../Lab 3/README.md', '../../index.php'),
('Lab 4 - XML (RSS and Atom)', '../../lab4/README.md', '../../lab4/labs-rss.xml'),
('Lab 5 - JavaScript Form', '../../lab5/README.md', '../../lab5/lab5.html'),
('Lab 6 - JQuery Practice', '../../lab6/README.md', '../../lab6/lab6.html'),
('Lab 7 - Term Project Mockup', '../../lab7/README.md', '../../../../team12/html/homepage.html'),
('Lab 8 - JSON and AJAX', '../../lab8/README.md', '../../lab8/menu.json'),
('Lab 9 - PHP and MySQL', '../../lab9/README.md', '../../lab9/inclassexample/index.php'),
('Lab 10 - Move Servers to Production', '../../lab10/README.md', '../../lab10/index.php');

-- Table for storing project information
CREATE TABLE myProjects (
    project_id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- 2-byte primary key
    project_name VARCHAR(100) NOT NULL,
    project_page VARCHAR(255)
); 

INSERT INTO myProjects (project_name, project_page) VALUES
('ITWS Term Project', '../../../../team12/html/homepage.html');

-- Table for footer content
CREATE TABLE myFooter (
    footer_id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- 2-byte primary key
    copyright_text VARCHAR(255) NOT NULL,
    contact_email VARCHAR(100)
);

INSERT INTO myFooter (copyright_text, contact_email) VALUES
('© 2025 Pablo Semidey. All rights reserved.', 'pablo@example.com');

-- Table for site users
CREATE TABLE mySiteUsers (
    user_id SMALLINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,  -- 2-byte primary key
    username VARCHAR(50) NOT NULL UNIQUE,
    user_password VARCHAR(255) NOT NULL,  -- Store hashed passwords only
    user_role ENUM('admin', 'viewer') DEFAULT 'viewer'
);

-- Note: In production, always store hashed passwords, not plain text
INSERT INTO mySiteUsers (username, user_password, user_role) VALUES
('pablo', 'password', 'admin'),  -- password is 'password'
('random', 'password123', 'viewer');  -- password is 'password123'