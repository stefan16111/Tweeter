/**
 * Author:  Marcin
 * Created: 2016-08-28
 */
CREATE TABLE Users (
        id INT PRIMARY KEY AUTO_INCREMENT,
        email VARCHAR(100) NOT NULL UNIQUE, 
        username VARCHAR(100) NOT NULL,
        hashpassword VARCHAR(255) NOT NULL);


