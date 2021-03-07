drop database plantsale;
create database plantsale;
use plantsale;

create table scout 
(
	scoutid int(6) unsigned auto_increment primary key,
	lastname varchar(50) not null,
	firstname varchar(50)
);

create table customer
(
	custID int(6) unsigned auto_increment primary key,
	lastname varchar(50) not null,
	firstname varchar(50),
	email varchar(200),
	telno varchar(12),
	address varchar(200)
);

create table flower 
(
 	flowerid int(6) unsigned auto_increment primary key,
	fname varchar(40) not null,
	fvariety varchar(40) not null,
	fcontainer varchar(20) not null
);

create table price
(
	container varchar(20) not null primary key,
	retail decimal(5,2) not null,
	wholesale decimal(5,2) not null
);

create table orders
(
	oid int(6) not null auto_increment primary key,
	sid int(6) not null,
	cid int(6) not null,
	paytype varchar(45),
	amount varchar(45),
	year year(4) not null
);

create table ordflowers
(
	orderid int(6) not null,
	flowerid int(6) not null,
	qty int(4) not null 
);

create table user
(
	userid int(6) unsigned auto_increment primary key,
	lastname varchar(50) not null,
	firstname varchar(50),
	email varchar(200) not null unique,
	privilege int(2)
);

source insPrice.sql;
source insFlower.sql;
source insUser.sql;
source cust_scout_dump.2019;
