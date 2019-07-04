<?php
class Grades extends Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
  	$this->view->gradeList = $this->model->readAllGrades();
    $this->view->render("grades/index");

  }
 
 function createStud($id) {
      $data = array();
      $data['firstName'] = $_POST['firstName'];
      $data['lastName'] = $_POST['lastName'];
      $data['password'] = md5($_POST['password']);
      $data['roleId'] = $_POST['roleId'];
      $data['email'] = $_POST['email'];
      $data['contactNumber'] = $_POST['contactNumber'];

      //TODO error checking
      $this->view->grade = $this->model->readGrade2($id);
      $this->model->createStud($data);
      //$this->model->enterGrade($id, $data);
      header("location: " . URL . "grades/addGrade/". $id);
    }
    function proClass($id){
      $this->view->proClass = $this->model->proClass($id);
      $this->view->gradeList = $this->model->readAllGrades();
      $this->view->render("grades/index");
    }
    function deleTea($id){
      $this->view->gradeList = $this->model->readAllGrades();
      $this->view->remove = $this->model->deleTea($id);
      $this->view->render("grades/index");
    }

    function promote($id){
      $this->view->promote = $this->model->promote($id);
      $this->view->gradeList = $this->model->readAllGrades();
      $this->view->render("grades/index");
    }
    function addToGrd(){
      $data = array();
      $data['grade_id'] = $_POST['grade_id'];
      $data['user_id'] = $_POST['user_id'];
      print_r($data);
      $this->view->addToGrd = $this->model->enterGrd($data);
      $this->view->gradeList = $this->model->readAllGrades();
        header("location: " . URL . "grades");

    }
    function appoint(){
      $data = array();
      $data['grade_id'] = $_POST['grade_id'];
      $data['user_id'] = $_POST['user_id'];
      print_r($data);
      $this->view->addToGrd = $this->model->appoint($data);
       $this->view->render("grades/index");

    }




    function demote($id){
      $this->view->gradeList = $this->model->readAllGrades();
      $this->view->demote = $this->model->demote($id);
      $this->view->render("grades/index");
    }

    function addGrade($id){
      $this->view->grade = $this->model->readGrade2($id);

      $this->view->render("grades/addGrade");

    }
    function addStud($id){
      $this->view->userList = $this->model->readAllStuds();
        $this->view->roleList = $this->model->readAllRoles();
      $this->view->grade_id = $id;
        $this->view->render("grades/addStud");
    }
      function filter(){
        $data; 
        $this->view->roleList = $this->model->readAllRoles();
        $data = $_POST['roleId'];
        $this->view->userList = $this->model->readSpec($data);
        $this->view->grade_id = $_POST["grade_id"];
      $this->view->render("grades/addStud");
    }
    function filterTea(){
      $data; 
      $this->view->roleList = $this->model->readAllRoles();
      $data = $_POST['roleId'];
      $this->view->userList = $this->model->readSpec($data);
      $this->view->grade_id = $_POST["grade_id"];
    $this->view->render("grades/addTea");
  }
      function addTea($id){
        $this->view->userList = $this->model->readAllStuds();
      $this->view->roleList = $this->model->readAllRoles();
      $this->view->grade_id = $id;
        $this->view->render("grades/addTea");
    }

/*function index() {
        $this->view->gradeList = $this->model->readAllRoles();
        $this->view->gradeList = $this->model->readAllUsers(true);
        $this->view->render("grades/index");
    }*/

      function add() {
      $this->view->gradeList = $this->model->readAllGrades();
      $this->view->render("grades/add");
    }

     function updateGrade($id) {
      $data = array();
      $data['grade_id'] = $id;
      $data['grade_name'] = $_POST['grade_name'];
      

      //TODO error checking

      $this->model->updateGrade($data);
      header("location: " . URL . "grades");
    }
    

	function edit($id) {   
      
      
      $this->view->gradeList = $this->model->readAllGrades();
      $this->view->grade = $this->model->readGrade($id);
      $this->view->pupilList = $this->model->readAllPupils($id);
      $this->view->teacher = $this->model->readTeacher($id);
      $this->view->render("grades/edit");

      /*if($id = false){
        $this->view->gradeList = $this->model->readAllGrades();}
      */
    }
   
    function readAllPupils(){
      $this->view->pupilList = $this->model->readAllPupils();
      $this->view->render("subjects/edit");
    }
 
  	function create() {
      $data = array();
      $data['grade_name'] = $_POST['grade_name'];

      $this->model->create($data);
      header("location: " . URL . "grades");
    }


    function deleteUser($id = true) {
      $this->model->deleteUser($id);
      header("location: " . URL . "grades");
      if($id = false){
        $this->view->gradeList = $this->model->readAllGrades();
      
      $this->view->render("grades/index");
      }
    }
  
}
?>
