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

create table UserInterests (
  memberID_FK INT(6) UNSIGNED,
  basketball BOOL,
  bowling BOOL,
  cheer BOOL,
  dance BOOL,
  golf BOOL,
  gymnastics BOOL,
  lacrosse BOOL,
  soccer BOOL,
  softball BOOL,
  swimming BOOL,
  tennis BOOL,
  track BOOL,
  volleyball BOOL,
  mathematics BOOL,
  science BOOL,
  reading BOOL,
  movies BOOL,
  history BOOL,
  art BOOL,
  music BOOL,
  singing BOOL,
  orchestra BOOL,
  band BOOL,
  acting BOOL,
  fashion BOOL,
  foreignLanguages BOOL,
  agriculture BOOL,
  church BOOL,
  politics BOOL,
  liberal BOOL,
  conservative BOOL,
  independent BOOL,  
  foreign key(memberID_FK) references
    memberInfo(memberID_PK) on delete cascade 
);
