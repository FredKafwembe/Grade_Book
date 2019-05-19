<?php
class Results extends Controller {
  function __construct() {
    parent::__construct();
  }

  function index() {
    $this->view->render("results/index");
  }
}
?>
