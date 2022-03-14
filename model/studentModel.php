<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/university-cs/library/class/model.class.php';

    class studentModel extends Model
    {
        // Retrieves a single student by id or gets the entire student list
        public function selectRecord($id)
        {
            if($id > 0)
            {	
                $query = "SELECT * FROM student WHERE id=" . $id;
            }
            else
            {
                $query = "SELECT student.id, student.name, student.surname, course.description 
                FROM student, course 
                WHERE student.course_id = course.id 
                ORDER BY id";
            }		
            
            $result = $this->query_db($query);

            return $result;
        }

        // Assigns a student to an available subject of the faculty
        public function assignSubject($obj)
        {
            $query = "INSERT INTO enrolled_subjects (student_id, subject_id) VALUES (". $obj->student_id . "," . $obj->subject_id . ")";

            $result = $this->query_db($query);
            
            return $result;
        }

        // Unassigns a student from a subject of the faculty
        public function unassignSubject($obj)
        {
            $query = "DELETE FROM enrolled_subjects WHERE student_id=$obj->student_id AND subject_id=" . $obj->subject_id;

            $result = $this->query_db($query);

            return $result;
        }

        // Retrieves all the students enrolled in the faculty with their enrolled course
        public function selectStudents()
        {
            $query = "SELECT student.id, student.name, student.surname, course.description AS 'course_name' 
            FROM student, course 
            WHERE student.course_id = course.id 
            ORDER BY student.name ASC";	
            
            $result = $this->query_db($query);
                            
            return $result;
        }

        // Retrieves all the students and their choosen subjects
        public function selectStudentSubjects()
        {
            $query = "SELECT student.name, student.surname, GROUP_CONCAT(subject.description) as enrolled_subjects
            FROM student
            JOIN enrolled_subjects
            ON student.id = enrolled_subjects.student_id
            JOIN subject
            ON enrolled_subjects.subject_id = subject.id
            GROUP BY student.id";
            
            $result = $this->query_db($query);
                        
            return $result;
        }

        // Retrieves the students current earned credits
        public function selectStudentEarnedCredits()
        {
            $query = "SELECT student.name, student.surname, SUM(subject.ects) AS earned_ects
            FROM student
            JOIN enrolled_subjects
            ON student.id = enrolled_subjects.student_id
            JOIN subject
            ON enrolled_subjects.subject_id = subject.id
            GROUP BY student.id, student.name
            ORDER BY earned_ects DESC";
            
            $result = $this->query_db($query);
                    
            return $result;
        }
    }
?>