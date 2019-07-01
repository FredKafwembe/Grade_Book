<?php
class Login extends Controller {
  function __construct() {
    parent::__construct();
    //echo "We are in index!";
  }

  function index() {
    //require "models/LoginModel.php";
    //$model = new LoginModel();

    $this->view->render("login/index");
  }

  function run() {
    $loginInfo = array();
    $loginInfo["userId"] = $_POST['userId'];
    $loginInfo["password"] = $_POST['password'];

    $this->model->run($loginInfo);
  }
}
?>
