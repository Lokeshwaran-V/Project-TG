
<?php
include 'connection_establishment.php';
// global $DEPARTMENT;
$DEPARTMENT = $_POST['timetable_department'];
$YEAR = $_POST['timetable_year'];


class Timetable {
    private $subjects;

    public function __construct() {
        $this->subjects = array();

        // Fetch data from database
        $this->fetchSubjects($GLOBALS['DEPARTMENT'], $GLOBALS['YEAR']);
    }

    private function fetchSubjects($Department,$YEAR) {
        $sql = "SELECT FACULTY_NAME, DEPARTMENT, YEAR, SUBJECT_CODE, SUBJECT_NAME FROM SUBJECT_RECORDS WHERE DEPARTMENT='$Department' AND YEAR='$YEAR'";
        $result = $GLOBALS['conn']->query($sql);
        while($row = $result->fetch_assoc()) {
            $this->subjects[] = array("Faculty name" => $row["FACULTY_NAME"], "DEPARTMENT" => $row["DEPARTMENT"], "YEAR" => $row["YEAR"],"code" => $row["SUBJECT_CODE"], "name" => $row["SUBJECT_NAME"]);
            
        }
    }


    public function generateTimetable() {
        // Genetic algorithm implementation
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

        for ($generation = 0; $generation < $generations; $generation++) {
            $newPopulation = array();
            for ($i = 0; $i < $populationSize; $i++) {
                $parent1 = $this->tournamentSelection($population);
                $parent2 = $this->tournamentSelection($population);
                $offspring = $this->crossover($parent1, $parent2);
                $offspring = $this->mutate($offspring, $mutationRate);
                $newPopulation[] = $offspring;
            }
            $population = $newPopulation;
        }

        $bestIndividual = $this->tournamentSelection($population);
        return $this->applyConstraints($bestIndividual);
    }
    private function applyConstraints($individual) {
        // Check hard constraints
        $isValid = $this->checkHardConstraints($individual);
        if (!$isValid) {
            return $individual;
        }
    
        // Add subject and faculty keys to each array element
        $updatedIndividual = [];
        foreach ($individual as $day => $hours) {
            foreach ($hours as $hour => $subject) {
                $updatedSubject = [
                    'subject' => $subject,
                    //'faculty' => $this-> $subject,
                ];
                $updatedIndividual[$day][$hour] = $updatedSubject;
            }
        }
    
        return $updatedIndividual;
    }

    private function checkHardConstraints($individual) {
        // Check if there are no conflicts
        $conflicts = $this->checkForConflicts($individual);

        if (count($conflicts) > 0) {
            return false;
        }

        return true;
    }

    private function checkForConflicts($individual) {
        $conflicts = array();

        // Check if there are any faculty conflicts
        $facultyConflicts = $this->checkFacultyConflicts($individual);
        if (count($facultyConflicts) > 0) {
            $conflicts = array_merge($conflicts, $facultyConflicts);
        }

        // Check if there are any class group conflicts
        $classGroupConflicts = $this->checkClassGroupConflicts($individual);
        if (count($classGroupConflicts) > 0) {
            $conflicts = array_merge($conflicts, $classGroupConflicts);
        }

        return $conflicts;
    }

    private function checkFacultyConflicts($individual) {
        $conflicts = array();

        // Check if there are any faculty conflicts
        for ($i = 0; $i < count($individual); $i++) {
            for ($j = $i + 1; $j < count($individual); $j++) {
                if ($individual[$i]['faculty'] == $individual[$j]['faculty']) {
                    $conflicts[] = array(
                        'class1' => $individual[$i]['subject']['code'],
                        // 'class2' => $individual[$j]['subject']['code'],
                        // 'faculty' => $individual[$i]['faculty']['name']
                    );
                }
            }
        }

        return $conflicts;
    }
    
    private function checkClassGroupConflicts($individual) {
        $conflicts = array();

        // Check if there are any class group conflicts
        $classGroups = array();
        for ($i = 0; $i < count($individual); $i++) {
            $classGroup = $individual[$i]['subject']['code'][0];
            if (!isset($classGroups[$classGroup])) {
                $classGroups[$classGroup] = array();
            }
            $classGroups[$classGroup][] = $i;
        }

        foreach ($classGroups as $classGroup) {
            if (count($classGroup) > 1) {
                $conflicts[] = array(
                    'class_group' => $classGroup,
                    'classes' => array_map(function ($index) use ($individual) {
                        return $individual[$index]['subject']['code'];
                    }, $classGroup)
                );
            }
        }

        return $conflicts;
    }

    private function tournamentSelection($population) {
        $tournamentSize = 5;
        $tournamentPopulation = array();
        for ($i = 0; $i < $tournamentSize; $i++) {
            $randomIndex = rand(0, count($population) - 1);
            $tournamentPopulation[] = $population[$randomIndex];
        }
        $fittest = $tournamentPopulation[0];
        $fitness = $this->fitness($tournamentPopulation[0]);
        for ($i = 1; $i < $tournamentSize; $i++) {
            $individualFitness = $this->fitness($tournamentPopulation[$i]);
            if ($individualFitness > $fitness) {
                $fittest = $tournamentPopulation[$i];
                $fitness = $individualFitness;
            }
        }
        return $fittest;
    }
    

    private function crossover($parent1, $parent2) {
        $crossoverPoint = rand(1, count($this->subjects) - 2);
        $offspring = array();
        for ($i = 0; $i < $crossoverPoint; $i++) {
            $offspring[] = $parent1[$i];    
        }
        for ($i = $crossoverPoint; $i < count($parent2); $i++) {
            $offspring[] = $parent2[$i];
        }
        return $offspring;
    }

    private function mutate($individual, $mutationRate) {
        for ($i = 0; $i < count($individual); $i++) {
            if (rand(0, 1) < $mutationRate) {
                $individual[$i]["faculty"] = $this->subjects[rand(0, count($this->subjects) - 1)];
            }
        }
        return $individual;
    }

    private function fitness($individual) {
        // Implement your own fitness function here
        $fitness = 0;
        // For example, the fitness could be the number of classes that are taught by a single faculty
        foreach ($individual as $class) {
            $fitness++;
        }
        return $fitness;
    }
}
$timetable = new Timetable();
$generatedTimetable = $timetable->generateTimetable();

// // Display the timetable in a user-friendly interface
// $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
// $hours = array('8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM');

// echo '<table border="1" cellpadding="5" cellspacing="0">';
// echo '<tr><th>Day</th><th>Hour</th><th>Subject</th><th>Faculty</th></tr>';

// foreach ($generatedTimetable as $day => $hourSubjects) {
//     foreach ($hourSubjects as $hour => $subject) {
//         echo '<tr>';
//         echo '<td>'. $days[$day]. '</td>';
//         echo '<td>'. $hours[$hour]. '</td>';
//         echo '<td>'. $subject['name']. '</td>';
//         echo '<td>'. $subject['Faculty name']. '</td>';
//         echo '</tr>';
//     }
// }

// echo '</table>';

// Display the timetable in a user-friendly interface
// $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
// $hours = array('8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM');

// echo '<table border="1" cellpadding="5" cellspacing="0">';
// echo '<tr><th>Day</th><th>Hour</th><th>Subject</th><th>Faculty</th></tr>';

// // Check if $generatedTimetable is not empty
// if (!empty($generatedTimetable)) {
//     foreach ($generatedTimetable as $day => $hourSubjects) {
//         // Check if $hourSubjects is not empty
//         if (!empty($hourSubjects)) {
//             foreach ($hourSubjects as $hour => $subject) {
//                 // Check if $subject is not empty and has required keys
//                 if (!empty($subject) && array_key_exists('name', $subject) && array_key_exists('Faculty name', $subject)) {
//                     echo '<tr>';
//                     echo '<td>'. $days[$day]. '</td>';
//                     echo '<td>'. $hours[$hour]. '</td>';
//                     echo '<td>'. $subject['name']. '</td>';
//                     echo '<td>'. $subject['Faculty name']. '</td>';
//                     echo '</tr>';
//                 }
//             }
//         }
//     }
// }

// echo '</table>';


// Display the timetable in a user-friendly interface
$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
$hours = array('8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM');

echo '<table border="1" cellpadding="5" cellspacing="0">';
echo '<tr><th>Day</th><th>Hour</th><th>Subject</th><th>Faculty</th></tr>';

// Check if $generatedTimetable is not empty
if (!empty($generatedTimetable)) {
    foreach ($generatedTimetable as $day => $hourSubjects) {
        // Check if $hourSubjects is not empty
        if (!empty($hourSubjects)) {
            foreach ($hourSubjects as $hour => $subject) {
                // Check if $subject is not empty and has required keys
                if (!empty($subject) && array_key_exists('name', $subject) && array_key_exists('Faculty name', $subject)) {
                    echo '<tr>';
                    echo '<td>'. (isset($days[$day]) ? $days[$day] : ''). '</td>';
                    echo '<td>'. (isset($hours[$hour]) ? $hours[$hour] : ''). '</td>';
                    echo '<td>'. (isset($subject['name']) ? $subject['name'] : ''). '</td>';
                    echo '<td>'. (isset($subject['Faculty name']) ? $subject['Faculty name'] : ''). '</td>';
                    echo '</tr>';
                }
            }
        }
    }
}

echo '</table>';


// echo "<pre>";
// print_r($generatedTimetable);
// echo "</pre>";

?>