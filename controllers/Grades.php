<?php
class Grades extends Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
  	$this->view->gradeList = $this->model->readAllGrades();
    $this->view->render("grades/index");

  }


/*function index() {
        $this->view->gradeList = $this->model->readAllRoles();
        $this->view->gradeList = $this->model->readAllUsers(true);
        $this->view->render("grades/index");
    }*/

	function edit($id) {
      $this->view->gradeList = $this->model->readAllGrades();
      //$this->view->user = $this->model->readUser($id);
      $this->view->render("grades/edit");
    }

  	function create() {
      $data = array();
      $data['grade_name'] = $_POST['grade_name'];
      
      $this->model->create($data);
      header("location: " . URL . "grades");
    }


    function deleteUser($id) {
      $this->model->deleteUser($id);
      header("location: " . URL . "user");
    }
  
}
?>
