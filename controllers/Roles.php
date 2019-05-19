<?php
class Roles extends Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->view->permissionList = $this->model->readAllPermissions();
    $this->view->roleList = $this->model->readAllRolesWithPermissions();
    $this->view->render("roles/index");
  }

  function create() {
    $data = array();
    $data["roleName"] = $_POST["roleName"];

    foreach(USER_PERMISSIONS as $permission) {
      if(isset($_POST[$permission])) {
        //echo "Can edit $permission<br/>";
        $data["rolePermissions"][$permission] = $_POST[$permission];
      }
    }

    $this->model->create($data);
    header("location: " . URL . "roles");
  }
}
?>
