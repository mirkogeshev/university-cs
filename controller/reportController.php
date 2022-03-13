<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/university-cs/library/class/controller.class.php';

    require 'model/studentModel.php';
    require 'model/teacherModel.php';
    require 'model/subjectModel.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

    class reportController extends Controller
    {
        function __construct() 
        {          
            $this->objconfig = new config();
            $this->objstudent =  new studentModel($this->objconfig);
            $this->objteacher =  new teacherModel($this->objconfig);
            $this->objsubject =  new subjectModel($this->objconfig);
        }

        /* Handles the Model View Controller of the application
           Based on the action passed from the view through GET method, it selects the right action to take*/
        public function mvcHandler()
        {
            $action = isset($_GET['act']) ? $_GET['act'] : NULL;
            switch ($action) 
            {
                case 'studentSubjects' :             
                    $this->studentSubjects();
                    break;
                case 'studentCredits' :             
                    $this->studentCredits();
                    break;	
                case 'teacherSubjects' :             
                    $this->teacherSubjects();
                    break;
                case 'top3subjects' :             
                    $this->top3subjects();
                    break;
                case 'top3teachers' :             
                    $this->top3teachers();
                    break;
                default:
                    $this->generalList();
            }
        }

        // Populates the view for the report "Student enrolled subjects"
        private function studentSubjects()
        {
            $result = $this->objstudent->selectStudentSubjects();

            include "library/view/header.php";
            include "view/report-studentSubjects.php";
            include "library/view/footer.php";
        }

        // Populates the view for the report "Students total credits"
        private function studentCredits()
        {
            $result = $this->objstudent->selectStudentEarnedCredits();

            include "library/view/header.php";
            include "view/report-studentCredits.php";
            include "library/view/footer.php";
        }

        // Populates the view for the report "Teachers assigned subjects"
        private function teacherSubjects()
        {
            $result = $this->objteacher->selectTeacherSubjects();

            include "library/view/header.php";
            include "view/report-teacherassignedsubjects.php";
            include "library/view/footer.php";
        }

        // Populates the view for the report "Top 3 subjects with most students"
        private function top3subjects()
        {
            $result = $this->objsubject->selectTop3Subjects();

            include "library/view/header.php";
            include "view/report-top3subjects.php";
            include "library/view/footer.php";
        }

        // Populates the view for the report "Top 3 teachers with most students"
        private function top3teachers()
        {
            $result = $this->objteacher->selectTop3Teachers();

            include "library/view/header.php";
            include "view/report-top3teachers.php";
            include "library/view/footer.php";
        }

        // Populates the view for the report that contains both "Teacher list" and "Student list"
        private function generalList()
        {
            $result = $this->objteacher->selectTeachers();

            include "library/view/header.php";
            include "view/report-teachers.php";

            $result = $this->objstudent->selectStudents();
            
            include "view/report-students.php";
            include "library/view/footer.php";
        }
    }
?>