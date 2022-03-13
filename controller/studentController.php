<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/university-cs/library/class/controller.class.php';

    require 'model/studentModel.php';
    require 'model/courseModel.php';
    require 'model/subjectModel.php';
    require 'model/student.php';
    require 'model/course.php';
    require 'model/subject.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

    class studentController extends Controller
    {
        function __construct() 
        {          
            $this->objconfig = new config();
            $this->objstudent =  new studentModel($this->objconfig);
        }

        /* Handles the Model View Controller of the application
           Based on the action passed from the view through GET method, it selects the right action to take*/
        public function mvcHandler()
        {
            $action = isset($_GET['act']) ? $_GET['act'] : NULL;
            switch ($action) 
            {
                case 'add' :             
                    $this->insert();
                    break;		
                case 'update':
                    $this->update();
                    break;
                case 'delete' :		
                    $this->delete();
                    break;
                case 'assign':
                    $this->assign();
                    break;
                case 'unassign':
                    $this->unassign();
                    break;						
                default:
                    $this->list();
            }
        }

        private function insert()
        {
            if (isset($_POST['addbtn'])) 
            {
                $data = array(
                    'name' => trim('"' . $_POST['name'] . '"'),
                    'surname' => trim('"' . $_POST['surname'] . '"'),
                    'course_id' => trim($_POST['course_id'])
                );

                $this->objstudent->insertRecord('student', $data);

                $this->pageRedirect("/university-cs/students.php");

                exit();
            }
            else
            {
                $objcourse = new courseModel($this->objconfig);

                $result = $objcourse->selectRecord();
                
                $coursetb = new course();

                $_SESSION['coursetbl0'] = array();

                while($row = mysqli_fetch_array($result))
                {
                    $coursetb->id = $row['id'];
                    $coursetb->description = $row['description'];
                    $_SESSION['coursetbl0'][] = serialize($coursetb);
                }

                $this->pageRedirect('/university-cs/view/studentinsert.php');

                exit();
            }
        }

        private function update()
        {
            if(isset($_POST['updatebtn']))
            {
                $record_id = trim($_POST['id']);

                $data = array(
                    'name' => trim($_POST['name']),
                    'surname' => trim($_POST['surname'])
                );

                $this->objstudent->updateRecord('student', $record_id, $data);

                $this->pageRedirect('/university-cs/students.php');

                exit();
            }
            elseif(($_GET["id"]) && !empty(trim($_GET["id"])))
            {
                $id = $_GET['id'];
                $result = $this->objstudent->selectRecord($id);
                $row = mysqli_fetch_array($result);
                
                $studenttb = new student();              
                $studenttb->id = $row["id"];
                $studenttb->name = $row["name"];
                $studenttb->surname = $row["surname"];

                $_SESSION['studenttbl0'] = serialize($studenttb);

                $this->pageRedirect('/university-cs/view/studentupdate.php');

                exit();
            }
            else
            {
                echo "Invalid operation.";
            }
        }

        private function delete()
        {
            if (isset($_GET['id'])) 
            {
                $id = $_GET['id'];
                $res = $this->objstudent->deleteRecord("student", $id);                
                $this->pageRedirect('/university-cs/students.php');
            }
            else
            {
                echo "Invalid operation.";
            }
        }

        private function assign()
        {
            $objsubject =  new subjectModel($this->objconfig);

            $result = $objsubject->selectRecord(0);
            $rowcount = mysqli_num_rows($result);
            mysqli_free_result($result);
            
            if($rowcount > 0)
            {
                if(isset($_POST['assignbtn']))
                {
                    $studenttb=unserialize($_SESSION['studenttbl0']);
                    $studenttb->student_id = trim($_POST['student_id']);
                    $studenttb->subject_id = trim($_POST['subject_id']);

                    $this->objstudent->assignSubject($studenttb);

                    $this->pageRedirect('/university-cs/students.php');

                    exit();
                }
                elseif(($_GET["id"]) && !empty(trim($_GET["id"])))
                {
                    $id = $_GET['id'];
                    $result = $this->objstudent->selectRecord($id);
                    $row = mysqli_fetch_array($result);
                    mysqli_free_result($result);

                    $studenttb = new student();              
                    $studenttb->id = $row["id"];
                    $studenttb->name = $row["name"];
                    $studenttb->surname = $row["surname"];

                    $_SESSION['studenttbl0'] = serialize($studenttb);

                    $subject = new subjectModel($this->objconfig);

                    $result = $subject->selectNotAppliedSubjects($id);
                    $rowcount = mysqli_num_rows($result);

                    if($rowcount > 0)
                    {
                        $subjecttb = new subject();      

                        $_SESSION['subjecttbl0'] = array();

                        while($row = mysqli_fetch_array($result))
                        {
                            $subjecttb->id = $row['id'];
                            $subjecttb->description = $row['description'];
                            $_SESSION['subjecttbl0'][] = serialize($subjecttb);
                        }

                        mysqli_free_result($result);

                        $this->pageRedirect('/university-cs/view/studentassign.php');

                        exit();
                    }
                    else
                    {
                        mysqli_free_result($result);
                        
                        $e = '<h2>This student is already enrolled in all the subjects available of this faculty!</h2><br><h2>Click <a href="/university-cs/students.php">here</a> to go back.</h2>';
                        die($e);
                    }
                }
                else
                {
                    echo "Invalid operation.";
                }
            }
            else
            {
                $e = '<h2>No subjects are available in this faculty, please create them in the Subjects section!</h2><br><h2>Click <a href="/university-cs/subjects.php">here</a> to go there.</h2>';
                die($e);
            }
        }

        private function unassign()
        {
            $objsubject =  new subjectModel($this->objconfig);

            $result = $objsubject->selectRecord(0);
            $rowcount = mysqli_num_rows($result);
            mysqli_free_result($result);
            
            if($rowcount > 0)
            {
                if(isset($_POST['unassignbtn']))
                {
                    $studenttb=unserialize($_SESSION['studenttbl0']);
                    $studenttb->student_id = trim($_POST['student_id']);
                    $studenttb->subject_id = trim($_POST['subject_id']);

                    $this->objstudent->unassignSubject($studenttb);

                    $this->pageRedirect('/university-cs/students.php');

                    exit();
                }
                elseif(($_GET["id"]) && !empty(trim($_GET["id"])))
                {
                    $id = $_GET['id'];
                    $result = $this->objstudent->selectRecord($id);
                    $row = mysqli_fetch_array($result);
                    mysqli_free_result($result);

                    $studenttb = new student();              
                    $studenttb->id = $row["id"];
                    $studenttb->name = $row["name"];
                    $studenttb->surname = $row["surname"];

                    $_SESSION['studenttbl0'] = serialize($studenttb);

                    $subject = new subjectModel($this->objconfig);

                    $result = $subject->selectAppliedSubjects($id);
                    $rowcount = mysqli_num_rows($result);

                    if($rowcount > 0)
                    {
                        $subjecttb = new subject();      

                        $_SESSION['subjecttbl0'] = array();

                        while($row = mysqli_fetch_array($result))
                        {
                            $subjecttb->id = $row['id'];
                            $subjecttb->description = $row['description'];
                            $_SESSION['subjecttbl0'][] = serialize($subjecttb);
                        }

                        mysqli_free_result($result);

                        $this->pageRedirect('/university-cs/view/studentunassign.php');

                        exit();
                    }
                    else
                    {
                        mysqli_free_result($result);
                        
                        $e = '<h2>This student is not enrolled in any of the subjects available of this faculty!</h2><br><h2>Click <a href="/university-cs/students.php">here</a> to go back.</h2>';
                        die($e);
                    }
                }
                else
                {
                    echo "Invalid operation.";
                }
            }
            else
            {
                $e = '<h2>No subjects are available in this faculty, please create them in the Subjects section!</h2><br><h2>Click <a href="/university-cs/subjects.php">here</a> to go there.</h2>';
                die($e);
            }
        }

        private function list()
        {
            $result = $this->objstudent->selectRecord(0);
            include "view/studentlist.php";
        }
    }
?>