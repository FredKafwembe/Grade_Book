<?php
class ResultsModel extends Model {
    function __construct() {
      parent::__construct();
    }

    function createMark($data) {
        $stm = $this->db->prepare("INSERT INTO marks (user_id_fk, subject_id_fk, percentage, test_time) VALUES 
            (:userId, :subjectId, :percentage, :testType)");
        $stm->execute(array(':userId' => $data["userId"], 
            ':percentage' => $data["percentage"], 
            ':subjectId' => $data["subjectId"],
            ":testType" => $data["testType"]));
        //echo "New record created successfully";
    }

    function userExistsInTable($userId, $tableName) {
        $stm = $this->db->prepare("SELECT * FROM $tableName WHERE user_id_fk = :userId");
        $stm->execute(array(":userId" => $userId));
        //$data = $stm->fetch();

        //echo $userId . " - table name: " . $tableName . "<br/>";

        $count = $stm->rowCount();
        if($count > 0) {
            return true;
        }

        return false;
    }

    
    function isTeacher($userId) {
        $ret = $this->userExistsInTable($userId, "grades_taught");
        //echo $ret ? "true" : "false" . "<br/>";
        //die;
        return $ret;
    }
    
    function isPupil($userId) {
        return $this->userExistsInTable($userId, "pupils");
    }
    
    function readGradesTaughtByTeacher($userId) {
        $stm = $this->db->prepare("SELECT grade_id, grade_name FROM grades WHERE grade_id = ANY
            (SELECT grade_id_fk FROM grades_taught WHERE user_id_fk = :userId)");
        $stm->execute(array(":userId" => $userId));
        $data = $stm->fetchAll();

        //echo "user id: $userId <br/>";
        //print_r($data);
        //die;

        return $data;
    }

    function readPupilsInGrades($gradesData) {
        $pupilsData = array();
        $stm = $this->db->prepare("SELECT user_id, first_name, last_name FROM users WHERE 
            user_id = ANY (SELECT user_id_fk FROM pupils WHERE grade_id_fk = :gradeId)");
        foreach($gradesData as $value) {
            $stm->execute(array(":gradeId" => $value["grade_id"]));
            $data = $stm->fetchAll();
            $pupilsData[$value["grade_id"]] = $data;
        }

        //print_r($pupilData);
        //die;

        return $pupilsData;
    }

    function readSubjectsInGrades($gradesData) {
        $subjectsData = array();
        $stm = $this->db->prepare("SELECT subject_id, name FROM subjects WHERE 
            subject_id = ANY (SELECT subject_id_fk FROM grade_subjects WHERE grade_id_fk = :gradeId)");
        foreach($gradesData as $value) {
            $stm->execute(array(":gradeId" => $value["grade_id"]));
            $data = $stm->fetchAll();
            $subjectsData[$value["grade_id"]] = $data;
        }

        //print_r($subjectsData);
        //die;

        return $subjectsData;
    }

    function readSubjectsTakenByPupil($userId) {
        $stm = $this->db->prepare("SELECT subject_id, name FROM subjects WHERE 
            subject_id = ANY (SELECT subject_id_fk FROM grade_subjects WHERE 
            grade_id_fk = ANY (SELECT grade_id_fk FROM pupils WHERE user_id_fk = :userId))");
        $stm->execute(array(":userId" => $userId));
        $data = $stm->fetchAll();
        //print_r($data);
        //die;
        return $data;
    }

    function readPupilsResults($pupilsInfo) {
        $pupilsResults = array();
        $stm = $this->db->prepare("SELECT subject_id_fk, percentage, test_time FROM marks WHERE 
            user_id_fk = :userId");
        foreach($pupilsInfo as $gradeInfo) {
            foreach($gradeInfo as $pupilInfo) {
                $stm->execute(array(":userId" => $pupilInfo["user_id"]));
                $data = $stm->fetchAll();
                $pupilsResults[$pupilInfo["user_id"]] = $data;
            }
        }

        return $pupilsResults;
    }

    function updateResults($resultsData) {
        $checkStm = $this->db->prepare("SELECT percentage FROM marks WHERE
            user_id_fk = :userId AND subject_id_fk = :subjectId AND test_time = :testType");
        $updateStm = $this->db->prepare("UPDATE marks SET percentage = :percentage WHERE
            user_id_fk = :userId AND subject_id_fk = :subjectId AND test_time = :testType");
        foreach($resultsData["results"] as $result) {
            $checkStm->execute(array(":userId" => $resultsData["userId"], 
                ":subjectId" => $result["subjectId"],
                ":testType" => $resultsData["testType"]));
            $count = $checkStm->rowCount();
            if($count > 0) {
                $updateStm->execute(array(":userId" => $resultsData["userId"], 
                    ":subjectId" => $result["subjectId"],
                    ":percentage" => $result["percentage"],
                    ":testType" => $resultsData["testType"]));
            } else {
                $this->createMark(array("userId" => $resultsData["userId"],
                    "subjectId" => $result["subjectId"],
                    "percentage" => $result["percentage"],
                    "testType" => $resultsData["testType"]));
            }
        }
    }
}
?>
