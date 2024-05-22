<?php

    include 'connection_establishment.php';

    class Summa{
        public function fetchSubjects($Department, $YEAR) {
            $sql = "SELECT * FROM SUBJECT_RECORDS WHERE DEPARTMENT='$Department' AND YEAR='$YEAR'";
            $result = $GLOBALS['conn']->query($sql);
            $subjectsArray = []; // Initialize an empty array to store subjects
            while ($row = $result->fetch_assoc()) {
                // Construct an associative array for each subject
                $subject = array(
                    $row["FACULTY_NAME"],
                    $row["DEPARTMENT"],
                    $row["YEAR"],
                    $row["SUBJECT_CODE"],
                    $row["SUBJECT_NAME"],
                    $row["SUBJECT_TYPE"]
                );
                // Append the subject array to the subjectsArray
                $subjectsArray[] = $subject;
                
            }
            for($i = 0;$i < sizeof($subjectsArray);$i++){
                print_r($subjectsArray[$i]);
            }
            return $subjectsArray; // Return the array of subjects
            // print_r($subjectsArray);
        }
    }
    $myobj = new summa();
    $pr = $myobj->fetchSubjects('CSE', '3');
    // print_r($subjectsArray);

    // if (!empty($pr)) {
    //     // Print the output
    //     $farray = array();
    //     $individual = array();
    //     foreach ($pr as $subject) {

    //         $farray[] = "[" . $subject["Faculty name"] . "," . $subject["DEPARTMENT"] . "," 
    //         . $subject["YEAR"] . "," . $subject["code"] . "," . $subject["name"] . "]";

    //         // echo "[" . $subject["Faculty name"] . "," . $subject["DEPARTMENT"] . "," 
    //         // . $subject["YEAR"] . "," . $subject["code"] . "," . $subject["name"] . "]";
    //     }
    // } else {
    //     echo "No subjects found for the given department and year.";
    // }
    // for ($day = 0; $day < 5; $day++) { // Loop through 5 days
    //     $daySchedule = array();
    //     for ($hour = 0; $hour < 8; $hour++) { // Loop through 8 hours
    //         $daySchedule[] = $farray[rand(0, count($farray) - 1)];
            
    //     }
    //     $individual[] = $daySchedule;
        

    // }
    // print_r($individual);
    

?>