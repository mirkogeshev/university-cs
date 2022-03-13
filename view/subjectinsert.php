<?php
    session_start();
    require_once("../library/view/header.php");
    require("../model/subject.php");
    require '../model/teacher.php';             
    $subjecttb = isset($_SESSION['subjecttbl0'])?unserialize($_SESSION['subjecttbl0']):new subject();
?>

<div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add New Subject</h2>
                    </div>
                    <p>Please fill this form and submit to add new subject record in the database.</p>
                    <form action="../subjects.php?act=add" method="post">
                        <div class="form-group <?php echo (!empty($subjecttb->description_msg)) ? 'has-error' : ''; ?>">
                            <label>Description</label>
                            <input name="description" class="form-control" value="<?php echo $subjecttb->description; ?>" required>
                            <span class="help-block"><?php echo $subjecttb->description_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($subjecttb->ects_msg)) ? 'has-error' : ''; ?>">
                            <label>ECTS</label>
                            <input name="ects" class="form-control" value="<?php echo $subjecttb->ects; ?>" required>
                            <span class="help-block"><?php echo $subjecttb->ects_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($teachertb->id_msg)) ? 'has-error' : ''; ?>">
                            <label>Assigned teacher</label>
                            <select name="teacher_id" class="form-control">
                            <?php
                                if(isset($_SESSION['teachertbl0']))
                                {
                                    foreach($_SESSION['teachertbl0'] as $row)
                                    {
                                        $teachertb = unserialize($row);
                                        echo '<option value="' . $teachertb->id . '">' . $teachertb->name . ' ' . $teachertb->surname . '</option>';
                                    }
                                }
                            ?>
                            </select>
                            <span class="help-block"><?php echo $teachertb->id_msg;?></span>
                        </div>
                        <br>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        <a href="../subjects.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

<?php
    require_once("../library/view/footer.php");
?>