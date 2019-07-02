<?php
class Results extends Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->view->js = array("../views/results/js/editMark.js");

    $userId = Session::get("userId");

    $this->view->isPupil = $this->model->isPupil($userId);
    $this->view->isTeacher = $this->model->isTeacher($userId);

    if($this->view->isTeacher) {
       $gradesInfo = $this->model->readGradesTaughtByTeacher($userId);
       $pupilInfo = $this->model->readPupilsInGrades($gradesInfo);
       $this->view->gradesInfo = $gradesInfo;
       $this->view->pupilInfo = $pupilInfo;
       $this->view->pupilsResults = $this->model->readPupilsResults($pupilInfo);
       $this->view->gradesSubjects = $this->model->readSubjectsInGrades($gradesInfo);
    }
    $this->view->render("results/index");
  }

  function updateResults($userId) {
    $resultsData = array();
    $resultsData["userId"] = $userId;    
    $resultsData["testType"] = $_POST["testType"];

    $subjects = $this->model->readSubjectsTakenByPupil($userId);
    foreach($subjects as $subject) {
      $formId = $userId . "" . $subject["subject_id"];
      if(isset($_POST[$formId])) {
        $resultsData["results"][] = array("subjectId" => $subject["subject_id"], "percentage" => $_POST[$formId]);
      }
    }

    $this->model->updateResults($resultsData);
    header("location: " . URL . "results");
  }
}
?>
