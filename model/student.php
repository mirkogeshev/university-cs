<?php
    class student
    {
        // Table fields
        public $id;
        public $name;
        public $surname;
        public $course_id;
        // Message string
        public $id_msg;
        public $name_msg;
        public $surname_msg;
        public $course_id_msg;
        // Constructor for setting default values
        function __construct()
        {
            $id=$course_id=0;
            $name=$surname="";
            $id_msg=$name_msg=$surname_msg=$course_id_msg="";
        }
    }
?>