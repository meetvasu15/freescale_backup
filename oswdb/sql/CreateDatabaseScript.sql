-- Create Table: OSW_FG_ASY
--------------------------------------------------------------------------------
CREATE TABLE OSWDM.OSW_FG_ASY
(
	ops VARCHAR(20)  NULL 
	,tech VARCHAR(20)  NULL 
	,pkg_grp VARCHAR(20)  NULL 
	,benchmark_dev VARCHAR(20)  NULL 
	,year INT  NULL 
	,value DECIMAL(38)  NULL 
	,bu_device VARCHAR(20)  NULL 
	,die_count  DECIMAL(38)  NULL 
	,wire_count INT  NULL 
	,package_size INT  NULL 
	,ball_count INT  NULL 
	,wedge_ct INT  NULL 
	,is_au_al_cu VARCHAR(20)  NULL 
	,status VARCHAR(20)  NULL 
);



-- Create Table: OSW_FG_TEST
--------------------------------------------------------------------------------
CREATE TABLE OSWDM.OSW_FG_TEST
(
	global VARCHAR(50)  NULL 
	,tester VARCHAR(20)  NULL 
	,year INT  NULL 
	,value DECIMAL(38)  NULL 
);
 

-- Create Table: OSW_FG_FAB_8
--------------------------------------------------------------------------------
CREATE TABLE OSWDM.OSW_FG_FAB_8
(
	WTC VARCHAR(50)  NULL 
	,tech_grp VARCHAR(50)  NULL 
	,key_code VARCHAR(20)  NULL 
	,turns INT  NULL 
	,MLS INT  NULL 
	,year INT  NULL 
	,value INT  NULL 
);
 


-- Create Table: OSW_FW_BURN_IN
--------------------------------------------------------------------------------
CREATE TABLE OSWDM.OSW_FW_BURN_IN
(
	plant VARCHAR(20)  NULL 
	,chamber VARCHAR(20)  NULL 
	,year INT  NULL 
	,value DECIMAL(38)  NULL 
);
 

-- Create Table: OSW_FG_PROBE
--------------------------------------------------------------------------------
CREATE TABLE OSWDM.OSW_FG_PROBE
(
	global VARCHAR(50)  NULL 
	,tester VARCHAR(20)  NULL 
	,year INT  NULL 
	,value DECIMAL(38)  NULL 
) ;

-- Create Table: OSW_FG_BUMP
--------------------------------------------------------------------------------
CREATE TABLE OSWDM.OSW_FG_BUMP
(
	bump_code VARCHAR(50)  NULL 
	,description VARCHAR(100)  NULL 
	,year INT  NULL 
	,value DECIMAL(38)  NULL 
) ;
