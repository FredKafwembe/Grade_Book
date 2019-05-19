<?php
include_once 'DatabaseConnector.php';

class SubjectsTaughtModel {
    private $db;

    function __construct() {
        try {
            $database = new DatabaseConnector();
            $this->db = $database->openConnection();
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    function insertSubjectTaught($teacherId, $subjectId) {
        $stm = $this->db->prepare("INSERT INTO subjects_taught (teacher_id_fk, subject_id_fk) VALUES (:teacher_id, :subject_id)");
        $stm->execute(array(':teacher_id' => $teacherId, ':subject_id' => $subjectId));
        echo "New record created successfully";
    }

    function updateSubjectTaught($teacherId , $subjectId) {
        $sql = "UPDATE subjects_taught SET teacher_id_fk = $teacherId, subject_id_fk = '$subjectId' WHERE teacher_id = $teacherId AND subject_id = $subjectId";
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectSubjectsTaughtByTeacher($teacherId) {
        $sql = "SELECT * FROM subject_taught WHERE teacher_id_fk = $teacherId" ;
        $userEntry = $this->db->query($sql);
        $rows;
        while($row = $userEntry->fetch()) {
            array_push($rows, $row);
        }
        return $rows;
    }

    function selectTeachersTeachingSubject($subjectId) {
        $sql = "SELECT * FROM subject_taught WHERE subject_id_fk = $subjectId" ;
        $userEntry = $this->db->query($sql);
        $rows;
        while($row = $userEntry->fetch()) {
            array_push($rows, $row);
        }
        return $rows;
    }

    function deleteTeacher($teacherId, $subjectId) {
        $sql = "DELETE FROM subjects_taught WHERE teacher_id = $teacherId AND subject_id = $subjectId";
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
?>