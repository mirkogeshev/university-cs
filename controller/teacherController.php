<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/university-cs/library/class/controller.class.php';

    require 'model/teacherModel.php';
    require 'model/titleModel.php';
    require 'model/teacher.php';
    require 'model/title.php';
    require_once 'config.php';

    session_status() === PHP_SESSION_ACTIVE ? TRUE : session_start();

    class teacherController extends Controller
    {
        function __construct() 
        {          
            $this->objconfig = new config();
            $this->objteacher =  new teacherModel($this->objconfig);
        }

        // Inserts a new teacher in the table's database
        protected function insert()
        {
            if (isset($_POST['addbtn'])) 
            {
                $data = array(
                    'name' => trim('"' . $_POST['name'] . '"'),
                    'surname' => trim('"' . $_POST['surname'] . '"'),
                    'title_id' => trim($_POST['title_id'])
                );

                $this->objteacher->insertRecord('teacher', $data);

                $this->pageRedirect("/university-cs/teachers.php");

                exit();
            }
            else
            {
                $objtitle = new titleModel($this->objconfig);

                $result = $objtitle->selectRecord();
                
                $titletb = new title();

                $_SESSION['titletbl0'] = array();

                while($row = mysqli_fetch_array($result))
                {
                    $titletb->id = $row['id'];
                    $titletb->description = $row['description'];
                    $_SESSION['titletbl0'][] = serialize($titletb);
                }

                $this->pageRedirect('/university-cs/view/teacherinsert.php');

                exit();
            }
        }

        // Updates an existing teacher in the table's database
        protected function update()
        {
            if(isset($_POST['updatebtn']))
            {             
                $record_id = trim($_POST['id']);

                $data = array(
                    'name' => trim($_POST['name']),
                    'surname' => trim($_POST['surname']),
                    'title_id' => trim($_POST['title_id'])
                );

                $this->objteacher->updateRecord('teacher', $record_id, $data);

                $this->pageRedirect('/university-cs/teachers.php');

                exit();
            }
            elseif(($_GET["id"]) && !empty(trim($_GET["id"])))
            {
                $id = $_GET['id'];

                $result = $this->objteacher->selectRecord($id);
                $row = mysqli_fetch_array($result);

                $teachertb = new teacher();              
                $teachertb->id = $row["id"];
                $teachertb->name = $row["name"];
                $teachertb->surname = $row["surname"];
                $teachertb->title_id = $row["title_id"];

                $objtitle = new titleModel($this->objconfig);
                $result = $objtitle->selectRecord();
                $titletb = new title();
                $_SESSION['titletbl0'] = array();

                while($row = mysqli_fetch_array($result))
                {
                    $titletb->id = $row['id'];
                    $titletb->description = $row['description'];
                    $_SESSION['titletbl0'][] = serialize($titletb);
                }

                $_SESSION['teachertbl0'] = serialize($teachertb);

                $this->pageRedirect('/university-cs/view/teacherupdate.php');

                exit();
            }
            else
            {
                echo "Invalid operation.";
            }
        }

        // Deletes an existing teacher from the table's database
        protected function delete()
        {
            if (isset($_GET['id'])) 
            {
                $id = $_GET['id'];
                $res = $this->objteacher->deleteRecord("teacher", $id);               
                $this->pageRedirect('/university-cs/teachers.php');
            }
            else
            {
                echo "Invalid operation.";
            }
        }

        // Returns the Teacher list view
        protected function list()
        {
            $result = $this->objteacher->selectRecord(0);
            include "view/teacherlist.php";
        }
    }   
?>