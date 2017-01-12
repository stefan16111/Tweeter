/**
 * Author:  Marcin
 * Created: 2016-08-28
 */
CREATE TABLE users (
        id INT AUTO_INCREMENT,
        email VARCHAR(100) NOT NULL UNIQUE, 
        username VARCHAR(100) NOT NULL,
        hashpassword VARCHAR(255) NOT NULL,
        PRIMARY KEY(id)) ENGINE = InnoDB;

CREATE TABLE tweet (id INT AUTO_INCREMENT, 
        userId INT NOT NULL, 
        text TEXT NOT NULL, 
        creationDate DATE NOT NULL, 
        PRIMARY KEY(id), 
        FOREIGN KEY(userId) REFERENCES users(id)) ENGINE = InnoDB;


