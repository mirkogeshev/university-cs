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

    # Table 'course'
    $sql = "INSERT INTO course (description)  VALUES    ('Information Technology'),
                                                        ('Robotics'),
                                                        ('Web Design'),
                                                        ('Programming languages'),
                                                        ('Networking');";
                                        
    if($connection->query($sql) === TRUE) echo "Seeding table 'course' completed.<br />";
    else echo "Seeding table 'course' failed: " . $connection->error;

    # Table 'student'
    $sql = "INSERT INTO student (name, surname, course_id)  VALUES  ('John', 'Ryan', 1),
                                                                    ('Jessica', 'Ricci', 3),
                                                                    ('Robert', 'Sutton', 2),
                                                                    ('Ivaylo', 'Hristov', 4),
                                                                    ('Ivan', 'Stoyanov', 5),
                                                                    ('Svetlana', 'Risova', 1),
                                                                    ('Sandro', 'Bianchi', 3),
                                                                    ('Miroslav', 'Bonev', 5),
                                                                    ('Paola', 'Curti', 2);";

    if($connection->query($sql) === TRUE) echo "Seeding table 'student' completed.<br />";
    else echo "Seeding table 'student' failed: " . $connection->error;

    # Table 'teacher'
    $sql = "INSERT INTO teacher (name, surname, title_id)  VALUES   ('Aleksandar', 'Sotirov', 4),
                                                                    ('Mei', 'Ling', 1),
                                                                    ('Nevena', 'Kirova', 3),
                                                                    ('Hristo', 'Ivanov', 2),
                                                                    ('Yordan', 'Lozanov', 5),
                                                                    ('Fabio', 'Rossi', 4);";

    if($connection->query($sql) === TRUE) echo "Seeding table 'teacher' completed.<br />";
    else echo "Seeding table 'teacher' failed: " . $connection->error;

    # Table 'subject'
    $sql = "INSERT INTO subject (description, ects, teacher_id) VALUES  ('Programming Fundamentals', 9, 1),
                                                                        ('Databases', 9, 4),
                                                                        ('Physics', 12, 6),
                                                                        ('Mathematics', 12, 6),
                                                                        ('Automation', 9, 3),
                                                                        ('Economy', 6, 5),
                                                                        ('Network administration', 9, 2),
                                                                        ('English', 3, 5),
                                                                        ('Digital Electronics', 9, 2),
                                                                        ('Operating Systems', 9, 5);";

    if($connection->query($sql) === TRUE) echo "Seeding table 'subject' completed.<br />";
    else echo "Seeding table 'subject' failed: " . $connection->error;

    # Table 'enrolled_subjects'
    $sql = "INSERT INTO enrolled_subjects (student_id, subject_id) VALUES   (1, 1),
                                                                            (3, 1),
                                                                            (2, 1),
                                                                            (5, 3),
                                                                            (4, 4),
                                                                            (6, 5),
                                                                            (7, 5),
                                                                            (4, 8),
                                                                            (5, 6),
                                                                            (6, 3),
                                                                            (8, 2),
                                                                            (9, 4),
                                                                            (3, 2),
                                                                            (2, 7),
                                                                            (8, 7),
                                                                            (2, 8),
                                                                            (4, 2),
                                                                            (1, 9),
                                                                            (5, 9),
                                                                            (7, 10),
                                                                            (9, 10),
                                                                            (1, 10),
                                                                            (2, 10),
                                                                            (5, 10),
                                                                            (6, 1),
                                                                            (7, 1),
                                                                            (9, 1);";

    if($connection->query($sql) === TRUE) echo "Seeding table 'enrolled_subjects' completed.<br />";
    else echo "Seeding table 'enrolled_subjects' failed: " . $connection->error;

    $connection->close();

?>

<p><br /><br />
<a href="../index.php">GO BACK</a>
</p>