<?php
/**************Grade book code*****************

include_once 'DatabaseConnector.php';

class UserModel {
    private $db;

    function __construct() {
        try {
            $database = new DatabaseConnector();
            $this->db = $database->openConnection();
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }


    function insertUser($password, $role, $email) {
        $stm = $this->db->prepare("INSERT INTO user (password, email, role) VALUES (:password, :email, :role)") ;
        $stm->execute(array( ':password' => $password , ':email' => $email , ':role' => $role));
        echo "New record created successfully";
    }

    function updateUser($userId, $password, $role, $email) {
        $sql = "UPDATE user SET password = '$password', role = $role, email = '$email' WHERE user_id = $userId" ;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectUser($userId) {
        $sql = "SELECT * FROM user WHERE user_id = $userId" ;
        $userEntry = $this->db->query($sql);
        return $userEntry->fetch();
    }

    function deleteUser($userId) {
        $sql = "DELETE FROM user WHERE user_id = $userId";
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
*/

include_once "RolesModel.php";

class UserModel extends Model {
    function __construct() {
        parent::__construct();
    }
    
    function readUser($id, $includeRoleName = false) {
        $statment = $this->db->prepare(
            "SELECT user_id, role_id_fk, password, email,
            first_name, last_name, contact_number FROM users
            WHERE user_id = :id");
        $statment->execute(array(":id" => $id));
        $userData = $statment->fetch();

        if($includeRoleName) {
            $roleModel = new RolesModel();
            $roleData = $roleModel->readRole($userData["role_id_fk"]);
            $userData["role_name"] = str_replace("_", " ", $roleData["name"]);
        }

        return $userData;
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

    function readAllUsersWithRoleId($roleId) {
        $statment = $this->db->prepare(
            "SELECT user_id, role_id_fk, password, email,
            first_name, last_name, contact_number FROM users WHERE role_id_fk=:roleId");
        $statment->execute(array(":roleId" => $roleId));
        $userData = $statment->fetchAll();
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
