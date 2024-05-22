<?php
    include 'connection_establishment.php';
    // $DEPARTMENT = $_POST['timetable_department'];
    // $YEAR = $_POST['timetable_year'];

    class newt{
        public $individual;
        public $genevalues;
        public $individualfitness;
        public $fitness;
        public $hours;
        public $population;
        public $integer_value;
        public $num; 

        public function __construct() {
            $this->individual  = array();
            $this->genevalues = array();
            $this->individualfitness = array();
            $this->fitness = array();
            $this->hours = array();
            $this->population = array();
            $this->integer_value = array();
            // $this->num;
        }

        // Fetch data from database
        public function fetchSubjects($DEPARTMENT, $YEAR) {
            $sql = "SELECT * FROM SUBJECT_RECORDS WHERE DEPARTMENT=? AND YEAR=?";
            $stmt = $GLOBALS['conn']->prepare($sql);
            $stmt->bind_param("si", $DEPARTMENT, $YEAR);
            $stmt->execute();
            $result = $stmt->get_result();
            while ($row = $result->fetch_assoc()) {
                $this->individual[] = array(
                    $row["FACULTY_NAME"],
                    $row["DEPARTMENT"],
                    $row["YEAR"],
                    $row["SUBJECT_CODE"],
                    $row["SUBJECT_NAME"],
                    $row["SUBJECT_TYPE"]
                );
            }
            return $this->individual;
        }

        // Assign Individual values ( 1 or 3 ) based on the subject type
        function setgenevalue(){
            foreach($this->individual as $in){
                if($in[5] == 'THEORY'){
                    $this->genevalues[] = 1;
                }
                elseif($in[5]  == 'LAB'){
                    $this->genevalues[] = 3;
                }
                else{
                    break;
                }
            }
            return $this->genevalues;
        }

        // Assign Subject value to each subject as per the subject code 
        function setsubjectcodevalue(){
            
            $alphabet = range('A', 'Z');
            $values = range(1, 26);
        
            $alphabet_values = array_combine($alphabet, $values);
        
            // Convert subject code letters to their corresponding values
            // $numeric_value = '';
            foreach($this->individual as $in){
                foreach (str_split($in[3]) as $letter) {
                    $uppercase_letter = strtoupper($letter);
                    if (isset($alphabet_values[$uppercase_letter])) {
                        $numeric_value = $alphabet_values[$uppercase_letter];
                    } else {
                        // If the letter is not found in the alphabet_values array, you may choose to handle this case.
                        // Here, I'm simply appending the original character.
                        $numeric_value = $letter;
                    }
                    $this->num .= $numeric_value;
                }
                $this->integer_value[] = $this->num;
                $this->num = '';
            }
            return $this->integer_value;
        }
            
        function genefitness(){
            $sumgenevalue = array_sum($this->genevalues);
            foreach($this->genevalues as $gv){
                $fit = ($gv/$sumgenevalue);
                $this->individualfitness[] = $fit;
            }
            return $sumgenevalue;
        }
        function calculatefitness(){
            for($i = 0; $i < sizeof($this->individualfitness); $i++){
                $fit = $this->individualfitness[$i] + $this->integer_value[$i];
                // print($fit);
                $this->fitness[] = $fit;
            }
            // print_r($this->fitness);
            return $this->fitness;
        }
        function sethours(){
            $this->hours = range(1,40);
            // print_r($this->hours);
            return $this->hours;
        }
        
        function crossover($parent1,$parent2) {
            // Choose a random crossover point
            $crossover_point1 = range(1, sizeof($this->individual));
            shuffle($crossover_point1);
            // print_r($crossover_point1);
            $crossover_point2 = range(1,40);
            shuffle($crossover_point2);
            // print_r($crossover_point2);
            $offset = 0;
            foreach ($crossover_point1 as $p1) {
                $offspring1 = $parent1[$p1 - 1];
                $offsprings1[] = $offspring1;             
                for ($j = 0; $j < (sizeof($this->hours) / sizeof($this->individual)); $j++) {
                    // print($offset);
                    $offspring2 = $parent2[$crossover_point2[$offset] - 1];
                    $offsprings2[] = array($offspring2, $offspring1); 
                    // sort($offsprings2[0]);
                    // $sortedoffspring = sort($offsprings2);
                    // print_r($offsprings2);
                    
                    
                    // echo 'offspring1: ';
                    // print_r($offspring1);
                    // echo '<br>';
                    // echo 'offspring2: ';
                    // print_r($offspring2);
                    // echo '<br>';
                    // echo '<br>';

                    // $offsets = array(
                    //     $offspring1,
                    //     $offspring2
                    // );
                    
                           
                    // Increment the offset for the next iteration
                    $offset += 1;
                    
                }
            
                
            }
            $b = 0;
            $c = 1;
            for($a = 0; $a<count($offsprings2);$a++){
                print_r($offsprings2[$a][$b]);
                echo '<br>';
                print_r($offsprings2[$a][$c]);
                echo '<br>';

            }
            
            // print_r($offsprings1[1]);
            // echo '<br>';
            // print_r($offsprings2);
            // echo '<table border="1" cellpadding="5" cellspacing="0">';
            //         foreach ($offsets as $index) {
            //             // print_r($offsets);   
            //             // print_r($pairs);
            //             // Start a new row every 8 offspring
            //             if ($index % 8 == 0) {
            //                 echo '<tr>';
            //             }
            //             // print_r($pairs);

            //             foreach ($offsets as $data) {
            //                 echo '<td>' . $data . '</td>';
            //             }
            //             // End the row after printing 8 offspring
            //             if ($index % 8 == 7 || $index == count($offsets) - 1) {
            //                 echo '</tr>';
            //             }
            //         }
            // echo '</table>';

            // Create offspring by combining the genetic material of the parents         
            return $offspring2;
        }
        function generateRandomNumbers($min, $max) {
            $numbers = range($min, $max); // Create an array with numbers from $min to $max
            // shuffle($numbers); // Shuffle the array randomly
            // print_r($numbers);

            // Pick the numbers one by one and remove them from the array
            while (!empty($numbers)) {
                $number = array_shift($numbers);
                echo $number . " ";
                echo '  hi  ';
            }
            // print_r($number);
            return $number;
        }
        
    }
    // $hirs = $this->hours;
    $myobj = new newt();
    $fetchSubjects = $myobj->fetchSubjects('CSE','3');
    $setgenevalue = $myobj->setgenevalue();
    $setsubjectcodevalue = $myobj->setsubjectcodevalue();
    $genefitness = $myobj->genefitness();
    $calculatefitness = $myobj->calculatefitness();
    $sethours = $myobj->sethours();
    $crossover = $myobj->crossover($myobj->fitness,$myobj->hours);
    // $randomNumbers = $myobj->generateRandomNumbers(1, 40);
        
    



// class Newtt {
//     private $subjects;
//     private $department;
//     private $year;

//     public function __construct($department, $year) {
//         $this->department = $department;
//         $this->year = $year;
//         $this->subjects = array();

//         // Fetch data from database
//         $this->fetchSubjects();
//     }

//     private function fetchSubjects() {
//         $sql = "SELECT FACULTY_NAME, DEPARTMENT, YEAR, SUBJECT_CODE, SUBJECT_NAME FROM SUBJECT_RECORDS WHERE DEPARTMENT=? AND YEAR=?";
//         $stmt = $GLOBALS['conn']->prepare($sql);
//         $stmt->bind_param("si", $this->department, $this->year);
//         $stmt->execute();
//         $result = $stmt->get_result();
//         while ($row = $result->fetch_assoc()) {
//             $this->subjects[] = array(
//                 "Faculty name" => $row["FACULTY_NAME"],
//                 "DEPARTMENT" => $row["DEPARTMENT"],
//                 "YEAR" => $row["YEAR"],
//                 "code" => $row["SUBJECT_CODE"],
//                 "name" => $row["SUBJECT_NAME"]
//             );
//         }
//     }

//     //... rest of the code...

//     public function generateTimetable() {
//         // Genetic algorithm implementation
//         $populationSize = 100;
//         $generations = 500;
//         $mutationRate = 0.10;

//         $population = array();
//         for ($i = 0; $i < $populationSize; $i++) {
//             $individual = array();
//             for ($day = 0; $day < 5; $day++) { // Loop through 5 days
//                 $daySchedule = array();
//                 for ($hour = 0; $hour < 8; $hour++) { // Loop through 8 hours
//                     $daySchedule[] = $this->subjects[rand(0, count($this->subjects) - 1)];
//                 }
//                 $individual[] = $daySchedule;
//             }
//             $population[] = $individual;
//         }

//         //... rest of the code...
//     }

//     //... rest of the code...
// }


// $timetable = new Newtt($department,$year);
// $generatedTimetable = $timetable->generateTimetable();

// // Display the timetable in a user-friendly interface
// $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
// $hours = array('8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM');

// echo '<table border="1" cellpadding="5" cellspacing="0">';
// echo '<tr><th>Day</th><th>Hour</th><th>Subject</th><th>Faculty</th></tr>';

// if (!empty($generatedTimetable)) {
//     foreach ($generatedTimetable as $day => $hourSubjects) {
//         if (!empty($hourSubjects)) {
//             foreach ($hourSubjects as $hour => $subject) {
//                 if (!empty($subject) && array_key_exists('name', $subject) && array_key_exists('Faculty name', $subject)) {
//                     echo '<tr>';
//                     echo '<td>'. (isset($days[$day])? $days[$day] : ''). '</td>';
//                     echo '<td>'. (isset($hours[$hour])? $hours[$hour] : ''). '</td>';
//                     echo '<td>'. (isset($subject['name'])? $subject['name'] : ''). '</td>';
//                     echo '<td>'. (isset($subject['Faculty name'])? $subject['Faculty name'] : ''). '</td>';
//                     echo '</tr>';
//                 }
//             }
//         }
//     }
// }

// echo '</table>';

?>