<?php
    session_start();
    require_once("../library/view/header.php");
    require("../model/subject.php");   
    $subjecttb = isset($_SESSION['subjecttbl0'])?unserialize($_SESSION['subjecttbl0']):new subject();
?>

<div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Subject</h2>
                    </div>
                    <p>Please fill this form and submit to update an existing subject record in the database.</p>
                    <form action="../subjects.php?act=update" method="post">
                        <div class="form-group <?php echo (!empty($subjecttb->description_msg)) ? 'has-error' : ''; ?>">
                            <label>Description</label>
                            <input name="description" class="form-control" value="<?php echo $subjecttb->description; ?>" required>
                            <span class="help-block"><?php echo $subjecttb->description_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($subjecttb->ects_msg)) ? 'has-error' : ''; ?>">
                            <label>ECTS</label>
                            <input type="number" name="ects" class="form-control" value="<?php echo $subjecttb->ects; ?>" required>
                            <span class="help-block"><?php echo $subjecttb->ects_msg;?></span>
                        </div>
                        <br>
                        <input type="hidden" name="id" value="<?php echo $subjecttb->id; ?>"/>
                        <input type="submit" name="updatebtn" class="btn btn-primary" value="Submit">
                        <a href="../subjects.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

<?php
    require_once("../library/view/footer.php");
?>