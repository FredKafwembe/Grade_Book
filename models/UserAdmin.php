<?php
include_once 'DatabaseConnector.php';

class AdminModel {
    private $db;

    function __construct() {
        try {
            $database = new DatabaseConnector();
            $this->db = $database->openConnection();
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }


    function insertAdmin($user_id_fk, $first_name, $last_name) {
        $stm = $this->db->prepare("INSERT INTO admin (password, email, role) VALUES (:password, :email, :role)") ;
        $stm->execute(array( ':password' => $password , ':email' => $email , ':role' => $role));
        echo "New record created successfully";
    }

    function updateAdmin($userId, $password, $role, $email) {
        $sql = "UPDATE 'user' SET 'password'= $password , 'role' = $role , 'email' = $email WHERE 'user_id' = $userId" ;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectAdmin($userId) {
        $sql = "SELECT * FROM user WHERE user_id = $userId" ;
        return $this->db->query($sql);
    }

    function deleteAdmin($userId) {
        $sql = "DELETE FROM user WHERE `user_id` = $userId" ;
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
?>