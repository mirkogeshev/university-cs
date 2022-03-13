<!doctype html>
<html>
    <head>
        <title>University - Computer Science Faculty</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="/university-cs/library/css/bootstrap.css" rel="stylesheet">
        <link href="/university-cs/library/css/bootstrap_dropdown.css" rel="stylesheet">
        <link href="/university-cs/library/css/sticky-footer-navbar.css" rel="stylesheet">
        <link href="/university-cs/library/fontawesome/css/font-awesome.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">University - Computer Science Faculty</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/university-cs/">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/university-cs/students.php">Students</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/university-cs/teachers.php">Teachers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/university-cs/subjects.php">Subjects</a>
                            </li>
                            <li class="nav-item dropdown-submenu">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Reports
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="/university-cs/reports.php">Teachers and Students</a>
                                    <a class="dropdown-item" href="/university-cs/reports.php?act=studentSubjects">Students enrolled subjects</a>
                                    <a class="dropdown-item" href="/university-cs/reports.php?act=studentCredits">Students total credits</a>
                                    <a class="dropdown-item" href="/university-cs/reports.php?act=teacherSubjects">Teachers assigned subjects</a>
                                    <a class="dropdown-item" href="/university-cs/reports.php?act=top3subjects">Top 3 subjects with most students</a>
                                    <a class="dropdown-item" href="/university-cs/reports.php?act=top3teachers">Top 3 teachers with most students</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>