<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="Styles/admin-styles.css">
    <link rel="stylesheet" href="Styles/timetable-style.css">
    <script>
        
        // Fetch the role of the user using Session ID.
        var userRole = "<?php 
                        session_start();
                        echo $_SESSION['FACULTY_ROLE']; ?>";

        // Function to disable or enable links based on user role
        function disableLinks() {
            var links = document.querySelectorAll('a[id$="-page-link"]'); // Select all links with IDs ending in "-page-link"
            links.forEach(function(link) {
                var linkId = link.getAttribute('id');
                if (userRole !== 'ADMIN' && (linkId === 'admin-page-link' || linkId === 'rooms-page-link')) {
                    link.setAttribute('disabled', 'disabled'); // Disable the link
                    link.style.pointerEvents = 'none'; // Make the link non-clickable
                    link.style.color = 'gray'; // Change the color to indicate it's disabled
                }
            });
        }
        // Call the function to disable links based on user role after the page has loaded
        window.addEventListener('load', disableLinks);
    </script>
</head>
<body>
    <div class="container">
        <div class="nav">
            <ul>
                <li><b><a href="#" id="admin-page-link">ADMIN</a></b></li>
                <li><b><a href="#" id="faculty-page-link">TIME TABLE</a></b></li>
                <li><b><a href="#" id="faculty-timetable-link">FACULTY TIME TABLE</a></b></li>
                <li><b><a href="#" id="subjects-page-link">SUBJECTS</a></b></li>
                <li><b><a href="#" id="rooms-page-link">ROOMS</a></b></li>
            </ul>
            <div>
                <button id="logout" onclick=handleLogout()>Logout</button>
            </div>
        </div>

        <!-- Admin Dashboard Page 1 -->
        <div class="admin-dashboard-content" id="admin-dashboard-content">
            <h1>WELCOME TO THE ADMIN DASHBOARD</h1>
            <div class="admin-faculty-subject">
                <div class="admin-faculty">
                    <h2>FACULTY</h2><br><br>
                    <a href="Html_folder\Insert_faculty.php" class="admin-button-link">
                        <button>Insert Faculty</button>
                    </a>
                    <a href="Html_folder\Update_faculty.php" class="admin-button-link">
                        <button>Update Faculty</button>
                    </a>
                    <a href="Html_folder\Delete_faculty.php" class="admin-button-link">
                        <button>Delete Faculty</button>
                    </a>
                </div>

                <div class="admin-subject">
                    <h2>SUBJECT</h2><br><br>
                    <a href="Html_folder\Insert_subject.php" class="admin-button-link">
                        <button>Insert Subject</button>
                    </a>
                    <a href="Html_folder\Update_subject.php" class="admin-button-link">
                        <button>Update Subject</button>
                    </a>
                    <a href="Html_folder\Delete_subject.php" class="admin-button-link">
                        <button>Delete Subject</button>
                    </a>
                </div>
            </div>
            <form action="Html_folder\Php_folder\timetable_generation.php">
                <div class="admin-timetable">
                    <button>GENERATE TIMETABLE</button>
                    <button>VIEW TIMETABLE</button>
                </div>
            </form>
        </div>

        <!-- Time table Dashboard -->
        <div class="admin-dashboard-content" id="timetable-dashboard-content" style="display: none;">
            <h1>VIEW TIME TABLE</h1>
            <form action="Html_folder\Php_folder\timetable_generation.php" method="POST">
                <div class="timetable-dropdown-container">
                    <div>
                        <label for="timetable-dropdown-department">DEPARTMENT</label>
                        <select id="timetable-dropdown-department" class="timetable-dropdown-department" name="timetable_department">
                            <?php include 'Html_folder\Php_folder\fetch-department.php'; ?>
                        </select>
                    </div>
                    <div>
                        <label for="timetable-dropdown-year">YEAR</label>
                        <select id="timetable-dropdown-year"  class="timetable-dropdown-year" name="timetable_year">
                            <?php include 'Html_folder\Php_folder\fetch-year.php'; ?>
                        </select>
                    </div>
                    <div>
                        <button id="timetable-view-timetable-btn">View Timetable</button>
                    </div>
                </div>
                
            </form>
        </div>

        <!-- Faculty Time Table Dashboard -->
        <div class="admin-dashboard-content" id="faculty-timetable-dashboard-content" style="display: none;">
            <h1>VIEW FACULTY TIME TABLE</h1>
            <!-- Add dropdown buttons for Faculty, Year, and Department -->
            <form action="#" method="POST">
                <div class="faculty-timetable-dropdown-container">
                    <div>
                        <label for="faculty-timetable-dropdown-faculty">FACULTY ID</label>
                        <select id="faculty-timetable-dropdown-faculty" name="faculty-timetable-faculty">
                            <?php include 'Html_folder\Php_folder\fetch-faculty-id.php'; ?>
                        </select>
                    </div>

                    <div>
                        <label for="faculty-timetable-dropdown-department">DEPARTMENT</label>
                        <select id="faculty-timetable-dropdown-department" name="faculty-timetable-department">
                            <?php include 'Html_folder\Php_folder\fetch-department.php'; ?>
                        </select>
                    </div>

                    <div>
                        <label for="faculty-timetable-dropdown-year">YEAR</label>
                        <select id="faculty-timetable-dropdown-year" name="faculty-timetable-year">
                            <?php include 'Html_folder\Php_folder\fetch-year.php'; ?>
                        </select>
                    </div>
                </div>
                
            </form>
            <button id="faculty-view-timetable-btn">View Timetable</button>
        </div>

        <!-- SUBJECTS dashboard section -->
        <div class="admin-dashboard-content" id="subjects-dashboard-content" style="display: none;">
            <h1>WELCOME TO THE SUBJECTS DASHBOARD</h1>
            <form action="view-subjects.php" method="POST">
                <div class="subjects-dropdown-container">
                    <div>
                        <label for="subjects-dropdown-department">DEPARTMENT</label>
                        <select id="subjects-dropdown-department" name="subjects_department">
                            <?php include 'Html_folder\Php_folder\fetch-department.php'; ?>
                        </select>
                    </div>
                    <div>
                        <label for="subjects-dropdown-year">YEAR</label>
                        <select id="subjects-dropdown-year" name="subjects_year">
                            <?php include 'Html_folder\Php_folder\fetch-year.php'; ?>
                        </select>
                    </div>
                    <div>
                        <button id="view-subjects-btn">View Subjects</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- ROOMS dashboard section -->
        <div class="admin-dashboard-content" id="rooms-dashboard-content" style="display: none;">
            <h1>WELCOME TO THE ROOMS DASHBOARD</h1>
            <form action="Html_folder\Php_folder\rooms.php" method="post">
                <div class="room-input-container">
                    <div>
                        <label for="room-input-number">Room No </label>
                        <input type="text" id="room-input-number" name="ROOM_NO" class="input-text">
                    </div>

                    <div>
                        <label for="room-input-name">Room Name </label>
                        <input type="text" id="room-input-name" name="ROOM_NAME" class="input-text">
                    </div>
                    <div>
                        <label for="room-dropdown-department">Department </label>
                        <select id="room-dropdown-department" name="ROOM_DEPARTMENT" class="select-text">
                            <?php include 'Html_folder\Php_folder\fetch-department.php'; ?>
                        </select>
                    </div>
                </div>
                <div>
                    <button id="add-room-btn">Add Room</button>
                </div>
                
                
            </form>
        </div>

    </div>
    <script>
        function handleLogout(){
            window.localStorage.clear();
            window.location.reload(true);
            window.location.replace('index.php');
        };
    </script>
    <script src="Scripts/admin-dashboard.js"></script>
    
    
</body>
</html>
