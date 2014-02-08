CREATE DATABASE seaweb_dashboard_db;
 GRANT ALL PRIVILEGES ON seaweb_dashboard_db.* TO seaweb@localhost IDENTIFIED BY 'webmaster';
 USE seaweb_dashboard_db;
 CREATE TABLE seaweb_dashboard_db.burndownChartsDump (
 npi_id INT NOT NULL,
 chart_type VARCHAR(200) NOT NULL,
 chart_json_data BLOB
 );

