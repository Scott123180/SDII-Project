/*
Purpose: Create the database and all of the tables for the limbo lost & found system
Authors: Nicholas Burd and Scott Hansen
Version: 0.2
*/
--DROP DATABASE IF EXISTS limbo_db ;
CREATE DATABASE IF NOT EXISTS limbo_db ;
USE limbo_db ;

CREATE TABLE IF NOT EXISTS admin (
	id nvarchar2(30) PRIMARY KEY,
	first_name nvarchar2(30),
	last_name nvarchar2 (30),
	salt TEXT NOT NULL, 
	password TEXT NOT NULL,
	superadmin SET ('no', 'yes')
) ;

--Need to update this with standard password security
INSERT INTO users (username, salt, password, superadmin)
VALUE ('jaredfogle', 'phluhIAC22kiuPriasw1uPoath7ab2ia' 'gaze11e', 'no'),
('thecreator', 'wrl27iutoayl4zleS38yoetluho4phoe', 'morganfreeman', 'yes') ;

CREATE TABLE IF NOT EXISTS item (
	id INT PRIMARY KEY AUTO_INCREMENT,
	finder_id INT,
	owner_id INT,
	location_id INT NOT NULL,
	create_date DATETIME NOT NULL,
	update_date DATETIME NOT NULL,
	item_lost_date DATETIME,
	item_name nvarchar2(30) NOT NULL,
	item_description nvarchar2(200) NOT NULL,
	room TEXT,
	status SET('found', 'lost', 'claimed') NOT NULL,
	item_category SET('phone/computer', 'audio/headphones', 'clothing', 'notebook/books', 'bag/backpack', 'other'),
	make TEXT,
	model TEXT,
	color TEXT,
	reward TEXT,
	item_image INT
	
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

CREATE TABLE IF NOT EXISTS finder (
	id INT PRIMARY KEY AUTO_INCREMENT,
	email nvarchar2(254) NOT NULL,
	phone int(10),
	first_name nvarchar2(30) NOT NULL,
	last_name nvarchar2(30) NOT NULL
	
) ;

CREATE TABLE IF NOT EXISTS owner (
	id INT PRIMARY KEY AUTO_INCREMENT,
	email nvarchar2(254) NOT NULL,
	phone int(10),
	first_name nvarchar2(30) NOT NULL,
	last_name nvarchar2(30) NOT NULL
	
) ;

