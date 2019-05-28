<?php


include_once "RolesModel.php";

class UserModel extends Model {
    function __construct() {
        parent::__construct();
    }
    
    function readUser($id) {
        $statment = $this->db->prepare(
            "SELECT user_id, role_id_fk, password, email,
            first_name, last_name, contact_number FROM users
            WHERE user_id = :id");
      $statment->execute(array(":id" => $id));
      return $statment->fetch();
    }

    function readAllUsers($includeRoleName = false) {
        $statment = $this->db->prepare(
            "SELECT user_id, role_id_fk, password, email,
            first_name, last_name, contact_number FROM users");
        $statment->execute();
        $userData = $statment->fetchAll();
        if($includeRoleName) {
            $roleModel = new RolesModel();
            foreach($userData as &$user) {
                $roleData = $roleModel->readRole($user["role_id_fk"]);
                $user["role_name"] = str_replace("_", " ", $roleData["name"]);
            }
        }
        return $userData;
    }

    function readAllRoles() {
        $rolesModel = new RolesModel();
        return $rolesModel->readAllRoles();
    }


    function create($data) {
        $statment = $this->db->prepare("INSERT INTO users(role_id_fk, first_name, last_name,
            password, email, contact_number) VALUES (:roleId, :firstName, :lastName,
            :password, :email, :contactNumber)");
        $statment->execute(array(":roleId" => $data["roleId"],
            ":firstName" => $data["firstName"], ":lastName" => $data["lastName"],
            ":password" => $data["password"], ":email" => $data["email"],
            ":contactNumber" => $data["contactNumber"]));
    }

    function updateUser($data) {
        $statment = $this->db->prepare("UPDATE users SET role_id_fk = :roleId,
            first_name = :firstName, last_name = :lastName, password = :password,
            email = :email, contact_number = :contactNumber WHERE user_id = :userId");
        $statment->execute(array(":roleId" => $data["roleId"], ":firstName" => $data["firstName"],
        ":lastName" => $data["lastName"], ":password" => $data["password"],
        ":email" => $data["email"], ":contactNumber" => $data["contactNumber"],
        ":userId" => $data["userId"]));

        //print_r($data);
        //die;
    }

    function deleteUser($id) {
      $statment = $this->db->prepare("DELETE FROM users WHERE user_id = :userId");
      $statment->execute(array(":userId" => $id));
    }
}
?>
