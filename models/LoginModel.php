<?php
class LoginModel extends Model {
  function __construct() {
    parent::__construct();
    //echo "Login in model.";
  }

  public function run() {
    $statement = $this->db->prepare("SELECT id, role FROM users WHERE login = :login AND password = MD5(:password)");
    $statement->execute(array(":login" => $_POST['login'], ":password" => $_POST['password']));

    $data = $statement->fetch();
    //print_r($data);

    $count = $statement->rowCount();

    if($count > 0) {
      //Login
      Session::init();
      Session::set("role", $data['role']);
      Session::set("loggedIn", true);
      header("location: ../dashboard");
    } else {
      //Error
      header("location: ../login");
    }
  }
}
?>
