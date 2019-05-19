<?php
class Permissions extends Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->view->permissionList = $this->model->readAllPermissions();
    $this->view->render("permissions/index");
  }
}
?>
