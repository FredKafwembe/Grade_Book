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
        $stm = $this->db->prepare("INSERT INTO admin (user_id_fk, first_name, last_name) VALUES (:user_id_fk, :first_name, :last_name)") ;
        $stm->execute(array( ':user_id_fk' => $user_id_fk , ':first_name' => $first_name , ':last_name' => $last_name));
        echo "New record created successfully";
    }

    
    function updateAdmin($admin_id, $user_id_fk, $first_name, $last_name) {
        $sql = "UPDATE admin SET user_id_fk = '$user_id_fk', first_name = $first_name, last_name = '$last_name' WHERE admin_id= $admin_id" ;
//        echo $sql;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }

    function selectAdmin($admin_id) {
        $sql = "SELECT * FROM admin WHERE admin_id = $admin_id" ;
        return $this->db->query($sql);
    }

    function deleteAdmin($admin_id) {
        $sql = "DELETE FROM admin WHERE `admin_id` = $admin_id" ;
        $affectedrows  = $this->db->exec($sql);
        if(isset($affectedrows)) {
            echo "Record has been successfully deleted";
        }
    }
}
?>