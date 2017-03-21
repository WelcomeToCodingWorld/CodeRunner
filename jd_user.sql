use jd;
Create table if not exists T_User (userId SMALLINT Not Null AUTO_INCREMENT Unique,userName varchar(10) Not Null Unique,userPwd varchar(10) Not Null) Engine=InnoDB default charset=utf8;
load data low_priority local infile "/Users/zz/Sites/jd_user.txt" into table T_User FIELDS TERMINATED BY '|';