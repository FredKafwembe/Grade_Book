<?php
include_once 'DatabaseConnector.php';

class GradeModel {
    private $db;

    function __construct() {
        try {
            $database = new DatabaseConnector();
            $this->db = $database->openConnection();
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }


    function insertGrade($grade_name) {
        $stm = $this->db->prepare("INSERT INTO admin (grade_name) VALUES (:grade_name)") ;
        $stm->execute(array( ':grade_name' => $grade_name));
        echo "New record created successfully";
    }

    function updateGrade($grade_id, $grade_name) {
        $sql = "UPDATE 'grade' SET 'grade_name'= $grade_name WHERE 'grade_id' = $grade_id" ;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectGrade($grade_id) {
        $sql = "SELECT * FROM grade WHERE grade_id = $grade_id" ;
        return $this->db->query($sql);
    }

    function deleteGrade($grade_id) {
        $sql = "DELETE FROM grade WHERE `grade_id` = $grade_id" ;
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
?>