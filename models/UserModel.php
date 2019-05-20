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

    function listSingleUser($id) {
      $statment = $this->db->prepare("SELECT id, login, role FROM users WHERE id = :id");
      $statment->execute(array(":id" => $id));
      return $statment->fetch();
    }

    function create($data) {
      $statment = $this->db->prepare("INSERT INTO users(login, password,
        role) VALUES (:login, :password, :role)");
      $statment->execute(array(":login" => $data["login"],
        ":password" => $data["password"], ":role" => $data["role"]));
    }

    function editSave($data) {
      $statment = $this->db->prepare("UPDATE users SET login = :login, password = :password, role = :role WHERE id = :id");
      $statment->execute(array(":id" => $data["id"], ":login" => $data["login"],
        ":password" => $data["password"], ":role" => $data["role"]));
    }

    function delete($id) {
      $statment = $this->db->prepare("DELETE FROM users WHERE id = :id");
      $statment->execute(array(":id" => $id));
    }
}
?>
