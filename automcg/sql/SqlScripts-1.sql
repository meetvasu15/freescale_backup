 CREATE DATABASE seaweb_dashboard_db;
 GRANT ALL PRIVILEGES ON seaweb_dashboard_db.* TO seaweb@localhost IDENTIFIED BY 'webmaster';
 USE seaweb_dashboard_db;
 CREATE TABLE seaweb_dashboard_db.users (
 user_id INT NOT NULL AUTO_INCREMENT,
 username VARCHAR(100) NOT NULL,
 password VARCHAR(100) NOT NULL,
 email VARCHAR(100) NOT NULL,
   PRIMARY KEY ( user_id )
 );

CREATE TABLE seaweb_dashboard_db.autoPVData (
 system_id INT NOT NULL,
 functional_manager VARCHAR(100),
 resource_manager VARCHAR(100),
 project VARCHAR(100),
 activity_name VARCHAR(100),
 resource_role VARCHAR(100),
 planned_units  VARCHAR(100),
 resource_id VARCHAR(100),
 resource_name VARCHAR(100),
 spreadsheet_feild VARCHAR(100),
 is_active VARCHAR(100),
 PRIMARY KEY ( system_id )
 );

CREATE TABLE seaweb_dashboard_db.autoPVMonthlyValue (
 system_id INT NOT NULL,
 apv_month DATE,
 resource_value FLOAT
) ;

CREATE TABLE seaweb_dashboard_db.graphData (
 resource_role VARCHAR(100),
 apv_month DATE,
 role_value FLOAT
) ;

 SELECT sum(case when apv_month = '2013-06-01' then resource_value end) AS '2013-06-01',sum(case when apv_month = '2013-07-01' then resource_value end) AS '2013-07-01',sum(case when apv_month = '2013-08-01' then resource_value end) AS '2013-08-01',sum(case when apv_month = '2013-09-01' then resource_value end) AS '2013-09-01',sum(case when apv_month = '2013-10-01' then resource_value end) AS '2013-10-01',sum(case when apv_month = '2013-11-01' then resource_value end) AS '2013-11-01',sum(case when apv_month = '2013-12-01' then resource_value end) AS '2013-12-01',sum(case when apv_month = '2014-01-01' then resource_value end) AS '2014-01-01',sum(case when apv_month = '2014-02-01' then resource_value end) AS '2014-02-01',sum(case when apv_month = '2014-03-01' then resource_value end) AS '2014-03-01',sum(case when apv_month = '2014-04-01' then resource_value end) AS '2014-04-01',sum(case when apv_month = '2014-05-01' then resource_value end) AS '2014-05-01',sum(case when apv_month = '2014-06-01' then resource_value end)   FROM autoPVMonthlyValue val GROUP BY system_id;
 
 
 
 
 SELECT sum(case when apv_month = '2013-06-01' then resource_value end) AS '2013-06-01',sum(case when apv_month = '2013-07-01' then resource_value end) AS '2013-07-01',sum(case when apv_month = '2013-08-01' then resource_value end) AS '2013-08-01',sum(case when apv_month = '2013-09-01' then resource_value end) AS '2013-09-01',sum(case when apv_month = '2013-10-01' then resource_value end) AS '2013-10-01',sum(case when apv_month = '2013-11-01' then resource_value end) AS '2013-11-01',sum(case when apv_month = '2013-12-01' then resource_value end) AS '2013-12-01',sum(case when apv_month = '2014-01-01' then resource_value end) AS '2014-01-01',sum(case when apv_month = '2014-02-01' then resource_value end) AS '2014-02-01',sum(case when apv_month = '2014-03-01' then resource_value end) AS '2014-03-01',sum(case when apv_month = '2014-04-01' then resource_value end) AS '2014-04-01',sum(case when apv_month = '2014-05-01' then resource_value end) AS '2014-05-01',sum(case when apv_month = '2014-06-01' then resource_value end)   FROM autoPVMonthlyValue val, autopvdata autopv where autopv.system_id = val.system_id GROUP BY system_id;