<?php
    /*
        Automatic script for database creation for MVC project "university-cs"
        Mirko Gesev
        2022
    */

    require_once("Connection.php");
    
    # Drops the database
    $sql = "USE university_cs";
    if($connection->query($sql) === TRUE)
    {
        echo "Selection " . " executed <br />";
    }
    else
    {
        echo "Failed drop. " . $connection->error . "<br />";
    }
    
    $sql = "DROP DATABASE university_cs";
    if($connection->query($sql) === TRUE)
    {
        echo "Drop completed. <br />";
    }
    else
    {
        echo "Failed drop. " . $connection->error . "<br />";
    }

    $sql = "CREATE DATABASE IF NOT EXISTS university_cs";
    if($connection->query($sql) === TRUE)
    {
        echo "Created empty database, to re-use it again click the Re-install link below.<br />";
    }
    else
    {
        echo "Database creation failed!<br />";
    }

    $connection->close();
?>
<p><br /><br />
<a href="../index.php">GO BACK</a>
</p>
<p><br /><br />
<a href="install_db.php">RE-INSTALL THE DATABASE</a>
</p>