<?php
class Dashboard extends Controller {
  function __construct() {
    parent::__construct();
    Session::init();
    $logged = Session::get("loggedIn");
    if(!$logged) {
      Session::destroy();
      header("location: login");
      exit;
    }

    //$this->view->js = array("dashboard/js/default.js");
  }

  function index() {
    $this->view->render("dashboard/index");
  }

  function logout() {
    Session::destroy();
    header("location: " . URL . "login");
    exit;
  }
}
?>
