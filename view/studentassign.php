<?php
    require_once("../library/view/header.php");
    require("../model/student.php");
    require("../model/subject.php");
    session_start();
    $studenttb = isset($_SESSION['studenttbl0'])?unserialize($_SESSION['studenttbl0']):new student();
?>

<div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Assign <?php echo $studenttb->name; ?> <?php echo $studenttb->surname; ?> to a Subject</h2>
                    </div>
                    <p>Please fill this form and submit to assign the above student to a subject of this faculty.</p>
                    <form action="../students.php?act=assign" method="post">
                        <div class="form-group <?php echo (!empty($subjecttb->id_msg)) ? 'has-error' : ''; ?>">
                            <label>Subject</label>
                            <select name="subject_id" class="form-control">
                            <?php
                                if(isset($_SESSION['subjecttbl0']))
                                {
                                    foreach($_SESSION['subjecttbl0'] as $row)
                                    {
                                        $subjecttb = unserialize($row);
                                        echo '<option value="' . $subjecttb->id . '">' . $subjecttb->description . '</option>';
                                    }
                                }
                            ?>
                            </select>
                            <span class="help-block"><?php echo $subjecttb->id_msg;?></span>
                        </div>
                        <br>
                        <input type="hidden" name="student_id" value="<?php echo $studenttb->id; ?>"/>
                        <input type="submit" name="assignbtn" class="btn btn-primary" value="Submit">
                        <a href="../students.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

<?php
    require_once("../library/view/footer.php");
?>