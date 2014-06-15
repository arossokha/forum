CREATE DATABASE forumcamo COLLATE utf8_general_ci;
use forumcamo;
CREATE USER 'forumcamo'@'localhost' IDENTIFIED BY  'forumcamo';
GRANT ALL PRIVILEGES ON  `forumcamo` . * TO  'forumcamo'@'localhost';