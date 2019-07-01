<?php
include_once "RolePermissionsModel.php";
include_once "PermissionsModel.php";

class LoginModel extends Model {
  function __construct() {
    parent::__construct();
    //echo "Login in model.";
  }

  public function run($loginInfo) {
    $statement = $this->db->prepare(
      "SELECT role_id_fk, password, email, first_name, last_name, contact_number 
      FROM users WHERE user_id = :userId AND password = MD5(:password)");
    $statement->execute(array(":userId" => $loginInfo['userId'], ":password" => $loginInfo['password']));

    $data = $statement->fetch();
    //print_r($data);

    $count = $statement->rowCount();

    $rolePermissionsModel = new RolePermissionsModel();
    $rolePermissionsData = $rolePermissionsModel->readAllPermissionIdsWithRole($data["role_id_fk"]);
    $permissionsModel = new PermissionsModel();
    $rolePermissions = array();
    foreach($rolePermissionsData as $value) {
      $permissionData = $permissionsModel->readPermission($value["permission_id_fk"]);
      $rolePermissions[$permissionData["name"]] = 1;
    }
    //print_r($rolePermissions);

    if($count > 0) {
      //Login
      Session::init();
      Session::set("loggedIn", true);
      Session::set("permissions", $rolePermissions);
      header("location: " . URL . "dashboard");
    } else {
      //Error
      header("location: " . URL . "login");
    }
  }
}
?>
