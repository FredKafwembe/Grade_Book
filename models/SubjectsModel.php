<?php
class SubjectsModel extends Model {
    function __construct() {
      parent::__construct();
    }

    function insertSubject($name) {
        $stm = $this->db->prepare("INSERT INTO subject (name) VALUES (:name)") ;
        $stm->execute(array( ':name' => $name));
        echo "New record created successfully";
    }

    function updateSubject($subjectId, $name) {
        $sql = "UPDATE subject SET name = '$name' WHERE subject_id = $subjectId" ;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectSubject($subjectId) {
        $sql = "SELECT * FROM subject WHERE subject_id = $subjectId" ;
        return $this->db->query($sql);
    }

    function deleteSubject($subjectId) {
        $sql = "DELETE FROM subject WHERE subject_id = $subjectId" ;
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
?>
