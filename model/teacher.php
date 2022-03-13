<?php
    class teacher
    {
        // Table fields
        public $id;
        public $name;
        public $surname;
        public $title_id;
        // Message string
        public $id_msg;
        public $name_msg;
        public $surname_msg;
        public $title_id_msg;
        // Constructor for setting default values
        function __construct()
        {
            $id=$title_id=0;
            $name=$surname="";
            $id_msg=$name_msg=$surname_msg=$title_id_msg="";
        }
    }
?>