<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/university-cs/library/class/model.class.php';

    class subjectModel extends Model
    {
        // Retrieves a record from the subject table or gets all the subjects available
        public function selectRecord($id)
        {
            if($id > 0)
            {	
                $query = "SELECT * FROM subject WHERE id=" . $id;
            }
            else
            {
                $query = "SELECT subject.id, subject.description, subject.ects, teacher.name, teacher.surname
                FROM subject, teacher
                WHERE subject.teacher_id = teacher.id
                ORDER BY subject.id";
            }		
            
            $result = $this->query_db($query);

            return $result;
        }

        // Retrieves all the subjects where the student has not applied yet
        public function selectNotAppliedSubjects($id)
        {
            $query = "SELECT subject.id, subject.description 
            FROM subject 
            WHERE subject.id NOT IN (
                SELECT subject.id 
                FROM subject 
                JOIN enrolled_subjects ON subject.id = enrolled_subjects.subject_id 
                JOIN student ON student.id = enrolled_subjects.student_id 
                WHERE student.id = " . $id . "
                )";
            
            $result = $this->query_db($query);

            return $result;
        }

        // Retrieves all the subjects where the student already applied
        public function selectAppliedSubjects($id)
        {
            $query = "SELECT subject.id, subject.description 
            FROM subject 
            WHERE subject.id IN (
                SELECT subject.id 
                FROM subject 
                JOIN enrolled_subjects ON subject.id = enrolled_subjects.subject_id 
                JOIN student ON student.id = enrolled_subjects.student_id WHERE student.id = " . $id . "
                )";
            
            $result = $this->query_db($query);

            return $result;
        }

        // Retrieves the top three subjects in the faculty that have the most students
        public function selectTop3Subjects()
        {
            $query = "SELECT subject.description, COUNT(enrolled_subjects.student_id) AS total_students
            FROM subject
            JOIN enrolled_subjects ON subject.id = enrolled_subjects.subject_id
            GROUP BY subject.description
            ORDER BY total_students DESC
            LIMIT 3";
            
            $result = $this->query_db($query);

            return $result;
        }
    }
?>