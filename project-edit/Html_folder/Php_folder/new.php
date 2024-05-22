<?php

include 'connection_establishment.php';
// global $DEPARTMENT;
// $DEPARTMENT = $_POST['timetable_department'];
// $YEAR = $_POST['timetable_year'];
class Chromosome {
    public $genes = [];
    public $fitness;
  
    // public function __construct($genes) {
    //   $this->genes = $genes;
    //   $this->fitness = 0;
    //   $this->fetchSubjects($GLOBALS['DEPARTMENT'], $GLOBALS['YEAR']);
    // }
    
    function fetchSubjects($Department,$YEAR) {
        $sql = "SELECT * FROM SUBJECT_RECORDS WHERE DEPARTMENT='$Department' AND YEAR='$YEAR'";
        $result = $GLOBALS['conn']->query($sql);
        while($row = $result->fetch_assoc()) {
            $this->genes[] = array(
                $row["FACULTY_NAME"], 
                $row["DEPARTMENT"],
                $row["YEAR"],
                $row["SUBJECT_CODE"], 
                $row["SUBJECT_NAME"],
                $row["SUBJECT_TYPE"]);
        }
        return $this->genes;
    }

    function setFitness(){
        foreach($this->genes as $gn){
            if($gn[5] == 'THEORY'){
                $this->fitness = 1;
            }
            elseif($gn[5] == 'LAB'){
                $this->fitness = 3;
            }
            else{
                $this->fitness = 0;
            }
        }
        print($this->fitness);
        return $gn;
    }
    function calculateFitness() {
        // Here you would implement the logic to calculate the fitness based on the genes
        
        // For demonstration purposes, let's assume a simple fitness calculation
        // Fitness could be calculated as the sum of all gene values
        
        $sum = array_sum($this->genes);
        
        // Assign the calculated fitness value to the fitness property
        $this->fitness = $sum;
        print($this->fitness);
        print_r($sum);
        return $this->fitness ;
        
        // You can modify this logic according to your specific fitness calculation requirements
    }
}

$population_size = sizeof($genes);
$mutation_rate = 0.1;
$generation = 100;



$myobj = new Chromosome();
$fetsub = $myobj->fetchSubjects('CSE', '3');
$calfit = $myobj->setFitness();

    
    
//   }
  
  class GeneticAlgorithm {
    public $population = [];
    public $population_size;
    public $mutation_rate;
    public $generation = 100;

  
    function __construct($population_size, $mutation_rate) {
        $this->population_size = $population_size;
        $this->mutation_rate = $mutation_rate;
    }
  
    function initializePopulation() {
      for ($i = 0; $i < $this->population_size; $i++) {
        $chromosome = new Chromosome(rand(0, 1)); // random gene
        array_push($this->population, $chromosome);
      }
    }
  
//     function selectParents() {
//         // select parents based on fitness
//     }

//     function crossover($parents) {
//     // combine genes from parents to create new offspring
//     }

//     function mutate(&$offspring) {
//     // randomly change genes in offspring
//     }

//     function evolve() {
//       // selection
//       $parents = $this->selectParents();
  
//       // crossover
//       $offspring = $this->crossover($parents);
  
//       // mutation
//       $this->mutate($offspring);
  
//       // replace least fit individuals with new offspring
//       $this->replaceLeastFit($offspring);
//     }
  
//     function replaceLeastFit($offspring) {
//       // replace least fit individuals in population with new offspring
//     }
//   }
  
//   $ga = new GeneticAlgorithm(100, 0.01);
//   $ga->initializePopulation();
//   for ($i = 0; $i < 1000; $i++) {
//     $ga->evolve();
//   }

  }
$days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
$hours = array('8:00 AM', '9:00 AM', '10:00 AM', '11:00 AM', '12:00 PM', '1:00 PM', '2:00 PM', '3:00 PM');

?>