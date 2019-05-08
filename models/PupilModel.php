<?php
include_once 'DatabaseConnector.php';

class PupilModel {
    private $db;

    function __construct() {
        try {
            $database = new DatabaseConnector();
            $this->db = $database->openConnection();
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }


    function insertPupil($grade_id_fk, $user_id_fk, $pupil_name) {
        $stm = $this->db->prepare("INSERT INTO pupil (   grade_id_fk, pupil_name, user_id_fk) VALUES (:grade_id_fk, :pupil_name, :user_id_fk)") ;
        $stm->execute(array( ':grade_id_fk' => $grade_id_fk , ':pupil_name' => $pupil_name , ':user_id_fk' => $user_id_fk));
        echo "New record created successfully";
    }

    function updatePupil($pupil_id, $grade_id_fk, $user_id_fk, $pupil_name) {
        $sql = "UPDATE pupil SET grade_id_fk = '$grade_id_fk', user_id_fk = $user_id_fk, pupil_name = '$pupil_name' WHERE pupil_id = $pupil_id" ;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectPupil($pupil_id) {
        $sql = "SELECT * FROM pupil WHERE pupil_id = $pupil_id" ;
        $userEntry = $this->db->query($sql);
        return $userEntry->fetch();
    }

    function deletePupil($pupil_id) {
        $sql = "DELETE FROM pupil WHERE pupil_id = $pupil_id";
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
?>