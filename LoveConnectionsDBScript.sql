drop database if exists LoveConnections;
create database if not exists LoveConnections;
use LoveConnections;

create table MemberInfo (
  memberID_PK INT(6) UNSIGNED AUTO_INCREMENT PRIMARY Key,
  organization BOOL,
  organizationName VARCHAR(30), 
  email VARCHAR(30) NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  firstName VARCHAR(30) NOT NULL,
  lastName VARCHAR(30) NOT NULL
);

create table EventInfo (
  eventID_PK INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  memberID_FK INT(6) UNSIGNED,
  eventDate Date NOT NULL,
  eventName VARCHAR(255),
  eventLocation VARCHAR(70),
  numRounds INT(3),
  foreign key (memberID_FK) references
    MemberInfo(memberID_PK)
);

create table EventsAndRounds (
  roundID_PK INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  eventID_FK INT(6) UNSIGNED NOT NULL,
  foreign key (eventID_FK) references
    EventInfo(eventID_PK) on delete cascade
);

create table MatchesList (
  matchID_PK INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  roundID_FK INT(6) UNSIGNED NOT NULL,
  memberOneID_FK INT(6) UNSIGNED NOT NULL,
  memberTwoID_FK INT(6) UNSIGNED NOT NULL,
  foreign key(roundID_FK) references
    EventsAndRounds(roundID_PK) on delete cascade,
  foreign key(memberOneID_FK) references
    memberInfo(memberID_PK) on delete cascade,
  foreign key(memberTwoID_FK) references
    memberInfo(memberID_PK) on delete cascade 
);

create table Interests (
  interestID_PK INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  interest VARCHAR(255) NOT NULL
);

insert into Interests (interest) VALUES 
	('basketball'),('bowling'),('cheer'),
	('dance'),('football'),('golf'),
    ('gymnastics'),('lacrosse'),('soccer'),
    ('softball'),('swimming'),('tennis'),
    ('track'),('volleyball'),('mathematics'),
    ('science'),('reading'),('history'),
    ('languages'),('agriculture'),('church'),
    ('politics'),('liberal'),('conservative'),
    ('independent'),('art'),('music'),
    ('singing'),('orchestra'),('band'),
    ('acting'),('fashion'),('movies');

create table MemberInterestLink (
  memberID_FK INT(6) UNSIGNED NOT NULL,
  interestID_FK INT(6) UNSIGNED NOT NULL,
  foreign key(memberID_FK) references
    memberInfo(memberID_PK) on delete cascade,
  foreign key(interestID_FK) references
    Interests(interestID_PK) on delete cascade,
  CONSTRAINT UC_memberInterest UNIQUE (memberID_FK, interestID_FK)
);

create table MemberEventLink (
  memberID_FK INT(6) UNSIGNED NOT NULL,
  eventID_FK INT(6) UNSIGNED NOT NULL,
  foreign key(memberID_FK) references
    memberInfo(memberID_PK) on delete cascade,
  foreign key(eventID_FK) references
    eventInfo(eventID_PK) on delete cascade,
  CONSTRAINT UC_memberEvent UNIQUE (memberID_FK, eventID_FK)
);

create table intCategories (
  categoryID_PK INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) NOT NULL
);

insert into intCategories (`name`) VALUES 
	('Athletics'), ('Academics'), 
    ('Religion & Politics'), ('Arts & Music');

create table interestCategoriesLink (
  interestID_FK INT(6) UNSIGNED NOT NULL,
  categoryID_FK INT(6) UNSIGNED NOT NULL,
  foreign key(categoryID_FK) references
    intCategories(categoryID_PK) on delete cascade,
  foreign key(interestID_FK) references
    Interests(interestID_PK) on delete cascade,
  CONSTRAINT UC_interestCategory UNIQUE (categoryID_FK, interestID_FK)
);

insert into interestCategoriesLink VALUES 
	(1,1), (2,1), (3,1), (4,1), (5,1),
    (6,1), (7,1), (8,1), (9,1), (10,1),
    (11,1), (12,1), (13,1), (14,1), (15,2),
    (16,4), (17,3), (18,2), (19,2), (20,2),
    (21,3), (22,3), (23,3), (24,3), (25,3),
    (26,4), (27,4), (28,4), (29,4), (30,4),
    (31,4), (32,4), (33,4);

create table profilePictures(
  pictureID_PK int unsigned auto_increment primary key,
  memberID_FK int(6) UNSIGNED NOT NULL,
  filename nvarchar(255),
  filetype nvarchar(50),
  filedata longblob,
  date_created datetime default current_timestamp,
  foreign key(memberID_FK) references
    memberInfo(memberID_PK) on delete cascade
);

#insert into EventInfo (memberID_FK, eventDate,eventName, eventLocation, numRounds) VALUES (1, '2018-5-25', 'Barley\'s Brewing', '467 N High St, Columbus, OH 43215', 4);
#insert into EventInfo (memberID_FK, eventDate,eventName, eventLocation, numRounds) VALUES (1, '2018-6-1', 'The Three Legged Mare', '401 N Front St #150, Columbus, OH 43215', 5);
#insert into EventInfo (memberID_FK, eventDate,eventName, eventLocation, numRounds) VALUES (1, '2018-6-8', 'Marcella\'s', '615 N High St, Columbus, OH 43215', 3);