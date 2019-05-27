<?php
class Roles extends Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->view->roleList = $this->model->readAllRolesWithPermissions();
    $this->view->render("roles/index");
  }

  function add() {
    $this->view->permissionList = $this->model->readAllPermissions();
    $this->view->render("roles/add");
  }

  function edit($roleId) {
    //$this->view->roleData = $this->model->readRole($roleId);
    $this->view->roleId = $roleId;
    $this->view->rolePermissions = $this->model->readRoleWithPermissions($roleId);
    $this->view->permissionList = $this->model->readAllPermissions();
    $this->view->render("roles/edit");
  }

  function updateRole($roleId) {
    $data = array();
    $data["roleId"] = $roleId;
    $data["roleName"] = $_POST["roleName"];

    foreach(USER_PERMISSIONS as $permission) {
      if(isset($_POST[$permission])) {
        $data["rolePermissions"][$permission] = $_POST[$permission];
      }
    }

    $this->model->updateRole($data);
    header("location: " . URL . "roles");
  }

  function delete($roleId) {
    $deleteData = $this->model->delete($roleId);
    $deleteData["role"] = str_replace("_", " ", $deleteData["role"]);
    header("location: " . URL . "roles?" . http_build_query($deleteData));
  }

  function create() {
    //TODO make sure no duplicate role names
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
