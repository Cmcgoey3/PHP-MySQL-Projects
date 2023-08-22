-- Author: Connor McGoey

-- SCRIPT 1

-- Set up the database

USE assign2db; 

-- Part 1 SQL Updates
SELECT * FROM hospital;
UPDATE hospital SET headdoc="GD56", headdocstartdate="2010-12-19" WHERE hoscode="BBC";
UPDATE hospital SET headdoc="SE66", headdocstartdate="2004-05-30" WHERE hoscode="ABC";
UPDATE hospital SET headdoc="YT67", headdocstartdate="2001-06-01" WHERE hoscode="DDE";
SELECT * FROM hospital;



-- Part 2 SQL Inserts
INSERT INTO doctor VALUES ("ZG19", "Mike", "Jones", "1999-04-21", "1969-02-07", "ABC", "Surgeon");
INSERT INTO looksafter VALUES ("ZG19", "180542173");
INSERT INTO hospital VALUES ("FFF", "St. Margaret", "Toronto", "ON", "2000", "ZG19", "2022-10-15"); 
SELECT * FROM doctor;
SELECT * FROM patient;
SELECT * FROM looksafter;
SELECT * FROM hospital; 



-- Part 3 SQL Queries

-- Query 1
SELECT lastname FROM patient;
-- Query 2
SELECT DISTINCT lastname FROM patient;
-- Query 3
SELECT * FROM doctor ORDER BY lastname ASC;
-- Query 4
SELECT hosname, hoscode FROM hospital WHERE numofbed>1500;
-- Query 5
SELECT firstname, lastname FROM doctor WHERE hosworksat IN(SELECT hoscode FROM hospital WHERE hosname="ST. Joseph");
-- Query 6
SELECT firstname, lastname FROM patient WHERE lastname LIKE "G%";
-- Query 7
SELECT firstname, lastname FROM patient WHERE ohipnum IN(SELECT ohipnum FROM looksafter WHERE licensenum IN(SELECT licensenum FROM doctor WHERE lastname="Webster"));
-- Query 8
SELECT hosname, city, lastname FROM hospital, doctor WHERE hospital.headdoc=doctor.licensenum;
-- Query 9
SELECT sum(numofbed) FROM hospital;
-- Query 10
SELECT patient.firstname AS "Patient First Name", patient.lastname AS "Patient Last Name", Q.firstname AS "Doctor First Name", Q.lastname AS "Doctor Last Name" FROM patient JOIN(SELECT firstname, lastname, ohipnum FROM looksafter JOIN (SELECT firstname, lastname, licensenum FROM doctor WHERE doctor.licensenum IN (SELECT headdoc FROM hospital)) AS T ON T.licensenum=looksafter.licensenum) AS Q ON patient.ohipnum=Q.ohipnum;
-- Query 11
SELECT firstname, lastname FROM doctor WHERE speciality="Surgeon" AND hosworksat IN (SELECT hoscode FROM hospital WHERE hosname="Victoria");
-- Query 12
SELECT firstname FROM doctor WHERE licensenum NOT IN (SELECT licensenum FROM looksafter);
-- Query 13
SELECT lastname, firstname, numpatients, hosname FROM hospital JOIN(SELECT lastname, firstname, numpatients, doctor.licensenum, hosworksat FROM doctor JOIN(SELECT licensenum, COUNT(ohipnum) AS "numpatients" FROM looksafter GROUP BY licensenum HAVING COUNT(ohipnum) > 1) AS T ON doctor.licensenum=T.licensenum) AS D ON D.hosworksat=hospital.hoscode;
-- Query 14
SELECT G.firstname AS "Doctor First Name", G.lastname AS "Doctor Last Name", G.hosname AS "Head of Hospital Name", hospital.hosname AS "Works at Hospital Name" FROM hospital, (SELECT firstname, lastname, hosworksat, T.hoscode, T.hosname from doctor JOIN (SELECT hosname, hoscode, headdoc FROM hospital) AS T ON doctor.licensenum=T.headdoc) AS G WHERE G.hoscode!=G.hosworksat AND hospital.hoscode=G.hosworksat; 
-- Query 15 - My Query - Display the doctor's last name, license number, their speciality, and what hospital (including province) they work for 
-- of all head doctors who work for a hospital with more than 1300 beds
SELECT lastname, licensenum, speciality, hosname, prov FROM doctor, hospital WHERE doctor.licensenum=hospital.headdoc AND numofbed > 1300;


-- Part 4 SQL Views / Deletes
-- Helper view in order to allow for a subquery between patient table and looksafter table
CREATE VIEW patientsInfoWithTheirDoctorLicense AS SELECT firstname AS "pfirst", lastname AS "plast", birthdate AS "pbirth", licensenum FROM patient JOIN looksafter AS T ON patient.ohipnum=T.ohipnum;
-- Actual view with all information
CREATE VIEW docsAndPatients AS SELECT doctor.firstname AS "dfirst", doctor.lastname AS "dlast", doctor.birthdate AS "dbirth", pfirst, plast, pbirth FROM doctor JOIN patientsInfoWithTheirDoctorLicense AS P ON doctor.licensenum=P.licensenum;
SELECT * FROM docsAndPatients;
SELECT dlast, dbirth, plast, pbirth FROM docsAndPatients WHERE dbirth > pbirth;
SELECT * FROM patient;
SELECT * FROM looksafter;

-- Following two queries all prove that the patient no longer exists in the looksafter table
SELECT * FROM looksafter;

SELECT * FROM doctor;
DELETE FROM doctor WHERE firstname="Bernie";
SELECT * FROM doctor WHERE firstname="Bernie";

DELETE FROM doctor WHERE firstname="Mike" AND lastname="Jones";
-- The new doctor cannot be deleted because the primary key (licensenum) of this doctor row is the foreign key belonging to my made-up hospital (headdoc). Therefore I cannot delete it.
