<?php
    session_start();
    require_once("../library/view/header.php");
    require("../model/student.php");
    require("../model/course.php");          
    $studenttb = isset($_SESSION['studenttbl0'])?unserialize($_SESSION['studenttbl0']):new student();
?>

<div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add New Student</h2>
                    </div>
                    <p>Please fill this form and submit to add new student record in the database.</p>
                    <form action="../students.php?act=add" method="post">
                        <div class="form-group <?php echo (!empty($studenttb->name_msg)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input name="name" class="form-control" value="<?php echo $studenttb->name; ?>" required>
                            <span class="help-block"><?php echo $studenttb->name_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($studenttb->surname_msg)) ? 'has-error' : ''; ?>">
                            <label>Surname</label>
                            <input name="surname" class="form-control" value="<?php echo $studenttb->surname; ?>" required>
                            <span class="help-block"><?php echo $studenttb->surname_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($coursetb->id_msg)) ? 'has-error' : ''; ?>">
                            <label>Course</label>
                            <select name="course_id" class="form-control">
                            <?php
                                if(isset($_SESSION['coursetbl0']))
                                {
                                    foreach($_SESSION['coursetbl0'] as $row)
                                    {
                                        $coursetb = unserialize($row);
                                        echo '<option value="' . $coursetb->id . '">' . $coursetb->description . '</option>';
                                    }
                                }
                            ?>
                            </select>
                            <span class="help-block"><?php echo $coursetb->id_msg;?></span>
                        </div>
                        <br>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        <a href="../students.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

<?php
    require_once("../library/view/footer.php");
?>