<?php
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
//        echo $sql;
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
?>