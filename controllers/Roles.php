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

  function edit($id) {
    $this->view->render("roles/edit");
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
