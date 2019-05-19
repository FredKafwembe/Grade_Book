<?php
class Help extends Controller {
  function __construct() {
    parent::__construct();
    $this->view->blah = md5("qwerty");;
  }

  public function index() {
    $this->view->render("help/index");
  }

  public function other($arg = false) {
    //echo "We are inside other.<br/>";
    //echo "Optional: " . $arg . "<br/>";
    //require "models/HelpModel.php";
    //$model = new HelpModel();
    $this->view->blah = $this->model->blah();
  }
}
?>
