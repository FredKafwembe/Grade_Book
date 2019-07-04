<?php
class Permissions extends Controller {
  function __construct() {
    parent::__construct();

    Session::init();
    $logged = Session::get("loggedIn");
    if(!$logged) {
      Session::destroy();
      header("location: login");
      exit;
    }
  }

  function index() {
    $this->view->permissionList = $this->model->readAllPermissions();
    $this->view->render("permissions/index");
  }
}
?>
