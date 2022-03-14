<?php
    class Model
    {
        /* Sets the database config for database connection when the object is created
           @param {class} The configuration class that contains the database's connection information
        */
        function __construct($dbconnsetup)
        {
            $this->host = $dbconnsetup->host;
            $this->user = $dbconnsetup->user;
            $this->pass =  $dbconnsetup->pass;
            $this->db = $dbconnsetup->db;
        }

        // Opens the database connection using the database's connection information give by this class constructor
        protected function open_db()
        {
            $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->db);
            if ($this->connection->connect_error)
            {
                die("Connection error: " . $this->connection->connect_error);
            }
        }

        // Closes an already opened database connection
        protected function close_db()
        {
            $this->connection->close();
        }

        /* Gets a SQL query and executes it on the database
           @param {string} The SQL query that needs to be executed
        */
        protected function query_db($query)
        {
            try
            {
                $this->open_db();

                $prep_query = $this->connection->prepare($query);

                $prep_query->execute();
                $result = $prep_query->get_result();
                $prep_query->close();

                $this->close_db();
                
                return $result;
            }
            catch (Exception $e)
            {
                $this->close_db();
                throw $e;
            }
        }

        /* Inserts a record in the database's table
           @param {string} The name of the table where the data will be added
           @param {Array} An array of the data that will be added to the database's table
        */
        public function insertRecord($table, $data)
        {
            $data_str = implode(',', $data);

            $query = 'INSERT INTO ' . $table . ' VALUES (NULL,' . $data_str . ')';

            $this->query_db($query);
        }

        /* Updates a record in the database's table
           @param {string} The name of the table where the data will be updated
           @param {number} The id of the record that will be updated
           @param {Array} An array of the data that will be updated to the database's table
        */
        public function updateRecord($table, $id, $data)
        {
            if(count($data) > 0)
            {
                foreach($data as $key => $value)
                {
                    $value = "'$value'";
                    $data_updated[] = "$key = $value";
                }
            }

            $data_str = implode(', ', $data_updated);

            $query = 'UPDATE ' . $table . ' SET ' . $data_str . ' WHERE id=' . $id;

            $this->query_db($query);
        }

        /* Deletes a record in the database's table
           @param {string} The name of the table in the database where the data will be deleted
           @param {number} The id of the record that will be deleted from the database's table
        */
        public function deleteRecord($table, $id)
        {	
            $this->open_db();

            $query = 'DELETE FROM ' . $table . ' WHERE id=' . $id;

            $this->query_db($query);	
        }
    }
?>