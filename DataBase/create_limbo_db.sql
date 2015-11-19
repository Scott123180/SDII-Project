/*
Purpose: Create the database and all of the tables for the limbo lost & found system
Authors: Nicholas Burd and Scott Hansen
Version: 0.1
*/
DROP DATABASE IF EXISTS limbo_db ;
CREATE DATABASE IF NOT EXISTS limbo_db ;
USE limbo_db ;

CREATE TABLE IF NOT EXISTS users (
	id INT PRIMARY KEY AUTO_INCREMENT,
	username TEXT,
	password TEXT
) ;

INSERT INTO users (username, password)
VALUE ('admin', 'gaze11e') ;

CREATE TABLE IF NOT EXISTS stuff (
	id INT PRIMARY KEY AUTO_INCREMENT,
	location_id INT NOT NULL,
	description TEXT NOT NULL,
	create_date DATETIME NOT NULL,
	update_date DATETIME NOT NULL,
	room TEXT,
	owner TEXT,
	finder TEXT,
	status SET('found', 'lost', 'claimed') NOT NULL
) ;

--Default value for lat and long are set to zero as mock values for now
CREATE TABLE IF NOT EXISTS locations (
	id INT PRIMARY KEY AUTO_INCREMENT,
	latitude FLOAT(2,6) NOT NULL DEFAULT (00.000000),
	longitude FLOAT(2,6) NOT NULL DEFAULT (00.000000),
	name TEXT NOT NULL
) ;

INSERT INTO locations (name)
VALUE 
('byrne house'), 
('james a. cannavino library'), 
('champagnat hall'), 
('our lady seat of wisdom chapel'), 
('cornell boathouse'), 
('donnelly hall'), 
('margaret m. and charles h. dyson center'), 
('fern tor'), 
('fontaine annex'), 
('fontaine hall'), 
('foy townhouses'), 
('fulton street townhouses'), 
('lower fulton townhouses'), 
('gartland appartments'), 
('greystone hall'), 
('hancock center'), 
('kieran gatehouse'), 
('kirk house'), 
('leo hall'), 
('longview park'), 
('lowell thomas communications center'), 
('marian hall'), 
('marist boathouse'), 
('james j. mccann recreational center'), 
('mid-rise hall'), 
('st. ann\'s hermitage'), 
('st. peter\'s'), 
('sheahan hall'), 
('steel plant art sudios and gallery'), 
('student center/rotunda'), 
('tennis pavilion'), 
('tenney stadium'), 
('lower townhouses'), 
('lower west cedar townhouses'), 
('upper west cedar townhouses') ;