CREATE DATABASE taxi_db;

USE taxi_db;

CREATE TABLE user (
    email VARCHAR(50) NOT NULL,
    name VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    PRIMARY KEY (email)
);

CREATE TABLE booking (
    booking_number VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    name VARCHAR(100) NOT NULL,
    contact VARCHAR(100) NOT NULL,
    unit_number VARCHAR(10),
    street_number VARCHAR(10) NOT NULL,
    street_name VARCHAR(100) NOT NULL,
    passenger_suburb VARCHAR(50) NOT NULL,
    destination_suburb VARCHAR(50) NOT NULL,
    pickup_time DATETIME NOT NULL,
    booking_time DATETIME NOT NULL,
    status VARCHAR(50) DEFAULT 'unassigned' NOT NULL,
    PRIMARY KEY (booking_number),
    FOREIGN KEY (email) REFERENCES user(email)
);