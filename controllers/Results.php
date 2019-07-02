<?php
class Results extends Controller {
  function __construct() {
    parent::__construct();

    $logged = Session::get("loggedIn");
    $permissions = Session::get("permissions");
    if(!$logged || !$permissions["View_Results"]) {
      Session::destroy();
      header("location: login");
      exit;
    }
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
      $pupilsResults = $this->model->readPupilsResults($pupilInfo);
      $this->calculatePassGrades($pupilsResults);
      $this->view->pupilsResults = $pupilsResults;
      $this->view->gradesSubjects = $this->model->readSubjectsInGrades($gradesInfo);
      $this->view->render("results/teacher");
    } else if($this->view->isPupil) {
      $this->view->firstName = Session::get("firstName");
      $this->view->lastName = Session::get("lastName");
      $this->view->gradeData = $this->model->readPupilGrade(Session::get("userId"));
      $pupilResultsData = $this->model->readPupilResults(Session::get("userId"));
      $this->calculatePassGrades($pupilResultsData);
      $this->view->pupilResults = $pupilResultsData;
      $this->view->render("results/pupil");
    } else {
      $gradesInfo = $this->model->readAllGradeInfo();
      $pupilInfo = $this->model->readPupilsInGrades($gradesInfo);
      $this->view->gradesInfo = $gradesInfo;
      $this->view->pupilInfo = $pupilInfo;
      $pupilsResults = $this->model->readPupilsResults($pupilInfo);
      $this->calculatePassGrades($pupilsResults);
      $this->view->pupilsResults = $pupilsResults;
      $this->view->gradesSubjects = $this->model->readSubjectsInGrades($gradesInfo);
      $this->view->render("results/index");
    }
  }

  function calculatePassGrades(&$pupilResultsData) {
    foreach($pupilResultsData as &$pupilResults) {
      foreach($pupilResults as &$subjectResults) {
        $percent = $subjectResults["percentage"];
        if($percent < PASS_GRADES["E"]) {
          $subjectResults["passGrade"] = "F";
        } else if($percent < PASS_GRADES["D"]) {
          $subjectResults["passGrade"] = "E";
        } else if($percent < PASS_GRADES["C"]) {
          $subjectResults["passGrade"] = "D";
        } else if($percent < PASS_GRADES["B"]) {
          $subjectResults["passGrade"] = "C";
        } else if($percent < PASS_GRADES["A"]) {
          $subjectResults["passGrade"] = "B";
        } else {
          $subjectResults["passGrade"] = "A";
        }
      }
    }
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
