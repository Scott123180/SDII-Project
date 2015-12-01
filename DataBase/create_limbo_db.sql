/*
Purpose: Create the database and all of the tables for the limbo lost & found system
Authors: Nicholas Burd and Scott Hansen
Version: 0.2
*/

/* Create the database and drop it for testing purposes */
DROP DATABASE IF EXISTS limbo_db ;
CREATE DATABASE IF NOT EXISTS limbo_db ;
USE limbo_db ;

/*Limbo admin profile table*/
CREATE TABLE IF NOT EXISTS admin (
	username VARCHAR(30) PRIMARY KEY,
	first_name VARCHAR(30),
	last_name VARCHAR (30),
	salt VARCHAR(32) NOT NULL, 
	password VARCHAR(40) NOT NULL,
	superadmin SET ('no', 'yes')
) ;

/* Need to update this with standard password security */
INSERT INTO admin (username, salt, password, superadmin)
VALUE ('jaredfogle', 'phluhIAC22kiuPriasw1uPoath7ab2ia', 'gaze11e', 'no'),
('thecreator', 'wrl27iutoayl4zleS38yoetluho4phoe', 'morganfreeman', 'yes') ;


/*Default value for lat and long are set to zero as mock values for now */
CREATE TABLE IF NOT EXISTS locations (
	id INT PRIMARY KEY AUTO_INCREMENT,
	latitude FLOAT(8,6) NOT NULL,
	longitude FLOAT(8,6) NOT NULL,
	name TEXT NOT NULL
) ;

INSERT INTO locations (name, latitude, longitude)
VALUE 
('byrne house', 41.720002, -73.936670), 
('james a. cannavino library', 41.721940, -73.934119), 
('champagnat hall', 41.720286, -73.935659), 
('our lady seat of wisdom chapel', 41.722082, -73.933511), 
('cornell boathouse', 41.721343, -73.938350), 
('donnelly hall', 41.720829, -73.932486), 
('margaret m. and charles h. dyson center', 41.724151, -73.933035), 
('fern tor', 41.728302, -73.934798),  
('fontaine hall', 41.725528, -73.932967), 
('foy townhouses', 41.725528, -73.932967), 
('fulton street townhouses', 41.722483, -73.926609), 
('lower fulton townhouses', 41.722493, -73.928573), 
('gartland appartments', 41.726274, -73.934242), 
('greystone hall', 41.721399, -73.933849), 
('hancock center', 41.722681, -73.934486), 
('kieran gatehouse', 41.721871, -73.931897), 
('kirk house', 41.723714, -73.935178), 
('leo hall', 41.719404, -73.936460), 
('longview park', 41.719407, -73.936424), 
('lowell thomas communications center', 41.723252, -73.932821), 
('marian hall', 41.721067, -73.934274), 
('marist boathouse', 41.720709, -73.938470), 
('james j. mccann recreational center', 41.717455, -73.935352), 
('mid-rise hall', 41.721544, -73.936046), 
('st. anns hermitage', 41.728123, -73.934419),
('st. peters', 41.722517, -73.932738),
('sheahan hall', 41.719105, -73.935721), 
('steel plant art sudios and gallery', 41.721449, -73.931003), 
('student center/rotunda', 41.721449, -73.931003), 
('tennis pavilion', 41.722270, -73.927711), 
('tenney stadium', 41.719133, -73.932941), 
('lower townhouses', 41.722742, -73.935359), 
('lower west cedar townhouses', 41.720434, -73.929761), 
('upper west cedar townhouses', 41.720735, -73.926065) ;

/*Lost and found items*/
CREATE TABLE IF NOT EXISTS item (
	id INT PRIMARY KEY AUTO_INCREMENT,
	finder_id INT,
	owner_id INT,
	location_id INT NOT NULL,
	create_date DATETIME NOT NULL DEFAULT NOW(),
	update_date DATETIME NOT NULL DEFAULT NOW(),
	item_lost_date DATETIME,
	item_name VARCHAR(30) NOT NULL,
	item_description VARCHAR(200) NOT NULL,
	room TEXT,
	status SET('found', 'lost', 'claimed') NOT NULL,
	item_category SET('phone or computer', 'audio or headphones', 'clothing', 'notebook or books', 'bag or backpack', 'other'),
	make TEXT,
	model TEXT,
	color TEXT,
	reward INT,
	item_image VARCHAR(254)
) ;

INSERT INTO item (finder_id, owner_id, location_id, item_lost_date, item_name, item_description, room, status, item_category, make, model, color, reward, item_image)
VALUE (0, 0, 1, '2015-11-22', 'iphone 6', 'its my iphone', '111', 'lost', 'phone or computer', 'apple', '6', 'gold', 100, 'pornhub.com'),
(0, 0, 1, '2015-11-22', 'iphone 6', 'its my iphone 2', '111', 'found', 'phone or computer', 'apple', '6', 'gold', 100, 'pornhub.com'),
(0, 0, 1, '2015-11-22', 'iphone 6', 'its my iphone 3', '111', 'claimed', 'phone or computer', 'apple', '6', 'gold', 100, 'pornhub.com') ;



CREATE TABLE IF NOT EXISTS finder (
	id INT PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(254) NOT NULL,
	phone int(10),
	first_name VARCHAR(30) NOT NULL,
	last_name VARCHAR(30) NOT NULL
	
) ;

CREATE TABLE IF NOT EXISTS owner (
	id INT PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(254) NOT NULL,
	phone int(10),
	first_name VARCHAR(30) NOT NULL,
	last_name VARCHAR(30) NOT NULL
	
) ;

