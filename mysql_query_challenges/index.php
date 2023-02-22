<?php 
//EASY LEVEL
//https://www.sql-practice.com/

//Show how many patients have a birth_date with 2010 as the birth year.

//DATE TYPE INDA SQL DE YEAR FONKSIYONUNU KULLANARAK DATE ICINDEKI YEAR I ALIP KULLANABILIRIZ
//SELECT COUNT(*) AS total_patients FROM patients WHERE YEAR(birth_date) = 2010;

//Get firstname,lastname and highest value 
//SELECT first_name, last_name, MAX(height) AS height FROM patients;

//Show all columns for patients who have one of the following patient_ids:	1,45,534,879,1000
//SELECT * from patients where patient_id in(1,45,534,879,1000);

//Show the total number of admissions
//SELECT COUNT(patient_id) AS TOTALNUMMER FROM admissions;

//Show all the columns from admissions where the patient was admitted and discharged on the same day.
//SELECT * FROM admissions WHERE admission_date = discharge_date;

//Show the patient id and the total number of admissions for patient_id 579.
//SELECT patient_id, COUNT(*) AS total_admissions FROM admissions WHERE patient_id = 579;

//Based on the cities that our patients live in, show unique cities that are in province_id 'NS'?
// SELECT distinct(CITY) FROM patients WHERE province_id = "NS";

//Write a query to find the first_name, last name and birth date of patients who have height more than 160 and weight more than 70
//SELECT first_name,last_name,birth_date FROM patients WHERE height > 160 AND weight > 70

//Write a query to find list of patients first_name, last_name, and allergies from Hamilton where allergies are not null
//SELECT first_name, last_name, allergies FROM patients WHERE city = 'Hamilton' and allergies is not null

//Based on cities where our patient lives in, write a query to display the list of unique city starting with a vowel (a, e, i, o, u). Show the result order in ascending by city.

//select distinct city from patients where city like 'a%'   or city like 'e%' or city like 'i%'  or city like 'o%' or city like 'u%' order by city
//SELECT distinct(city) FROM patients WHERE city LIKE '[a, e, i, o, u]%' order by city;

//MEDIUM LEVEL QUESTIONS

//Show unique birth years from patients and order them by ascending.
//SELECT distinct(YEAR(birth_date)) FROM patients order by birth_date ASC;

//Show unique first names from the patients table which only occurs once in the list.
// For example, if two or more people are named 'John' in the first_name column then don't include their name in the output list. If only 1 person is named 'Leo' then include them in the output.
//SELECT first_name FROM patients GROUP BY first_name HAVING COUNT(first_name) = 1 
//BESTPRACTISE....GROUP BY ILE The GROUP BY statement is often used with aggregate functions (COUNT(), MAX(), MIN(), SUM(), AVG())  BUNLARLA ILGILI FILTRELEMELER WHERE ILE YAPILMAZ ONDAN DOLAYI HAVING KULLANILYOR...

//Show patient_id and first_name from patients where their first_name start and ends with 's' and is at least 6 characters long.
//SELECT first_name, patient_id FROM patients WHERE first_name LIKE 's%____%s' 

//Show patient_id, first_name, last_name from patients whos diagnosis is 'Dementia'.
//Primary diagnosis is stored in the admissions table.

//SELECT patients.patient_id, first_name, last_name FROM patients inner JOIN admissions ON admissions.patient_id = patients.patient_id WHERE diagnosis= 'Dementia';
//INNER JOIN ISLEMLERINDE HATA ALMA IHTIMALIMIZN EN YUKSEK OLDUGU YER IKI VEYA DAHA FAZLA TABLODAKI AYNI KOLON ISIMLERINI KULLANIRKEN DOGRUDAN DEGIL DE TABLO ISMI . MEMBER ACCESS NOTASYONU NU KULLANARAK KULLANMALIYIZ YOKSA SQL HANGI TABLOYA AIT OLAN KOLONU KASTETTIGMIZI ANLAMAYACAKTIR

//Display every patient's first_name.
//Order the list by the length of each name and then by alphbetically
//SELECT first_name from patients order by LEN(first_name), first_name

//Show the total amount of male patients and the total amount of female patients in the patients table.
//Display the two results in the same row.'
//SELECT 
//(SELECT count(*) FROM patients WHERE gender='M') AS male_count, 
//(SELECT count(*) FROM patients WHERE gender='F') AS female_count;

//Show first and last name, allergies from patients which have allergies to either 'Penicillin' or 'Morphine'. Show results ordered ascending by allergies then by first_name then by last_name.
//SELECT first_name,last_name,allergies from patients where allergies in('Penicillin','Morphine') order by allergies,first_name,last_name

//Show patient_id, diagnosis from admissions. Find patients admitted multiple times for the same diagnosis.
//SELECT patient_id, diagnosis FROM admissions GROUP BY patient_id, diagnosis HAVING COUNT(*) > 1;

//Show the city and the total number of patients in the city.
//Order from most to least patients and then by city name ascending.
//SELECT city,COUNT(patient_id)  from patients group by city order by count(patient_id) desc,city asc

//Show first name, last name and role of every person that is either patient or doctor.
//The roles are either "Patient" or "Doctor"
//SELECT first_name, last_name, 'Patient' as role FROM patients union all select first_name, last_name, 'Doctor' from doctors;
//The UNION operator is used to combine the result-set of two or more SELECT statements.
//Every SELECT statement within UNION must have the same number of columns
//The columns must also have similar data types
//The columns in every SELECT statement must also be in the same order
//The UNION operator selects only distinct values by default. To allow duplicate values, use UNION ALL:

//Show all allergies ordered by popularity. Remove NULL values from query.
//SELECT allergies, COUNT(*) AS total_diagnosis FROM patients WHERE allergies IS NOT NULL GROUP BY allergies ORDER BY total_diagnosis DESC

//Show all patient's first_name, last_name, and birth_date who were born in the 1970s decade. Sort the list starting from the earliest birth_date.



?>