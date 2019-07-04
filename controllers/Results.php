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

    if($this->view->isPupil) {
      $this->view->firstName = Session::get("firstName");
      $this->view->lastName = Session::get("lastName");
      $this->view->gradeData = $this->model->readPupilGrade(Session::get("userId"));
      $pupilResultsData = $this->model->readPupilResults(Session::get("userId"));
      $this->calculatePassGrades($pupilResultsData);
      $this->view->pupilResults = $pupilResultsData;
      $this->view->render("results/pupil");
    } else {
      $gradesInfo = array();
      if($this->view->isTeacher) {
        $gradesInfo = $this->model->readGradesTaughtByTeacher($userId);
      } else {
        $gradesInfo = $this->model->readAllGradeInfo();
      }
      //print_r($gradesInfo);
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

  function createPDF($gradeId) {
    $tableColumnWidth = 50;

    $gradesInfo = $this->model->readGradeInfo($gradeId);
    $pupilsInfo = $this->model->readPupilsInGrades($gradesInfo);
    $pupilsResults = $this->model->readPupilsResults($pupilsInfo);
    $this->calculatePassGrades($pupilsResults);

    $pdf = new FPDF();
    foreach($pupilsInfo[$gradesInfo[0]["grade_id"]] as $pupilInfo) {
      $pdf->AddPage();
      $pdf->SetFont('Arial','B',24);
      $pdf->Cell(80);
      $pdf->Cell(30, 10, 'Results', 0, 0, 'C');
      $pdf->Ln(20);
      
      $pdf->SetFont('Arial', '', 16);

      $pdf->Cell(0, 10, "Grade: " . $gradesInfo[0]["grade_name"], 0, 1, 'L');
      $pdf->Cell(0, 10, "Name: " . $pupilInfo["first_name"] . " " . $pupilInfo["last_name"], 0, 1, 'L');

      $pdf->Ln();


      /*Start creating mid term table*/
      $pdf->Cell($tableColumnWidth, 7, "", 'TL');
      $pdf->Cell($tableColumnWidth, 7, "Mid Term", 'TB', 0, 'C');
      $pdf->Cell($tableColumnWidth, 7, "", 'TR');
      $pdf->Ln();

      $header = array("Subject Name", "Percentage", "Grade");
      foreach($header as $columnHeader) {
        $pdf->Cell($tableColumnWidth, 7, $columnHeader, 1, 'C');
      }
      $pdf->Ln();
      foreach($pupilsResults[$pupilInfo["user_id"]] as $subjectResult) {
        if($subjectResult["test_time"] != TEST_TYPE["mid"]) {
          continue;
        }

        $pdf->Cell($tableColumnWidth, 6, $subjectResult["name"], 1);
        $pdf->Cell($tableColumnWidth, 6, $subjectResult["percentage"], 1);
        $pdf->Cell($tableColumnWidth, 6, $subjectResult["passGrade"], 1);
        $pdf->Ln();
      }

      /*Start creating end of term table*/
      $pdf->Ln();

      $pdf->Cell($tableColumnWidth, 7, "", 'TL');
      $pdf->Cell($tableColumnWidth, 7, "End of Term", 'TB', 0, 'C');
      $pdf->Cell($tableColumnWidth, 7, "", 'TR');
      $pdf->Ln();

      $header = array("Subject Name", "Percentage", "Grade");
      foreach($header as $columnHeader) {
        $pdf->Cell($tableColumnWidth, 7, $columnHeader, 1, 'C');
      }
      $pdf->Ln();
      foreach($pupilsResults[$pupilInfo["user_id"]] as $subjectResult) {
        if($subjectResult["test_time"] != TEST_TYPE["end"]) {
          continue;
        }

        $pdf->Cell($tableColumnWidth, 6, $subjectResult["name"], 1);
        $pdf->Cell($tableColumnWidth, 6, $subjectResult["percentage"], 1);
        $pdf->Cell($tableColumnWidth, 6, $subjectResult["passGrade"], 1);
        $pdf->Ln();
      }
    }

    //$pdf->Cell(60,10,'Powered by FPDF.',0,1,'C');
    $pdf->Output();
  }

  function exportToExcel($gradeId) {
    $gradesInfo = $this->model->readGradeInfo($gradeId);
    $pupilsInfo = $this->model->readPupilsInGrades($gradesInfo);
    $pupilsResults = $this->model->readPupilsResults($pupilsInfo);
    $this->calculatePassGrades($pupilsResults);

    $data = array();
    foreach($pupilsInfo[$gradesInfo[0]["grade_id"]] as $pupilInfo) {
      foreach($pupilsResults[$pupilInfo["user_id"]] as $pupilResults) {
        $pupilData["First Name"] = $pupilInfo["first_name"];
        $pupilData["Last Name"] = $pupilInfo["last_name"];
        $pupilData["Subject Name"] = $pupilResults["name"];
        $pupilData["Test Type"] = $pupilResults["test_time"];
        $pupilData["Percentage"] = $pupilResults["percentage"];
        $pupilData["Pass Grade"] = $pupilResults["passGrade"];
        $data[] = $pupilData;
      }
    }
    
    // file name for download
    $fileName = "grade_book-" . $gradesInfo[0]["grade_name"] . date('Ymd') . ".xls";
    
    // headers for download
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Type: application/vnd.ms-excel");
    
    $flag = false;
    foreach($data as $row) {
        if(!$flag) {
            // display column names as first row
            echo implode("\t", array_keys($row)) . "\n";
            $flag = true;
        }
        // filter data
        array_walk($row, array($this, 'filterData'));
        echo implode("\t", array_values($row)) . "\n";

    }
  }

  function filterData(&$str) {
      $str = preg_replace("/\t/", "\\t", $str);
      $str = preg_replace("/\r?\n/", "\\n", $str);
      if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }
}
?>
