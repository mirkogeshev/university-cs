<?php
	require_once $_SERVER['DOCUMENT_ROOT'] . '/university-cs/library/class/model.class.php';

    class titleModel extends Model
    {
        // Retrieves all the teacher's titles available from the table
        public function selectRecord()
        {
			$query = "SELECT * FROM title";
			
			$result = $this->query_db($query);

			return $result;
        }
    }
?>