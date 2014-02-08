CREATE DATABASE seaweb_oss_db;
 GRANT ALL PRIVILEGES ON seaweb_oss_db.* TO seaweb@localhost IDENTIFIED BY 'webmaster';
 USE seaweb_oss_db; 

 CREATE TABLE seaweb_oss_db.purchase_requisition (
system_id INT NOT NULL,
 pr_number INT,
 pr_line INT,
 po_number INT,
 gl_account INT,
cost_center VARCHAR(100),
requestor VARCHAR(100),
budget_line_item VARCHAR(100),
vendor VARCHAR(100),
description VARCHAR(100),
status VARCHAR(100),
amount INT,
year INT,
currency VARCHAR(100),
date_approved DATE,
PRIMARY KEY (system_id)
 );

ALTER TABLE seaweb_oss_db.purchase_requisition ADD project VARCHAR(100);
ALTER TABLE seaweb_oss_db.purchase_requisition ADD priority VARCHAR(100);
ALTER TABLE seaweb_oss_db.purchase_requisition ADD recurring VARCHAR(100);
