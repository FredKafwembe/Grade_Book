<?php
class UrlError extends Controller {
  function __construct() {
    parent::__construct();
    //echo "This is a url error.";
  }

  function index() {
    $this->view->message = "This page does not exist!";
    $this->view->render("error/index");
  }
}
?>
