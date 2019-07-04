<?php
class Subjects extends Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
  	$this->view->subList = $this->model->readSubjects();
    $this->view->render("subjects/index");
  }
  function add() {
     $this->view->subList = $this->model->readSubjects();
      $this->view->gradename = $this->model->readGrades();
      $this->view->render("subjects/add");
    }

  function readSubjects($id){
    $this->view->grade_id = $id;
    $this->view->sub = $this->model->readAllSubjects($id);
    $this->view->render("subjects/grades");
  }


  function updateSubName($id){
      $data = array();
      $data['subject_id'] = $id;
      $data['name'] = $_POST['name'];
      

      //TODO error checking

      $this->model->updateSubName($data);
      header("location: " . URL . "subjects");

function position(){

}

  }
  
    function updateMark($id) {
      $data = array();
      $data['user_id_fk'] = $_POST['user_id_fk'];
      $data['subject_id_fk'] = $id;
      $data['test_time'] = $_POST['test_time'];
      $data['percentage'] = $_POST['percentage'];
      

      //TODO error checking

      $this->model->updateMark($data);
      //$this->view->render("subjects/results/".$id);
      header("location: " . URL . "grades");


    }
function editSubName($id) {
      //$this->view->roleList = $this->model->readAllSubjects();
     // $this->view->user = $this->model->readUser($id);
       $this->view->subject = $this->model->readEditSubject($id);
      $this->view->render("subjects/editGrade");
    }

function appoint(){
      $data = array();
      $data['subject_id'] = $_POST['subject_id'];
      $data['user_id'] = $_POST['user_id'];
      print_r($data);
      $this->view->addToGrd = $this->model->appoint($data);
       $this->view->render("grades/index");

    }


     function assTeac($id){
      $this->view->userList = $this->model->readAllStuds();
      $this->view->roleList = $this->model->readAllRoles();
      $this->view->grade_id = $id;
        $this->view->render("subjects/addTea");
    }
    function filter(){
        $data; 
        $this->view->roleList = $this->model->readAllRoles();
        $data = $_POST['roleId'];
        $this->view->userList = $this->model->readSpec($data);
        $this->view->grade_id = $_POST["grade_id"];
      $this->view->render("subjects/addTea");
    }


    function resultEdit($data){
  $this->view->subjectList = $this->model->readSpecSubjects($data);
  $this->view->testType = $this->model->readSpecTestime($data);
  
  $this->view->render("subjects/resultEdit");
}


function deleteSubject($id){
	$this->model->deleteSubject($id);
	header("location: " . URL . "subjects");
}
function deletePupil($id){
  $this->model->deletePupil($id);
  header("location: " . URL . "grades");
}
function deleteMark($id){
  $this->model->deleteMark($id);
  header("location: " . URL . "grades");
}
function addGrade(){
 $data = array();
      $data['user_id_fk'] = $_POST['user_id_fk'];
      $data['subject_id_fk'] = $_POST['subject_id_fk'];
      $data['test_time'] = ($_POST['test_time']);
      $data['percentage'] = $_POST['percentage'];
      
      //TODO error checking

      $this->model->addGrade($data);

      print_r($data);
    
      //header("location: " . URL . "subjects/results/");
}

 
function results($id){
  $this->view->resultList = $this->model->readResults($id);
  $this->view->total = $this->model->total($id);
  //$this->view->position = $this->model->position($id);
  //$data = array();
  //$data['SUM(mark.percentage'] = $_POST['sum'];
  //$this->model->position($data);
  $this->view->render("subjects/results");
}





	function create() {
      $data = array();
      $data['name'] = $_POST['name'];
      $this->view->subList = $this->model->readSubjects();
      $this->model->create($data);
      header("location: " . URL . "subjects");
    }
function markAdd($data){
      $this->view->subjectList = $this->model->readStudSubjects($data);
       
       //$this->view->testType = $this->model->readResults($data);
      
      $this->view->render("subjects/markAdd");
      
}

}
?>
