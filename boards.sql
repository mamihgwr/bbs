SET SESSION FOREIGN_KEY_CHECKS=0;

/* Drop Tables */

DROP TABLE IF EXISTS replies;
DROP TABLE IF EXISTS boards;




/* Create Tables */

CREATE TABLE boards
(
	id int unsigned NOT NULL AUTO_INCREMENT,
	name varchar(30),
	subject varchar(120),
	message text,
	image_path varchar(60),
	email varchar(120),
	url varchar(256),
	text_color varchar(30),
	delete_key varchar(8),
	created_at datetime,
	PRIMARY KEY (id)
);


CREATE TABLE replies
(
	id int unsigned NOT NULL AUTO_INCREMENT,
	board_id int unsigned NOT NULL,
	name varchar(30),
	subject varchar(120),
	message text,
	image_path varchar(60),
	email varchar(120),
	url varchar(256),
	text_color varchar(30),
	delete_key varchar(8),
	created_at datetime,
	PRIMARY KEY (id)
);



/* Create Foreign Keys */

ALTER TABLE replies
	ADD FOREIGN KEY (board_id)
	REFERENCES boards (id)
	ON UPDATE RESTRICT
	ON DELETE RESTRICT
;



