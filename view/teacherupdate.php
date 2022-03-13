<?php
    session_start();
    require_once("../library/view/header.php");
    require("../model/teacher.php");
    require("../model/title.php");             
    $teachertb = isset($_SESSION['teachertbl0'])?unserialize($_SESSION['teachertbl0']):new teacher();
?>

<div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Teacher</h2>
                    </div>
                    <p>Please fill this form and submit to update an existing teacher record in the database.</p>
                    <form action="../teachers.php?act=update" method="post">
                        <div class="form-group <?php echo (!empty($teachertb->name_msg)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input name="name" class="form-control" value="<?php echo $teachertb->name; ?>" required>
                            <span class="help-block"><?php echo $teachertb->name_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($teachertb->surname_msg)) ? 'has-error' : ''; ?>">
                            <label>Surname</label>
                            <input name="surname" class="form-control" value="<?php echo $teachertb->surname; ?>" required>
                            <span class="help-block"><?php echo $teachertb->surname_msg;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($titletb->id_msg)) ? 'has-error' : ''; ?>">
                            <label>Title</label>
                            <select name="title_id" class="form-control">
                            <?php
                                foreach($_SESSION['titletbl0'] as $row)
                                {
                                    $titletb = unserialize($row);
                                    if($titletb->id == $teachertb->title_id)
                                    {
                                        echo '<option selected="selected" value="' . $titletb->id . '">' . $titletb->description . '</option>';
                                    }
                                    else
                                    {
                                        echo '<option value="' . $titletb->id . '">' . $titletb->description . '</option>';
                                    }
                                }
                            ?>
                            </select>
                            <span class="help-block"><?php echo $titletb->id_msg;?></span>
                        </div>
                        <br>
                        <input type="hidden" name="id" value="<?php echo $teachertb->id; ?>"/>
                        <input type="submit" name="updatebtn" class="btn btn-primary" value="Submit">
                        <a href="../teachers.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>

<?php
    require_once("../library/view/footer.php");
?>