<?php
include_once "RolePermissionsModel.php";

class LoginModel extends Model {
  function __construct() {
    parent::__construct();
    //echo "Login in model.";
  }

  public function run() {
    $statement = $this->db->prepare(
      "SELECT role_id_fk, password, email, first_name, last_name, contact_number 
      FROM users WHERE user_id = :userId AND password = MD5(:password)");
    $statement->execute(array(":userId" => $_POST['userId'], ":password" => $_POST['password']));

    $data = $statement->fetch();
    //print_r($data);

    $count = $statement->rowCount();

    $rolePermissionsModel = new RolePermissionsModel();
    $rolePermissionsData = $rolePermissionsModel->readAllPermissionIdsWithRole($data["role_id_fk"]);
    print_r($rolePermissionsDAta);

    if($count > 0) {
      //Login
      Session::init();
      Session::set("loggedIn", true);
      Session::set("role", $roleName);
      header("location: " . URL . "dashboard");
    } else {
      //Error
      header("location: ../login");
    }
  }
}
?>
