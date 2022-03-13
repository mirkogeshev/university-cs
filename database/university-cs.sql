CREATE DATABASE IF NOT EXISTS university_cs;

CREATE TABLE IF NOT EXISTS title (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  description VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS course (
  id          INT AUTO_INCREMENT PRIMARY KEY,
  description VARCHAR(255)
);

CREATE TABLE IF NOT EXISTS student (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  name          VARCHAR(255),
  surname       VARCHAR(255),
  course_id     INT,
  FOREIGN KEY (course_id) REFERENCES course (id)
                ON DELETE CASCADE
                ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS teacher (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  name          VARCHAR(255),
  surname       VARCHAR(255),
  title_id    INT,
  FOREIGN KEY (title_id) REFERENCES title (id)
                ON DELETE CASCADE
                ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS subject (
  id            INT AUTO_INCREMENT PRIMARY KEY,
  description   VARCHAR(255),
  ects          INT,
  teacher_id    INT,
  FOREIGN KEY (teacher_id) REFERENCES teacher (id)
                ON DELETE CASCADE
                ON UPDATE RESTRICT
);

CREATE TABLE IF NOT EXISTS enrolled_subjects (
  student_id    INT,
  subject_id    INT,
  FOREIGN KEY (student_id) REFERENCES student (id)
                ON DELETE CASCADE
                ON UPDATE RESTRICT,
  FOREIGN KEY (subject_id) REFERENCES subject (id)
                ON DELETE CASCADE
                ON UPDATE RESTRICT
);

INSERT INTO title (description)   VALUES    ('Assistant'),
                                            ('Chief assistant'),
                                            ('Lecturer'),
                                            ('Professor'),
                                            ('Tutor');

INSERT INTO course (description)  VALUES    ('Information Technology'),
                                            ('Robotics'),
                                            ('Web Design'),
                                            ('Programming languages');