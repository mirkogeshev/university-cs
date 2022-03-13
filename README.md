# University - Computer Science faculty backoffice
## A PHP based, MVC (Model-View-Controller) object oriented web application

### Description
This web application manages the Computer Science faculty of a University

Available functions:
- Add, manage and delete Students and Teachers
- Add manage and delete the faculty's subjects
- Assign and unassign the students from the available subjects

- Ready to use reports:
  - Check all the enrolled Students and Teachers;
  - Check all the students and their total earned credits (ECTS) got from any enrolled subject in the faculty;
  - Check all the teachers, what subjects they are teaching and the total number of the students enrolled for any subject;
  - Check the top three subjects with most enrolled students
  - Check the top three teachers with the most enrolled students from the subject they are teaching.

### How to install and run
1) Download and install XAMPP or any similar software (It must have at least a Web Server + PHP support + MySQL server);
2) Clone this repository into "htdocs/university-cs" folder;
3) Start the webserver and the MariaDB/MySQL server;
4) Access the webapp from your browser (e.g. http://localhost/university-cs);
5) Create on your MariaDB/MySQL server the "university_cs" database;
6) Install the database tables from the web application's homepage.