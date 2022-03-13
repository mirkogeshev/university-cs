<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/university-cs/library/class/model.class.php';

    class courseModel extends Model
    {
        // Retrieves all the courses available from the table
        public function selectRecord()
        {
			$query = "SELECT * FROM course";	
			
			$result = $this->query_db($query);

			return $result;
        }
    }
?>