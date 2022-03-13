<?php
    session_unset();
    require_once("library/view/header.php");

    echo '<div class="container-fluid"><div class="row">';
    echo '<div class="col-md"><h2 class="pull-left">Students Management</h2></div>';
    echo '<div class="col-md text-center"><p>In this view you can manage the students of the faculty<br>Create, edit or delete them or assign and unassign them to a specific subject</p></div>';
    echo '<div class="col-md"><a href="students.php?act=add" class="btn btn-success pull-right">Add New Student</a></div>';
    echo '</div></div>';
    
    if($result->num_rows > 0){
        echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo "<th>#</th>";                                        
                    echo "<th>Name</th>";
                    echo "<th>Surname</th>";
                    echo "<th>Course</th>";
                    echo "<th>Action</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";                                        
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['surname'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>";
                    echo "<a href='students.php?act=assign&id=". $row['id'] ."' title='Assign Subject' data-toggle='tooltip'><i class='fa fa-plus'></i></a> ";
                    echo "<a href='students.php?act=unassign&id=". $row['id'] ."' title='Unassign Subject' data-toggle='tooltip'><i class='fa fa-minus'></i></a> ";
                    echo "<a href='students.php?act=update&id=". $row['id'] ."' title='Update Record' data-toggle='tooltip'><i class='fa fa-edit'></i></a> ";
                    echo "<a href='students.php?act=delete&id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><i class='fa fa-trash'></i></a>";
                    echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";                            
        echo "</table>";
        
        mysqli_free_result($result);
    } else{
        echo "<table class='table table-bordered table-striped'><tr><td>" .
        "<p class='lead'>No records were found.</p>" .
        "</td></tr></table>";
    }

    require_once("library/view/footer.php");
?>