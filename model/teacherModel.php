<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/university-cs/library/class/model.class.php';

    class teacherModel extends Model
    {
        // Retrieves a single teacher by id or gets the entire teachers list
		public function selectRecord($id)
		{
			if($id > 0)
			{	
				$query = "SELECT * FROM teacher WHERE id=" . $id;
			}
			else
			{
				$query = "SELECT teacher.id, teacher.name, teacher.surname, title.description 
				FROM teacher, title 
				WHERE teacher.title_id = title.id 
				ORDER BY teacher.id";
			}		
			
			$result = $this->query_db($query);

			return $result;
		}

		// Retrieves all the teachers of the faculty and how many subjects any teacher has on his name
		public function selectTeachers()
        {
			$query = "SELECT teacher.name, teacher.surname, COUNT(subject.teacher_id) AS 'enrolled_subjects'
			FROM teacher
			JOIN subject ON teacher.id = subject.teacher_id
			GROUP BY teacher.id
			ORDER BY teacher.name ASC";
			
			$result = $this->query_db($query);

			return $result;
        }

		// Retrieves all the teachers, subjects of the faculty and also how many students are enrolled on each subject
		public function selectTeacherSubjects()
        {
			$query = "SELECT teacher.name, teacher.surname, subject.description, COUNT(enrolled_subjects.student_id) AS total_students
			FROM teacher
			JOIN subject ON teacher.id = subject.teacher_id
			JOIN enrolled_subjects ON subject.id = enrolled_subjects.subject_id
			GROUP BY subject.description ASC";
			
			$result = $this->query_db($query);

			return $result;
        }

		// Retrieves the top three teachers in the faculty that have the most students from all their subjects that are currently teaching
		public function selectTop3Teachers()
        {
			$query = "SELECT teacher.name, teacher.surname, COUNT(enrolled_subjects.student_id) AS total_students
			FROM teacher
			JOIN subject ON teacher.id = subject.teacher_id
			JOIN enrolled_subjects ON subject.id = enrolled_subjects.subject_id
			GROUP BY teacher.name
			ORDER BY total_students DESC
			LIMIT 3";
			
			$result = $this->query_db($query);

			return $result;
        }
    }
?>