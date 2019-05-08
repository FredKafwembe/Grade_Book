<?php
include_once 'DatabaseConnector.php';

class Grades_SubjectModel {
    private $db;

    function __construct() {
        try {
            $database = new DatabaseConnector();
            $this->db = $database->openConnection();
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }


    function insertGrades_Subject($subject_id_fk) {
        $stm = $this->db->prepare("INSERT INTO grade_subject (subject_id_fk) VALUES (:subject_id_fk)") ;
        $stm->execute(array( ':subject_id_fk' => $subject_id_fk));
        echo "New record created successfully";
    }

   

     function updateGrades_Subject($grade_id_fk, $subject_id_fk
) {
        $sql = "UPDATE grade_subject SET subject_id_fk = '$subject_id_fk' WHERE grade_id_fk= $grade_id_fk" ;
//        echo $sql;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectGrades_Subject($grade_id_fk) {
        $sql = "SELECT * FROM grade_subject WHERE grade_id_fk = $grade_id_fk" ;
        return $this->db->query($sql);
    }

    function deleteGrades_Subject($grade_id_fk) {
        $sql = "DELETE FROM grade_subject WHERE `grade_id_fk` = $grade_id_fk" ;
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
?>