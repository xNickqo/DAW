DROP DATABASE IF EXISTS employees;
CREATE DATABASE IF NOT EXISTS employees;
USE employees;

DROP TABLE IF EXISTS dept_emp,
                     dept_manager,
                     titles,
                     salaries, 
                     employees, 
                     departments;

set default_storage_engine = InnoDB;


CREATE TABLE employees (
    emp_no      INT             NOT NULL,
    birth_date  DATE            NOT NULL,
    first_name  VARCHAR(14)     NOT NULL,
    last_name   VARCHAR(16)     NOT NULL,
    gender      ENUM ('M','F')  NOT NULL,    
    hire_date   DATE            NOT NULL,
    PRIMARY KEY (emp_no)
);

CREATE TABLE departments (
    dept_no     CHAR(4)         NOT NULL,
    dept_name   VARCHAR(40)     NOT NULL,
    PRIMARY KEY (dept_no),
    UNIQUE  KEY (dept_name)
);

CREATE TABLE dept_manager (
   emp_no       INT             NOT NULL,
   dept_no      CHAR(4)         NOT NULL,
   from_date    DATE            NOT NULL,
   to_date      DATE            ,
   FOREIGN KEY (emp_no)  REFERENCES employees (emp_no)    ON DELETE CASCADE,
   FOREIGN KEY (dept_no) REFERENCES departments (dept_no) ON DELETE CASCADE,
   PRIMARY KEY (emp_no,dept_no)
); 

CREATE TABLE dept_emp (
    emp_no      INT             NOT NULL,
    dept_no     CHAR(4)         NOT NULL,
    from_date   DATE            NOT NULL,
    to_date     DATE           ,
    FOREIGN KEY (emp_no)  REFERENCES employees   (emp_no)  ON DELETE CASCADE,
    FOREIGN KEY (dept_no) REFERENCES departments (dept_no) ON DELETE CASCADE,
    PRIMARY KEY (emp_no,dept_no)
);

CREATE TABLE titles (
    emp_no      INT             NOT NULL,
    title       VARCHAR(50)     NOT NULL,
    from_date   DATE            NOT NULL,
    to_date     DATE,
    FOREIGN KEY (emp_no) REFERENCES employees (emp_no) ON DELETE CASCADE,
    PRIMARY KEY (emp_no,title, from_date)
) 
; 

CREATE TABLE salaries (
    emp_no      INT             NOT NULL,
    salary      INT             NOT NULL,
    from_date   DATE            NOT NULL,
    to_date     DATE           ,
    FOREIGN KEY (emp_no) REFERENCES employees (emp_no) ON DELETE CASCADE,
    PRIMARY KEY (emp_no, from_date)
) 
; 



-- Inserts para la tabla employees
INSERT INTO employees (emp_no, birth_date, first_name, last_name, gender, hire_date) VALUES
(10001, '1980-01-01', 'John', 'Doe', 'M', '2005-03-15'),
(10002, '1985-05-23', 'Jane', 'Smith', 'F', '2010-07-19');

-- Inserts para nuevos empleados
INSERT INTO employees (emp_no, birth_date, first_name, last_name, gender, hire_date) VALUES
(10003, '1990-02-14', 'Alice', 'Johnson', 'F', '2012-09-01'),
(10004, '1978-12-22', 'Robert', 'Brown', 'M', '2000-11-10'),
(10005, '1995-07-08', 'Emily', 'Davis', 'F', '2018-06-15'),
(10006, '1982-04-03', 'Michael', 'Wilson', 'M', '2008-01-25');

-- Inserts para la tabla departments
INSERT INTO departments (dept_no, dept_name) VALUES
('d001', 'Marketing'),
('d002', 'Finance');

-- Insert para el nuevo departamento
INSERT INTO departments (dept_no, dept_name) VALUES
('d003', 'Human Resources');


-- Inserts para la tabla dept_emp
INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date) VALUES
(10001, 'd001', '2005-03-15', null),
(10002, 'd002', '2010-07-19', null),
(10003, 'd003', '2012-09-01', null),
(10004, 'd001', '2000-11-10', '2015-12-31'),
(10005, 'd002', '2018-06-15', null),
(10006, 'd003', '2008-01-25', null);

INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date) VALUES
(10004, 'd003', '2016-01-01', null);

-- Inserts para la tabla dept_manager
INSERT INTO dept_manager (emp_no, dept_no, from_date, to_date) VALUES
(10001, 'd001', '2010-01-01', null),
(10002, 'd002', '2015-06-01', null),
(10006, 'd003', '2018-01-01', null);

-- Inserts para la tabla salaries
INSERT INTO salaries (emp_no, salary, from_date, to_date) VALUES
(10001, 60000, '2005-03-15', '2010-12-31'),
(10001, 75000, '2011-01-01', null),
(10002, 55000, '2010-07-19', '2017-06-30'),
(10002, 70000, '2017-07-01', null),
(10003, 50000, '2012-09-01', '2018-08-31'),
(10003, 65000, '2018-09-01', null),
(10004, 40000, '2000-11-10', '2009-12-31'),
(10004, 55000, '2010-01-01', '2015-12-31'),
(10005, 60000, '2018-06-15', null),
(10006, 50000, '2008-01-25', '2013-12-31'),
(10006, 70000, '2014-01-01', null);


-- Inserts para la tabla titles
INSERT INTO titles (emp_no, title, from_date, to_date) VALUES
(10001, 'Junior Engineer', '2005-03-15', '2010-12-31'),
(10001, 'Senior Engineer', '2011-01-01', null),
(10002, 'Accountant', '2010-07-19', '2017-06-30'),
(10002, 'Finance Manager', '2017-07-01', null),
(10003, 'HR Assistant', '2012-09-01', '2018-08-31'),
(10003, 'HR Manager', '2018-09-01', null),
(10004, 'Marketing Specialist', '2000-11-10', '2009-12-31'),
(10004, 'Marketing Manager', '2010-01-01', '2015-12-31'),
(10005, 'Financial Analyst', '2018-06-15', null),
(10006, 'HR Specialist', '2008-01-25', '2013-12-31'),
(10006, 'HR Director', '2014-01-01', null);

commit;
