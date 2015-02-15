create database walking_stats;

create table places (
	id int not null auto_increment primary key,
	name varchar(40),	
	date DATE
);

create table walks (
    id int not null auto_increment primary key,
    minutes int,	
    distance_km decimal(5,2),
    speed decimal (5,2),
    description varchar(40),
	date DATE
);

