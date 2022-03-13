<?php
    class subject
    {
        // Table fields
        public $id;
        public $description;
        public $ects;
        public $teacher_id;
        // Message string
        public $id_msg;
        public $description_msg;
        public $ects_msg;
        public $teacher_id_msg;
        // Constructor for setting default values
        function __construct()
        {
            $id=$ects=$teacher_id=0;
            $description="";
            $id_msg=$description_msg=$ects_msg=$teacher_id_msg="";
        }
    }
?>