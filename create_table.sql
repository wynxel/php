CREATE TABLE Books (
id INT NOT NULL AUTO_INCREMENT,
book_num INT,
book_name VARCHAR(256) NOT NULL,
book_author VARCHAR(256) NOT NULL,
book_publisher VARCHAR(256) NOT NULL,
book_year INT,
picture_url VARCHAR(512),
rating INT DEFAULT -1,
description TEXT(16384),
PRIMARY KEY (id));