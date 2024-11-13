INSERT INTO regions (region_id, region_name) VALUES (1, 'Europe');
INSERT INTO regions (region_id, region_name) VALUES (2, 'Americas');
INSERT INTO regions (region_id, region_name) VALUES (3, 'Asia');
INSERT INTO regions (region_id, region_name) VALUES (4, 'Middle East and Africa');

INSERT INTO countries (country_id, country_name, region_id) VALUES ('IT', 'Italy', 1);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('JP', 'Japan', 3);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('US', 'United States of America', 2);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('CA', 'Canada', 2);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('CN', 'China', 3);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('IN', 'India', 3);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('AU', 'Australia', 3);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('ZW', 'Zimbabwe', 4);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('SG', 'Singapore', 3);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('UK', 'United Kingdom', 1);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('FR', 'France', 1);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('DE', 'Germany', 1);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('ZM', 'Zambia', 4);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('EG', 'Egypt', 4);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('BR', 'Brazil', 2);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('CH', 'Switzerland', 1);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('NL', 'Netherlands', 1);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('MX', 'Mexico', 2);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('KW', 'Kuwait', 4);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('IL', 'Israel', 4);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('DK', 'Denmark', 1);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('ML', 'Malaysia', 3);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('NG', 'Nigeria', 4);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('AR', 'Argentina', 2);
INSERT INTO countries (country_id, country_name, region_id) VALUES ('BE', 'Belgium', 1);


INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
(1000 , '1297 Via Cola di Rie', '00989', 'Roma', NULL, 'IT');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
(1100, '93091 Calle della Testa', '10934', 'Venice', NULL, 'IT');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
(1200, '2017 Shinjuku-ku', '1689', 'Tokyo', 'Tokyo Prefecture', 'JP');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
(1300, '9450 Kamiya-cho', '6823', 'Hiroshima', NULL, 'JP');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
(1400, '2014 Jabberwocky Rd', '26192', 'Southlake', 'Texas', 'US');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 1500, '2011 Interiors Blvd', '99236', 'South San Francisco', 'California', 'US');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 1600, '2007 Zagora St', '50090', 'South Brunswick', 'New Jersey', 'US');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 1700, '2004 Charade Rd', '98199', 'Seattle', 'Washington', 'US');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 1800, '147 Spadina Ave', 'M5V 2L7', 'Toronto', 'Ontario', 'CA');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 1900, '6092 Boxwood St', 'YSW 9T2', 'Whitehorse', 'Yukon', 'CA');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 2000, '40-5-12 Laogianggen', '190518', 'Beijing', NULL, 'CN');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 2100, '1298 Vileparle (E)', '490231', 'Bombay', 'Maharashtra', 'IN');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 2200, '12-98 Victoria Street', '2901', 'Sydney', 'New South Wales', 'AU');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 2300, '198 Clementi North', '540198', 'Singapore', NULL, 'SG');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 2400, '8204 Arthur St', NULL, 'London', NULL, 'UK');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 2500, 'Magdalen Centre, The Oxford Science Park', 'OX9 9ZB', 'Oxford', 'Oxford', 'UK');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 2600, '9702 Chester Road', '09629850293', 'Stretford', 'Manchester', 'UK');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 2700, 'Schwanthalerstr. 7031', '80925', 'Munich', 'Bavaria', 'DE');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 2800, 'Rua Frei Caneca 1360 ', '01307-002', 'Sao Paulo', 'Sao Paulo', 'BR');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 2900, '20 Rue des Corps-Saints', '1730', 'Geneva', 'Geneve', 'CH');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 3000, 'Murtenstrasse 921', '3095', 'Bern', 'BE', 'CH');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 3100, 'Pieter Breughelstraat 837', '3029SK', 'Utrecht', 'Utrecht', 'NL');

INSERT INTO locations (location_id, street_address, postal_code, city, state_province, country_id) VALUES
( 3200, 'Mariano Escobedo 9991', '11932', 'Mexico City', 'Distrito Federal,', 'MX');


INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'AD_PRES', 'President', 20080, 40000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'AD_VP', 'Administration Vice President', 15000, 30000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'AD_ASST', 'Administration Assistant', 3000, 6000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'FI_MGR', 'Finance Manager', 8200, 16000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'FI_ACCOUNT', 'Accountant', 4200, 9000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'AC_MGR', 'Accounting Manager', 8200, 16000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'AC_ACCOUNT', 'Public Accountant', 4200, 9000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'SA_MAN', 'Sales Manager', 10000, 20080);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'SA_REP', 'Sales Representative', 6000, 12008);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'PU_MAN', 'Purchasing Manager', 8000, 15000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'PU_CLERK', 'Purchasing Clerk', 2500, 5500);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'ST_MAN', 'Stock Manager', 5500, 8500);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'ST_CLERK', 'Stock Clerk', 2008, 5000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'SH_CLERK', 'Shipping Clerk', 2500, 5500);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'IT_PROG', 'Programmer', 4000, 10000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'MK_MAN', 'Marketing Manager', 9000, 15000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'MK_REP', 'Marketing Representative', 4000, 9000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'HR_REP', 'Human Resources Representative', 4000, 9000);

INSERT INTO jobs (job_id, job_title, min_salary, max_salary) VALUES
( 'PR_REP', 'Public Relations Representative', 4500, 10500);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 10, 'Administration', 200, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 20, 'Marketing', 201, 1800);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 30, 'Purchasing', 114, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 40, 'Human Resources', 203, 2400);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 50, 'Shipping', 121, 1500);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 60, 'IT', 103, 1400);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 70, 'Public Relations', 204, 2700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 80, 'Sales', 145, 2500);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 90, 'Executive', 100, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 100, 'Finance', 108, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 110, 'Accounting', 205, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 120, 'Treasury', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 130, 'Corporate Tax', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 140, 'Control And Credit', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 150, 'Shareholder Services', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 160, 'Benefits', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 170, 'Manufacturing', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 180, 'Construction', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 190, 'Contracting', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 200, 'Operations', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 210, 'IT Support', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 220, 'NOC', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 230, 'IT Helpdesk', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 240, 'Government Sales', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 250, 'Retail Sales', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 260, 'Recruiting', NULL, 1700);

INSERT INTO departments (department_id, department_name, manager_id, location_id) VALUES
( 270, 'Payroll', NULL, 1700);


INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 100, 'Steven', 'King', 'SKING', '515.123.4567', '2003-06-17', 'AD_PRES', 24000, NULL, NULL, 90);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 101, 'Neena', 'Kochhar', 'NKOCHHAR', '515.123.4568', '2021-09-05', 'AD_VP', 17000, NULL, 100, 90);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 102, 'Lex', 'De Haan', 'LDEHAAN', '515.123.4569', '2001-01-13', 'AD_VP', 17000, NULL, 100, 90);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 103, 'Alexander', 'Hunold', 'AHUNOLD', '590.423.4567', '2006-03-01', 'IT_PROG', 9000, NULL, 102, 60);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 104, 'Bruce', 'Ernst', 'BERNST', '590.423.4568', '2021-05-07', 'IT_PROG', 6000, NULL, 103, 60);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 105, 'David', 'Austin', 'DAUSTIN', '590.423.4569', '2015-06-05', 'IT_PROG', 4800, NULL, 103, 60);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 106, 'Valli', 'Pataballa', 'VPATABAL', '590.423.4560', '2005-02-06', 'IT_PROG', 4800, NULL, 103, 60);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 107, 'Diana', 'Lorentz', 'DLORENTZ', '590.423.5567', '2007-02-07', 'IT_PROG', 4200, NULL, 103, 60);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 108, 'Nancy', 'Greenberg', 'NGREENBE', '515.124.4569', '2017-08-02', 'FI_MGR', 12008, NULL, 101, 100);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 109, 'Daniel', 'Faviet', 'DFAVIET', '515.124.4169', '2016-08-02', 'FI_ACCOUNT', 9000, NULL, 108, 100);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 110, 'John', 'Chen', 'JCHEN', '515.124.4269', '2018-09-05', 'FI_ACCOUNT', 8200, NULL, 108, 100);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 111, 'Ismael', 'Sciarra', 'ISCIARRA', '515.124.4369', '2013-09-05', 'FI_ACCOUNT', 7700, NULL, 108, 100);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 112, 'Jose Manuel', 'Urman', 'JMURMAN', '515.124.4469', '2007-03-06', 'FI_ACCOUNT', 7800, NULL, 108, 100);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 113, 'Luis', 'Popp', 'LPOPP', '515.124.4567', '2007-12-07', 'FI_ACCOUNT', 6900, NULL, 108, 100);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 114, 'Den', 'Raphaely', 'DRAPHEAL', '515.127.4561', '2007-12-02', 'PU_MAN', 11000, NULL, 100, 30);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 115, 'Alexander', 'Khoo', 'AKHOO', '515.127.4562', '2018-05-03', 'PU_CLERK', 3100, NULL, 114, 30);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 116, 'Shelli', 'Baida', 'SBAIDA', '515.127.4563', '2004-12-05', 'PU_CLERK', 2900, NULL, 114, 30);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 117, 'Sigal', 'Tobias', 'STOBIAS', '515.127.4564', '2004-07-05', 'PU_CLERK', 2800, NULL, 114, 30);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 118, 'Guy', 'Himuro', 'GHIMURO', '515.127.4565', '2015-11-06', 'PU_CLERK', 2600, NULL, 114, 30);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 119, 'Karen', 'Colmenares', 'KCOLMENA', '515.127.4566', '2010-08-07', 'PU_CLERK', 2500, NULL, 114, 30);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 120, 'Matthew', 'Weiss', 'MWEISS', '650.123.1234', '2018-07-04', 'ST_MAN', 8000, NULL, 100, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 121, 'Adam', 'Fripp', 'AFRIPP', '650.123.2234', '2010-04-05', 'ST_MAN', 8200, NULL, 100, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 122, 'Payam', 'Kaufling', 'PKAUFLIN', '650.123.3234', '2001-05-03', 'ST_MAN', 7900, NULL, 100, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 123, 'Shanta', 'Vollman', 'SVOLLMAN', '650.123.4234', '2010-10-05', 'ST_MAN', 6500, NULL, 100, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 124, 'Kevin', 'Mourgos', 'KMOURGOS', '650.123.5234', '2016-11-07', 'ST_MAN', 5800, NULL, 100, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 125, 'Julia', 'Nayer', 'JNAYER', '650.124.1214', '2016-07-05', 'ST_CLERK', 3200, NULL, 120, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 126, 'Irene', 'Mikkilineni', 'IMIKKILI', '650.124.1224', '2008-09-06', 'ST_CLERK', 2700, NULL, 120, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 127, 'James', 'Landry', 'JLANDRY', '650.124.1334', '2014-01-07', 'ST_CLERK', 2400, NULL, 120, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 128, 'Steven', 'Markle', 'SMARKLE', '650.124.1434', '2008-03-08', 'ST_CLERK', 2200, NULL, 120, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 129, 'Laura', 'Bissot', 'LBISSOT', '650.124.5234', '2020-08-05', 'ST_CLERK', 3300, NULL, 121, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 130, 'Mozhe', 'Atkinson', 'MATKINSO', '650.124.6234', '2003-10-05', 'ST_CLERK', 2800, NULL, 121, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 131, 'James', 'Marlow', 'JAMRLOW', '650.124.7234', '2016-02-05', 'ST_CLERK', 2500, NULL, 121, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 132, 'TJ', 'Olson', 'TJOLSON', '650.124.8234', '2010-04-07', 'ST_CLERK', 2100, NULL, 121, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 133, 'Jason', 'Mallin', 'JMALLIN', '650.127.1934', '2014-06-04', 'ST_CLERK', 3300, NULL, 122, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 134, 'Michael', 'Rogers', 'MROGERS', '650.127.1834', '2006-08-06', 'ST_CLERK', 2900, NULL, 122, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 135, 'Ki', 'Gee', 'KGEE', '650.127.1734', '2012-12-07', 'ST_CLERK', 2400, NULL, 122, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 136, 'Hazel', 'Philtanker', 'HPHILTAN', '650.127.1634', '2006-02-08', 'ST_CLERK', 2200, NULL, 122, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 137, 'Renske', 'Ladwig', 'RLADWIG', '650.121.1234', '2014-07-03', 'ST_CLERK', 3600, NULL, 123, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 138, 'Stephen', 'Stiles', 'SSTILES', '650.121.2034', '2006-10-05', 'ST_CLERK', 3200, NULL, 123, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 139, 'John', 'Seo', 'JSEO', '650.121.2019', '2012-02-06', 'ST_CLERK', 2700, NULL, 123, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 140, 'Joshua', 'Patel', 'JPATEL', '650.121.1834', '2006-04-06', 'ST_CLERK', 2500, NULL, 123, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 141, 'Trenna', 'Rajs', 'TRAJS', '650.121.8009', '2017-10-03', 'ST_CLERK', 3500, NULL, 124, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 142, 'Curtis', 'Davies', 'CDAVIES', '650.121.2994', '2009-01-05', 'ST_CLERK', 3100, NULL, 124, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 143, 'Randall', 'Matos', 'RMATOS', '650.121.2874', '2015-03-06', 'ST_CLERK', 2600, NULL, 124, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 144, 'Peter', 'Vargas', 'PVARGAS', '650.121.2004', '2009-07-06', 'ST_CLERK', 2500, NULL, 124, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 145, 'John', 'Russell', 'JRUSSEL', '011.44.1344.429268', '2001-10-04', 'SA_MAN', 14000, .4, 100, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 146, 'Karen', 'Partners', 'KPARTNER', '011.44.1344.467268', '2005-01-05', 'SA_MAN', 13500, .3, 100, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 147, 'Alberto', 'Errazuriz', 'AERRAZUR', '011.44.1344.429278', '2010-03-05', 'SA_MAN', 12000, .3, 100, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 148, 'Gerald', 'Cambrault', 'GCAMBRAU', '011.44.1344.619268', '2015-10-07', 'SA_MAN', 11000, .3, 100, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 149, 'Eleni', 'Zlotkey', 'EZLOTKEY', '011.44.1344.429018', '2009-01-08', 'SA_MAN', 10500, .2, 100, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 150, 'Peter', 'Tucker', 'PTUCKER', '011.44.1344.129268', '2003-01-05', 'SA_REP', 10000, .3, 145, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 151, 'David', 'Bernstein', 'DBERNSTE', '011.44.1344.345268', '2004-03-05', 'SA_REP', 9500, .25, 145, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 152, 'Peter', 'Hall', 'PHALL', '011.44.1344.478968', '2020-08-05', 'SA_REP', 9000, .25, 145, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 153, 'Christopher', 'Olsen', 'COLSEN', '011.44.1344.498718', '2000-03-06', 'SA_REP', 8000, .2, 145, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 154, 'Nanette', 'Cambrault', 'NCAMBRAU', '011.44.1344.987668', '2009-12-06', 'SA_REP', 7500, .2, 145, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 155, 'Oliver', 'Tuvault', 'OTUVAULT', '011.44.1344.486508', '2003-11-07', 'SA_REP', 7000, .15, 145, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 156, 'Janette', 'King', 'JKING', '011.44.1345.429268', '2003-01-04', 'SA_REP', 10000, .35, 146, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 157, 'Patrick', 'Sully', 'PSULLY', '011.44.1345.929268', '2004-03-04', 'SA_REP', 9500, .35, 146, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 158, 'Allan', 'McEwen', 'AMCEWEN', '011.44.1345.829268', '2001-08-04', 'SA_REP', 9000, .35, 146, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 159, 'Lindsey', 'Smith', 'LSMITH', '011.44.1345.729268', '2010-03-05', 'SA_REP', 8000, .3, 146, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 160, 'Louise', 'Doran', 'LDORAN', '011.44.1345.629268', '2015-12-05', 'SA_REP', 7500, .3, 146, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 161, 'Sarath', 'Sewall', 'SSEWALL', '011.44.1345.529268', '2003-11-06', 'SA_REP', 7000, .25, 146, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 162, 'Clara', 'Vishney', 'CVISHNEY', '011.44.1346.129268', '2011-11-05', 'SA_REP', 10500, .25, 147, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 163, 'Danielle', 'Greene', 'DGREENE', '011.44.1346.229268', '2019-03-07', 'SA_REP', 9500, .15, 147, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 164, 'Mattea', 'Marvins', 'MMARVINS', '011.44.1346.329268', '2004-01-08', 'SA_REP', 7200, .10, 147, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 165, 'David', 'Lee', 'DLEE', '011.44.1346.529268', '2020-02-08', 'SA_REP', 6800, .1, 147, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 166, 'Sundar', 'Ande', 'SANDE', '011.44.1346.629268', '2024-03-08', 'SA_REP', 6400, .10, 147, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 167, 'Amit', 'Banda', 'ABANDA', '011.44.1346.729268', '2021-04-08', 'SA_REP', 6200, .10, 147, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 168, 'Lisa', 'Ozer', 'LOZER', '011.44.1343.929268', '2011-03-05', 'SA_REP', 11500, .25, 148, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 169, 'Harrison', 'Bloom', 'HBLOOM', '011.44.1343.829268', '2023-03-06', 'SA_REP', 10000, .20, 148, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 170, 'Tayler', 'Fox', 'TFOX', '011.44.1343.729268', '2024-01-06', 'SA_REP', 9600, .20, 148, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 171, 'William', 'Smith', 'WSMITH', '011.44.1343.629268', '2023-02-07', 'SA_REP', 7400, .15, 148, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 172, 'Elizabeth', 'Bates', 'EBATES', '011.44.1343.529268', '2024-03-07', 'SA_REP', 7300, .15, 148, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 173, 'Sundita', 'Kumar', 'SKUMAR', '011.44.1343.329268', '2021-04-08', 'SA_REP', 6100, .10, 148, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 174, 'Ellen', 'Abel', 'EABEL', '011.44.1644.429267', '2011-05-04', 'SA_REP', 11000, .30, 149, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 175, 'Alyssa', 'Hutton', 'AHUTTON', '011.44.1644.429266', '2020-03-05', 'SA_REP', 8800, .25, 149, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 176, 'Jonathon', 'Taylor', 'JTAYLOR', '011.44.1644.429265', '2024-03-06', 'SA_REP', 8600, .20, 149, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 177, 'Jack', 'Livingston', 'JLIVINGS', '011.44.1644.429264', '2023-04-06', 'SA_REP', 8400, .20, 149, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 178, 'Kimberely', 'Grant', 'KGRANT', '011.44.1644.429263', '2024-05-07', 'SA_REP', 7000, .15, 149, NULL);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 179, 'Charles', 'Johnson', 'CJOHNSON', '011.44.1644.429262', '2004-01-08', 'SA_REP', 6200, .10, 149, 80);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 180, 'Winston', 'Taylor', 'WTAYLOR', '650.507.9876', '2024-01-06', 'SH_CLERK', 3200, NULL, 120, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 181, 'Jean', 'Fleaur', 'JFLEAUR', '650.507.9877', '2023-02-06', 'SH_CLERK', 3100, NULL, 120, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 182, 'Martha', 'Sullivan', 'MSULLIVA', '650.507.9878', '2021-06-07', 'SH_CLERK', 2500, NULL, 120, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 183, 'Girard', 'Geoni', 'GGEONI', '650.507.9879', '2003-02-08', 'SH_CLERK', 2800, NULL, 120, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 184, 'Nandita', 'Sarchand', 'NSARCHAN', '650.509.1876', '2007-01-04', 'SH_CLERK', 4200, NULL, 121, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 185, 'Alexis', 'Bull', 'ABULL', '650.509.2876', '2020-02-05', 'SH_CLERK', 4100, NULL, 121, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 186, 'Julia', 'Dellinger', 'JDELLING', '650.509.3876', '2024-06-06', 'SH_CLERK', 3400, NULL, 121, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 187, 'Anthony', 'Cabrio', 'ACABRIO', '650.509.4876', '2007-02-07', 'SH_CLERK', 3000, NULL, 121, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 188, 'Kelly', 'Chung', 'KCHUNG', '650.505.1876', '2014-06-05', 'SH_CLERK', 3800, NULL, 122, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 189, 'Jennifer', 'Dilly', 'JDILLY', '650.505.2876', '2013-08-05', 'SH_CLERK', 3600, NULL, 122, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 190, 'Timothy', 'Gates', 'TGATES', '650.505.3876', '2011-07-06', 'SH_CLERK', 2900, NULL, 122, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 191, 'Randall', 'Perkins', 'RPERKINS', '650.505.4876', '2019-12-07', 'SH_CLERK', 2500, NULL, 122, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 192, 'Sarah', 'Bell', 'SBELL', '650.501.1876', '2004-02-04', 'SH_CLERK', 4000, NULL, 123, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 193, 'Britney', 'Everett', 'BEVERETT', '650.501.2876', '2003-03-05', 'SH_CLERK', 3900, NULL, 123, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 194, 'Samuel', 'McCain', 'SMCCAIN', '650.501.3876', '2001-07-06', 'SH_CLERK', 3200, NULL, 123, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 195, 'Vance', 'Jones', 'VJONES', '650.501.4876', '2017-03-07', 'SH_CLERK', 2800, NULL, 123, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 196, 'Alana', 'Walsh', 'AWALSH', '650.507.9811', '2024-04-06', 'SH_CLERK', 3100, NULL, 124, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 197, 'Kevin', 'Feeney', 'KFEENEY', '650.507.9822', '2023-05-06', 'SH_CLERK', 3000, NULL, 124, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 198, 'Donald', 'OConnell', 'DOCONNEL', '650.507.9833', '2021-06-07', 'SH_CLERK', 2600, NULL, 124, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 199, 'Douglas', 'Grant', 'DGRANT', '650.507.9844', '2013-01-08', 'SH_CLERK', 2600, NULL, 124, 50);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 200, 'Jennifer', 'Whalen', 'JWHALEN', '515.123.4444', '2017-09-03', 'AD_ASST', 4400, NULL, 101, 10);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 201, 'Michael', 'Hartstein', 'MHARTSTE', '515.123.5555', '2017-02-04', 'MK_MAN', 13000, NULL, 100, 20);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 202, 'Pat', 'Fay', 'PFAY', '603.123.6666', '2017-08-05', 'MK_REP', 6000, NULL, 201, 20);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 203, 'Susan', 'Mavris', 'SMAVRIS', '515.123.7777', '2007-06-02', 'HR_REP', 6500, NULL, 101, 40);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 204, 'Hermann', 'Baer', 'HBAER', '515.123.8888', '2007-06-02', 'PR_REP', 10000, NULL, 101, 70);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 205, 'Shelley', 'Higgins', 'SHIGGINS', '515.123.8080', '2007-06-02', 'AC_MGR', 12008, NULL, 101, 110);

INSERT INTO employees (employee_id, first_name, last_name, email, phone_number, hire_date, job_id, salary, commission_pct, manager_id, department_id) VALUES
( 206, 'William', 'Gietz', 'WGIETZ', '515.123.8181', '2007-06-02', 'AC_ACCOUNT', 8300, NULL, 205, 110);


INSERT INTO job_history (employee_id, start_date, end_date, job_id, department_id)
VALUES (102,'2013-01-01','2024-07-06', 'IT_PROG', 60);

INSERT INTO job_history (employee_id, start_date, end_date, job_id, department_id)
VALUES (101,'2021-09-17','2023-10-01', 'AC_ACCOUNT', 110);

INSERT INTO job_history (employee_id, start_date, end_date, job_id, department_id)
VALUES (101,'2008-10-01','2015-03-05', 'AC_MGR', 110);

INSERT INTO job_history (employee_id, start_date, end_date, job_id, department_id)
VALUES (201,'2017-02-04','2019-12-07', 'MK_REP', 20);

INSERT INTO job_history (employee_id, start_date, end_date, job_id, department_id)
VALUES  (114,'2024-03-06','2024-04-07', 'ST_CLERK', 50);

INSERT INTO job_history (employee_id, start_date, end_date, job_id, department_id)
VALUES  (122,'2001-01-07','2001-12-07', 'ST_CLERK', 50);

INSERT INTO job_history (employee_id, start_date, end_date, job_id, department_id)
VALUES  (200,'2017-09-15','2017-11-01', 'AD_ASST', 90);

INSERT INTO job_history (employee_id, start_date, end_date, job_id, department_id)
VALUES  (176,'2024-03-06','2024-04-06', 'SA_REP', 80);

INSERT INTO job_history (employee_id, start_date, end_date, job_id, department_id)
VALUES  (176,'2001-01-07','2001-12-07', 'SA_MAN', 80);

INSERT INTO job_history (employee_id, start_date, end_date, job_id, department_id)
VALUES  (200,'2001-07-02','2001-12-06', 'AC_ACCOUNT', 90);