<?php require_once("library/view/header.php"); ?>
        <main role="main" class="container">
            <div class="row">
                <h1 class="mt-5">Welcome to the Computer Science Faculty backoffice!</h1>
            </div>
            <div class="row">
                <p class="lead">Start your work from the above navigation bar.</p>
            </div>
            <br>
            <div class="row">
                <p class="lead">Before using this application, please create a database 'university_cs' in your MariaDB Server and only after that click here: <a href="database/install_db.php">Install Now</a>
            </div>
            <div class="row">
                <p class="lead">If you need to start over with a new database, please drop the current one here: <a href="database/drop_db.php">Drop Now</a>
            </div>
        </main>
        <?php require_once("library/view/footer.php"); ?>
    </body>
</html>