<?php
include_once 'DatabaseConnector.php';

class TeacherModel {
    private $db;

    function __construct() {
        try {
            $database = new DatabaseConnector();
            $this->db = $database->openConnection();
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }


    function insertTeacher($userId, $firstName, $lastName, $phoneNumber) {
        $stm = $this->db->prepare("INSERT INTO teacher (user_id_fk, first_name, last_name, phone_number) VALUES (:user_id, :first_name, :last_name, :phone_number)") ;
        $stm->execute(array(':user_id' => $userId, ':first_name' => $firstName , ':last_name' => $lastName, ':phone_number' => $phoneNumber));
        echo "New record created successfully";
    }

    function updateTeacher($teacherId ,$userId, $firstName, $lastName, $phoneNumber) {
        $sql = "UPDATE teacher SET user_id_fk = $userId, first_name = '$firstName', last_name = '$lastName', phone_number = $phoneNumber WHERE teacher_id = $teacherId" ;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectTeacher($teacherId) {
        $sql = "SELECT * FROM teacher WHERE teacher_id = $teacherId" ;
        $userEntry = $this->db->query($sql);
        return $userEntry->fetch();
    }

    function deleteTeacher($teacherId) {
        $sql = "DELETE FROM teacher WHERE teacher_id = $teacherId";
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
?>