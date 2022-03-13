<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/university-cs/library/class/controller.class.php';

    require 'model/subjectModel.php';
    require 'model/subject.php';
    require 'model/teacherModel.php';
    require 'model/teacher.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

    class subjectController extends Controller
    {
        function __construct() 
        {          
            $this->objconfig = new config();
            $this->objsubject =  new subjectModel($this->objconfig);
        }

        // Inserts a new subject in the table's database
        protected function insert()
        {
            $objteacher = new teacherModel($this->objconfig);

            $result = $objteacher->selectRecord(0);
            $rowcount = mysqli_num_rows($result);
            mysqli_free_result($result);

            if($rowcount > 0)
            {
                if (isset($_POST['addbtn'])) 
                {
                    $data = array(
                        'name' => trim('"' . $_POST['description'] . '"'),
                        'surname' => trim($_POST['ects']),
                        'course_id' => trim($_POST['teacher_id'])
                    );

                    $this->objsubject->insertRecord("subject", $data);

                    $this->pageRedirect("/university-cs/subjects.php");

                    exit();
                }
                else
                {
                    $result = $objteacher->selectRecord(0);
                    
                    $teachertb = new teacher();

                    $_SESSION['teachertbl0'] = array();

                    while($row = mysqli_fetch_array($result))
                    {
                        $teachertb->id = $row['id'];
                        $teachertb->name = $row['name'];
                        $teachertb->surname = $row['surname'];
                        $_SESSION['teachertbl0'][] = serialize($teachertb);
                    }

                    $this->pageRedirect('/university-cs/view/subjectinsert.php');

                    exit();
                }
            }
            else
            {
                $e = '<h2>No teachers are available in this faculty, please create them in the Teacher section!</h2><br><h2>Click <a href="/university-cs/teachers.php">here</a> to go there.</h2>';
                die($e);
            }
        }

        // Updates an existing subject in the table's database
        protected function update()
        {
            if(isset($_POST['updatebtn']))
            {
                $record_id = trim($_POST['id']);

                $data = array(
                    'description' => trim($_POST['description']),
                    'ects' => trim($_POST['ects'])
                );

                $this -> objsubject ->updateRecord('subject', $record_id, $data);

                $this->pageRedirect('/university-cs/subjects.php');
            }
            elseif(($_GET["id"]) && !empty(trim($_GET["id"])))
            {
                $id = $_GET['id'];
                $result = $this->objsubject->selectRecord($id);
                $row = mysqli_fetch_array($result);
                $subjecttb = new subject();              
                $subjecttb->id = $row["id"];
                $subjecttb->description = $row["description"];
                $subjecttb->ects = $row["ects"];

                $_SESSION['subjecttbl0'] = serialize($subjecttb);

                $this->pageRedirect('/university-cs/view/subjectupdate.php');
            }
            else
            {
                echo "Invalid operation.";
            }
        }

        // Deletes an existing subject from the table's database
        protected function delete()
        {
            if (isset($_GET['id'])) 
            {
                $id = $_GET['id'];
                $res = $this->objsubject->deleteRecord("subject", $id);                
                $this->pageRedirect('/university-cs/subjects.php');
            }
            else
            {
                echo "Invalid operation.";
            }
        }

        // Returns the Subjects list view
        protected function list()
        {
            $result = $this->objsubject->selectRecord(0);
            include "view/subjectlist.php";
        }
    }
?>