SET NAMES utf8;
create database if not exists jd character set 'utf8';
use jd
create table if not exists jd_order  (orderId varchar(20),userId varchar(20),generateDate date,finishedDate date);

load data local infile "/Users/zz/Sites/jd_order.txt" into table jd_order;

create table if not exists jd_product (productId varchar(10),orderId varchar(20),productName text,num TINYINT, singlePrice decimal(5,2)) Engine=InnoDB default charset=utf8;

load data local infile "/Users/zz/Sites/jd_product.txt" into table jd_product;