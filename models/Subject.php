<?php
include_once 'DatabaseConnector.php';

class SubjectModel {
    private $db;

    function __construct() {
        try {
            $database = new DatabaseConnector();
            $this->db = $database->openConnection();
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }


    function insertSubject($name) {
        $stm = $this->db->prepare("INSERT INTO subject ( name) VALUES (:name)") ;
        $stm->execute(array( ':name' => $name));
        echo "New record created successfully";
    }

   

     function updateSubject($subject_id, $name
) {
        $sql = "UPDATE subject SET name= '$namename' WHERE subject_id= $subject_id" ;
//        echo $sql;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectSubject($subject_id) {
        $sql = "SELECT * FROM subject WHERE subject_id = $subject_id" ;
        return $this->db->query($sql);
    }

    function deleteSubject($subject_id) {
        $sql = "DELETE FROM subject WHERE `subject_id` = $subject_id" ;
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
?>