<?php	
    /*
        Automatic script for database creation for MVC project "university-cs"
        Mirko Gesev
        2022
    */

    $serverName = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $databaseName = "university_cs";
    
    # Database creation
    $connection = new mysqli($serverName, $usernameDB, $passwordDB);
    
    # Connection Check
    if($connection->connect_error)
    {
        die("Connection Failed: " . $connection->connect_error);
    }
    
    # Database selection
    $sql = "USE university_cs;";
    if(!$connection->query($sql))
    {
        echo "Selection error on database.";
    }
?>