<?php
    class course
    {
        // Table fields
        public $id;
        public $description;
        // Message string
        public $id_msg;
        public $description_msg;
        // Constructor for setting default values
        function __construct()
        {
            $id=0;
            $description="";
            $id_msg=$description_msg="";
        }
    }
?>