<?php
class ResultsModel extends Model {
    function __construct() {
      parent::__construct();
    }

    function insertMarks($pupil_id_fk, $percentage) {
        $stm = $this->db->prepare("INSERT INTO marks (pupil_id_fk, percentage) VALUES (:pupil_id_fk, :percentage)") ;
        $stm->execute(array( ':pupil_id_fk' => $pupil_id_fk , ':percentage' => $percentage));
        echo "New record created successfully";
    }

    function updateMarks($subject_id_fk, $pupil_id_fk, $percentage) {
        $sql = "UPDATE marks SET pupil_id_fk = '$pupil_id_fk', percentage = $percentage' WHERE usubject_id_fk = $subject_id_fk" ;
//        echo $sql;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectMarks($subject_id_fk) {
        $sql = "SELECT * FROM marks WHERE subject_id_fk = $subject_id_fk" ;
        $userEntry = $this->db->query($sql);
        return $userEntry->fetch();
    }

    function deleteMarks($subject_id_fk) {
        $sql = "DELETE FROM marks WHERE subject_id_fk = $subject_id_fk";
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
?>
