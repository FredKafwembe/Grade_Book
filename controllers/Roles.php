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
}
?>
