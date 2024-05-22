<?php
include 'connection_establishment.php';

$DEPARTMENT = $_POST['timetable_department'];
$YEAR = $_POST['timetable_year'];

class Timetable {
    private $subjects;

    public function __construct() {
        $this->subjects = array();
        $this->fetchSubjects($GLOBALS['DEPARTMENT'], $GLOBALS['YEAR']);
    }

    private function fetchSubjects($Department, $YEAR) {
        $sql = "SELECT FACULTY_NAME, DEPARTMENT, YEAR, SUBJECT_CODE, SUBJECT_NAME FROM SUBJECT_RECORDS WHERE DEPARTMENT='$Department' AND YEAR='$YEAR'";
        $result = $GLOBALS['conn']->query($sql);
        while ($row = $result->fetch_assoc()) {
            $this->subjects[] = array("Faculty name" => $row["FACULTY_NAME"], "code" => $row["SUBJECT_CODE"], "name" => $row["SUBJECT_NAME"]);
        }
    }

    public function generateTimetable() {
        $populationSize = 100;
        $generations = 500;
        $mutationRate = 0.10;

        $population = array();
        for ($i = 0; $i < $populationSize; $i++) {
            $individual = array();
            for ($day = 0; $day < 5; $day++) { // Loop through 5 days
                $daySchedule = array();
                for ($hour = 0; $hour < 8; $hour++) { // Loop through 8 hours
                    $daySchedule[] = $this->subjects[rand(0, count($this->subjects) - 1)];
                }
                $individual[] = $daySchedule;
            }
            $population[] = $individual;
        }
        return $population;
        // Remaining genetic algorithm implementation...
    }

    // Remaining class methods...
}

$timetable = new Timetable();
$generatedTimetable = $timetable->generateTimetable();

$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
$hours = array('8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM');

echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><th>Day</th><th>Hour</th><th>Subject</th><th>Faculty</th></tr>';

foreach ($generatedTimetable as $day => $daySchedule) {
    foreach ($daySchedule as $hour => $subject) {
        echo '<tr>';
        echo '<td>' . $days[$day] . '</td>';
        echo '<td>' . $hours[$hour] . '</td>';
        echo '<td>' . $subject['name'] . '</td>';
        echo '<td>' . $subject['Faculty name'] . '</td>';
        echo '</tr>';
    }
}

echo '</table>';
?>
