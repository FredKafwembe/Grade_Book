<?php




   class GradesModel extends Model {
    function __construct() {
        parent::__construct();
    }


    /*function readGrades($id) {
        $statment = $this->db->prepare(
            "SELECT user_id, role_id_fk, password, email,
            first_name, last_name, contact_number FROM users
            WHERE user_id = :id");
      $statment->execute(array(":id" => $id));
      return $statment->fetch();
    }*/

    function readAllGrades($includeRoleName = false) {
        $statment = $this->db->prepare(
            "SELECT grade_id,   grade_name FROM grades");
        $statment->execute();
        $userData = $statment->fetchAll();
        
        return $userData;
    }

    /*function readAllGrades() {
        $gradeModel = new GradeModel();
        return $gradeModel->readAllRoles();
    }*/


    function create($data) {
        print_r($data);
        
        $statment = $this->db->prepare("INSERT INTO grades (grade_name) VALUES (':grade_name'
            )");
        $statment->execute(array(
            ":grade_name" => $data["grade_name"]));
        echo "string";
    die;
    }


    /*function updateUser($data) {
        $statment = $this->db->prepare("UPDATE users SET role_id_fk = :roleId,
            first_name = :firstName, last_name = :lastName, password = :password,
            email = :email, contact_number = :contactNumber WHERE user_id = :userId");
        $statment->execute(array(":roleId" => $data["roleId"], ":firstName" => $data["firstName"],
        ":lastName" => $data["lastName"], ":password" => $data["password"],
        ":email" => $data["email"], ":contactNumber" => $data["contactNumber"],
        ":userId" => $data["userId"]));

        //print_r($data);
        //die;
    }*/

     function deleteUser($id) {
      $statment = $this->db->prepare("DELETE FROM grades WHERE grade_id = :grade_id");
      $statment->execute(array(":grade_id" => $id));
    }

    function deleteModel($id) {
      $statment = $this->db->prepare("DELETE FROM grades WHERE grade_id = :grade_id");
      $statment->execute(array(":grade_id" => $id));
    }
}

?>