-- create databases
CREATE DATABASE IF NOT EXISTS mah-headless-rest;
CREATE DATABASE IF NOT EXISTS mah-headless;

-- grant access rights to user
GRANT ALL PRIVILEGES ON mah-headless-rest.* TO 'user1'@'%';
GRANT ALL PRIVILEGES ON mah-headless.* TO 'user2'@'%';