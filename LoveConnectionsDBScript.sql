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

insert into Interests (interest) VALUES ('basketball');
insert into Interests (interest) VALUES ('bowling');
insert into Interests (interest) VALUES ('cheer');
insert into Interests (interest) VALUES ('dance');
insert into Interests (interest) VALUES ('football');
insert into Interests (interest) VALUES ('golf');
insert into Interests (interest) VALUES ('gymnastics');
insert into Interests (interest) VALUES ('lacrosse');
insert into Interests (interest) VALUES ('soccer');
insert into Interests (interest) VALUES ('softball');
insert into Interests (interest) VALUES ('swimming');
insert into Interests (interest) VALUES ('tennis');
insert into Interests (interest) VALUES ('track');
insert into Interests (interest) VALUES ('volleyball');
insert into Interests (interest) VALUES ('mathematics');
insert into Interests (interest) VALUES ('science');
insert into Interests (interest) VALUES ('reading');
insert into Interests (interest) VALUES ('history');
insert into Interests (interest) VALUES ('languages');
insert into Interests (interest) VALUES ('agriculture');
insert into Interests (interest) VALUES ('church');
insert into Interests (interest) VALUES ('politics');
insert into Interests (interest) VALUES ('liberal');
insert into Interests (interest) VALUES ('conservative');
insert into Interests (interest) VALUES ('independent');
insert into Interests (interest) VALUES ('art');
insert into Interests (interest) VALUES ('music');
insert into Interests (interest) VALUES ('singing');
insert into Interests (interest) VALUES ('orchestra');
insert into Interests (interest) VALUES ('band');
insert into Interests (interest) VALUES ('acting');
insert into Interests (interest) VALUES ('fashion');
insert into Interests (interest) VALUES ('movies');

create table MemberInterestLink (
  memberID_FK INT(6) UNSIGNED NOT NULL,
  interestID_FK INT(6) UNSIGNED NOT NULL,
  foreign key(memberID_FK) references
    memberInfo(memberID_PK) on delete cascade,
  foreign key(interestID_FK) references
    Interests(interestID_PK) on delete cascade,
  CONSTRAINT UC_memberInterest UNIQUE (memberID_FK, interestID_FK)
);

#select * from MemberInterestLink;
#select * from memberInfo;
#select * from eventInfo;
#select * from Interests;
#SELECT * FROM memberInterestLink WHERE memberID_FK = 5;
#insert into MemberInterestLink (memberID_FK, interestID_FK) VALUES (3,2); 
#SELECT * FROM memberInterestLink WHERE memberID_FK = 5;

#insert into MemberInterestLink (memberID_FK, interestID_FK)
#SELECT m.memberID_PK, mi.interestID_FK
#FROM memberInfo m
#Join MemberInterestLink mi on (mi.memberID_FK = m.memberID_PK)
#Join interests i on (mi.interestID_FK = i.interestID_PK)
#WHERE i.interest = 'football' AND memberID_FK = 2;

SELECT m.memberID_PK, mi.interestID_FK, i.interest
FROM memberInfo m
Join MemberInterestLink mi on (mi.memberID_FK = m.memberID_PK)
Join interests i on (mi.interestID_FK = i.interestID_PK);
#WHERE i.interest = 'bowling' AND memberID_PK = 1;