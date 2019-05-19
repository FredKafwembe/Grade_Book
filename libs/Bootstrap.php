<?php
class Bootstrap {
  function __construct() {
    $url = (isset($_GET["url"])) ? $_GET["url"] : null;
    $url = rtrim($url, "/");
    $url = explode("/", $url);
    //print_r($url);

    if(empty($url[0])) {
      require "controllers/Index.php";
      $controller = new Index();
      $controller->index();
      return false;
    }

    $file = "controllers/" . $url[0] . ".php";
    if(file_exists($file)) {
      require $file;
    } else {
      require "controllers/UrlError.php";
      $error = new UrlError();
      $error->index();
      return false;
      //            throw new Exception("The file $file does not exist!");
    }

    $controller = new $url[0];
    $controller->loadModel($url[0]);

    if(isset($url[1])) {
      if(method_exists($controller, $url[1])) {
        if(isset($url[2])) {
          $controller->{$url[1]}($url[2]);
          //return false;
        } else {
          $controller->{$url[1]}();
          //$controller->index();
        }
      } else {
        require "controllers/UrlError.php";
        $error = new UrlError();
        $error->index();
        return false;
      }
    } else {
      $controller->index();
    }
  }
}
?>
