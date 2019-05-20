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
        $this->view->roleList = $this->model->readAllRoles();
        $this->view->userList = $this->model->readAllUsers(true);
        $this->view->render("user/index");
    }
    
    function edit($id) {
      $this->view->roleList = $this->model->readAllRoles();
      $this->view->user = $this->model->readUser($id);
      $this->view->render("user/edit");
    }

    function create() {
      $data = array();
      $data['firstName'] = $_POST['firstName'];
      $data['lastName'] = $_POST['lastName'];
      $data['password'] = md5($_POST['password']);
      $data['roleId'] = $_POST['roleId'];
      $data['email'] = $_POST['email'];
      $data['contactNumber'] = $_POST['contactNumber'];

      //TODO error checking

      $this->model->create($data);
      header("location: " . URL . "user");
    }

    function updateUser($id) {
      $data = array();
      $data['userId'] = $id;
      $data['firstName'] = $_POST['firstName'];
      $data['lastName'] = $_POST['lastName'];
      $data['password'] = md5($_POST['password']);
      $data['roleId'] = $_POST['roleId'];
      $data['email'] = $_POST['email'];
      $data['contactNumber'] = $_POST['contactNumber'];

      //TODO error checking

      $this->model->updateUser($data);
      header("location: " . URL . "user");
    }

    function deleteUser($id) {
      $this->model->deleteUser($id);
      header("location: " . URL . "user");
    }
}
?>
