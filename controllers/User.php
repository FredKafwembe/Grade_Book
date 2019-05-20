<?php
class User extends Controller {
    function __construct() {
        parent::__construct();
        Session::init();
        $logged = Session::get("loggedIn");
        $permissions = Session::get("permissions");

        if(!$logged || !isset($permissions["View_Users"])) {
            Session::destroy();
            header("location: login");
            exit;
        }
    }

    function index() {
        $this->view->userList = $this->model->readAllUsers(true);
        $this->view->render("user/index");
    }

    function create() {
      $data = array();
      $data['login'] = $_POST['login'];
      $data['password'] = md5($_POST['password']);
      $data['role'] = $_POST['role'];

      //TODO error checking

      $this->model->create($data);
      header("location: " . URL . "user");
    }

    function edit($id) {
      $this->view->user = $this->model->listSingleUser($id);
      $this->view->render("user/edit");
    }

    function editSave($id) {
      $data = array();
      $data['id'] = $id;
      $data['login'] = $_POST['login'];
      $data['password'] = md5($_POST['password']);
      $data['role'] = $_POST['role'];

      //TODO error checking

      $this->model->editSave($data);
      header("location: " . URL . "user");
    }

    function delete($id) {
      $this->model->delete($id);
      header("location: " . URL . "user");
    }
}
?>
