<?php
    session_start();
    require_once("../library/view/header.php");
    require("../model/student.php");             
    $studenttb = isset($_SESSION['studenttbl0'])?unserialize($_SESSION['studenttbl0']):new student();
?>

<div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Student</h2>
                    </div>
                    <p>Please fill this form and submit to update an existing student record in the database.</p>
                    <form action="../students.php?act=update" method="post">
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
                        <br>
                        <input type="hidden" name="id" value="<?php echo $studenttb->id; ?>"/>
                        <input type="submit" name="updatebtn" class="btn btn-primary" value="Submit">
                        <a href="../students.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

<?php
    require_once("../library/view/footer.php");
?>