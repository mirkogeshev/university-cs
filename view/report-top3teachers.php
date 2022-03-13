<?php
    session_unset();
    
    if($result->num_rows > 0)
    {
        echo "<table class='table table-bordered table-striped'>";
            echo "<thead>";
                echo "<tr>";
                    echo '<th colspan="3">Top 3 teachers with most students</th>';
                echo "</tr>";
                echo "<tr>";
                    echo "<th>Subject name</th>";                                        
                    echo "<th>Total students enrolled</th>";
                echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result))
            {
                    echo "<tr>";
                        echo "<td>" . $row['name'] . " " . $row['surname'] . "</td>";
                        echo "<td>" . $row['total_students'] . "</td>";
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