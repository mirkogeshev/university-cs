<?php
    /*
        Automatic script for database creation for MVC project "university-cs"
        Mirko Gesev
        2022
    */

	require_once("connection.php");
		
	# Database creation
	$sql = "CREATE DATABASE IF NOT EXISTS university_cs;";
	if($connection->query($sql) === TRUE)
	{
		echo "Database creation done.<br />";
	}
	else
	{
		echo "Database creation failed!<br />";
	}
	
	# Create database connection
	$connection = new mysqli($serverName, $usernameDB, $passwordDB, $databaseName);
	if($connection->connect_error)
	{
		echo "Connection failed with database: $databaseName <br />";
	}
	else
	{
		echo "Connected to database: $databaseName <br />";
	}

	# Tables creation
	# Table 'title'
	$sql = "CREATE TABLE IF NOT EXISTS title (
					id          INT AUTO_INCREMENT PRIMARY KEY,
					description VARCHAR(255)
				);";

	if($connection->query($sql) === TRUE) echo "Table 'title' created.<br />";
	else echo "Table creation 'title' failed: " . $connection->error . "<br />";

	# Table 'course'
	$sql = "CREATE TABLE IF NOT EXISTS course (
					id          INT AUTO_INCREMENT PRIMARY KEY,
					description VARCHAR(255)
	  			);";

	if($connection->query($sql) === TRUE) echo "Table 'course' created.<br />";
	else echo "Table creation 'course' failed: " . $connection->error . "<br />";
	
	# Table 'student'
	$sql = "CREATE TABLE IF NOT EXISTS student (
					id            INT AUTO_INCREMENT PRIMARY KEY,
					name          VARCHAR(255),
					surname       VARCHAR(255),
					course_id     INT,
					FOREIGN KEY (course_id) REFERENCES course (id)
								ON DELETE CASCADE
								ON UPDATE RESTRICT
				);";

	if($connection->query($sql) === TRUE) echo "Table 'student' created.<br />";
	else echo "Table creation 'student' failed: " . $connection->error . "<br />";

	# Table 'teacher'
	$sql = "CREATE TABLE IF NOT EXISTS teacher (
					id            INT AUTO_INCREMENT PRIMARY KEY,
					name          VARCHAR(255),
					surname       VARCHAR(255),
					title_id    INT,
					FOREIGN KEY (title_id) REFERENCES title (id)
								ON DELETE CASCADE
								ON UPDATE RESTRICT
				);";

	if($connection->query($sql) === TRUE) echo "Table 'teacher' created.<br />";
	else echo "Table creation 'teacher' failed: " . $connection->error . "<br />";

	# Table 'subject'
	$sql = "CREATE TABLE IF NOT EXISTS subject (
					id            INT AUTO_INCREMENT PRIMARY KEY,
					description   VARCHAR(255),
					ects          INT,
					teacher_id    INT,
					FOREIGN KEY (teacher_id) REFERENCES teacher (id)
								ON DELETE CASCADE
								ON UPDATE RESTRICT
				);";

	if($connection->query($sql) === TRUE) echo "Table 'subject' created.<br />";
	else echo "Table creation 'subject' failed: " . $connection->error . "<br />";

	# Table 'enrolled_subjects'
	$sql = "CREATE TABLE IF NOT EXISTS enrolled_subjects (
					student_id    INT,
					subject_id    INT,
					FOREIGN KEY (student_id) REFERENCES student (id)
								ON DELETE CASCADE
								ON UPDATE RESTRICT,
					FOREIGN KEY (subject_id) REFERENCES subject (id)
								ON DELETE CASCADE
								ON UPDATE RESTRICT
				);";

	if($connection->query($sql) === TRUE) echo "Table 'enrolled_subjects' created.<br />";
	else echo "Table creation 'enrolled_subjects' failed: " . $connection->error . "<br />";
	
	
	# Table seeding
	# Table 'title'
	$sql = "INSERT INTO title (description)   VALUES    ('Assistant'),
														('Chief assistant'),
														('Lecturer'),
														('Professor'),
														('Tutor');";
										
	if($connection->query($sql) === TRUE) echo "Seeding table 'title' completed.<br />";
	else echo "Seeding table 'title' failed: " . $connection->error;

	# Table 'title'
	$sql = "INSERT INTO course (description)  VALUES    ('Information Technology'),
														('Robotics'),
														('Web Design'),
														('Programming languages');";
										
	if($connection->query($sql) === TRUE) echo "Seeding table 'title' completed.<br />";
	else echo "Seeding table 'title' failed: " . $connection->error;
	
$connection->close();

?>

<p><br /><br />
<a href="../index.php">GO BACK</a>
</p>