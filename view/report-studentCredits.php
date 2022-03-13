<?php
    session_unset();
    
    if($result->num_rows > 0)
    {
        echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo '<th colspan="3">Students total credits</th>';
                echo "</tr>";
                echo "<tr>";
                    echo "<th>Name</th>";                                        
                    echo "<th>Surname</th>";
                    echo "<th>Earned ECTS</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result))
            {
                    echo "<tr>";                                     
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['surname'] . "</td>";
                        echo "<td>" . $row['earned_ects'] . "</td>";
                    echo "</tr>";
            }
            echo "</tbody>";                            
        echo "</table>";
        
        mysqli_free_result($result);
    }
    else
    {
        echo "<table class='table table-bordered table-striped'><tr><td>" .
        "<p class='lead'>No records were found.</p>" .
        "</td></tr></table>";
    }
?>