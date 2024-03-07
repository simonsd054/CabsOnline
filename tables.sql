CREATE DATABASE tax_db;

CREATE TABLE user (
    email VARCHAR(50) NOT NULL,
    name VARCHAR(100),
    password VARCHAR(100),
    phone VARCHAR(50),
    PRIMARY KEY (email)
);

CREATE TABLE booking (
    booking_number INT NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    passenger_name VARCHAR(100),
    passenger_contact VARCHAR(100),
    passenger_unit_number VARCHAR(100),
    passenger_street_number VARCHAR(100),
    passenger_street_name VARCHAR(100),
    passenger_suburb VARCHAR(100),
    destination_suburb VARCHAR(100),
    pickup_time DATETIME,
    booking_time DATETIME,
    status VARCHAR(50) DEFAULT 'unassigned',
    PRIMARY KEY (booking_number),
    FOREIGN KEY (email) REFERENCES user(email)
);