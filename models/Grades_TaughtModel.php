<?php
include_once 'DatabaseConnector.php';

class Grades_TaughtModel {
    private $db;

    function __construct() {
        try {
            $database = new DatabaseConnector();
            $this->db = $database->openConnection();
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }


    function insertGrades_Taught($teacher_id_fk) {
        $stm = $this->db->prepare("INSERT INTO grades_taught (teacher_id_fk) VALUES (:teacher_id_fk)") ;
        $stm->execute(array( ':teacher_id_fk' => $teacher_id_fk));
        echo "New record created successfully";
    }

   

     function updateAdmin($grade_id_fk, $teacher_id_fk) {
        $sql = "UPDATE gradee_taught SET teacher_id_fk = '$teacher_id_fk' WHERE grade_id_fk= $grade_id_fk" ;
//        echo $sql;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectGrades_Taught($grade_id_fk) {
        $sql = "SELECT * FROM grades_taught WHERE grade_id_fk = $grade_id_fk" ;
        return $this->db->query($sql);
    }

    function deleteGrades_Taught($grade_id_fk) {
        $sql = "DELETE FROM grades_taught WHERE `grade_id_fk` = $grade_id_fk" ;
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
?>