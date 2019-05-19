<?php
class Controller {
  function __construct() {
    //echo "Main controller.";
    $this->view = new View();
  }

  function loadModel($name) {
    $path = "models/" . $name . "Model.php";
    if(file_exists($path)) {
      require $path;
      $modelName = $name . "Model";
      $this->model = new $modelName();
    }
  }
}
?>
