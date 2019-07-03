<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class User extends Controller {
    function __construct() {
        parent::__construct();
        Session::init();
        $logged = Session::get("loggedIn");
        $permissions = Session::get("permissions");

        if(!$logged || !isset($permissions["View_Users"])) {
            Session::destroy();
            header("location: login");
            exit;
        }
    }

    function index() {
        $this->view->userList = $this->model->readAllUsers(true);
        $this->view->render("user/index");
    }
    
    function add() {
      $this->view->js = array("../public/js/formValidation.js");

      $this->view->roleList = $this->model->readAllRoles();
      $this->view->render("user/add");
    }

    function broadcastEmail() {
      $emailSubject = $_POST["subject"];
      $roleId = $_POST["roleId"];
      $emailBody = $_POST["body"];

      $userInfo = $this->model->readAllUsersWithRoleId($roleId);

      $mailSent = true;
      $mail = new PHPMailer(true);
      try {
        //Server settings
        $mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'csc4035gradebook@gmail.com';           // SMTP username
        $mail->Password   = 'Grade1234Book';                        // SMTP password
        $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to
    
        //Recipients
        $mail->setFrom("csc4035gradebook@gmail.com", Session::get("firstName") . " " . Session::get("lastName"));
        foreach($userInfo as $user) {
          $mail->addAddress($user["email"], $user["first_name"] . " " . $user["last_name"]);     // Add a recipient
        }
    
        // Content
        $mail->isHTML(false);                                  // Set email format to HTML
        $mail->Subject = $emailSubject;
        $mail->Body    = $emailBody;
    
        $mail->send();
      } catch (Exception $e) {
        $mailSent = false;        
        //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
      header("location: " . URL . "user/sendEmail?success=$mailSent");
    }

    function sendEmail() {
      $this->view->js = array("../public/js/formValidation.js");

      $this->view->roleList = $this->model->readAllRoles();
      $this->view->render("user/sendEmail");
    }

    function edit($id) {
      $this->view->roleList = $this->model->readAllRoles();
      $this->view->user = $this->model->readUser($id);
      $this->view->render("user/edit");
    }

    function create() {
      $data = array();
      $data['firstName'] = $_POST['firstName'];
      $data['lastName'] = $_POST['lastName'];
      $data['password'] = md5($_POST['password']);
      $data['roleId'] = $_POST['roleId'];
      $data['email'] = $_POST['email'];
      $data['contactNumber'] = $_POST['contactNumber'];

      //TODO error checking

      $this->model->create($data);
      header("location: " . URL . "user");
    }

    function updateUser($id) {
      $data = array();
      $data['userId'] = $id;
      $data['firstName'] = $_POST['firstName'];
      $data['lastName'] = $_POST['lastName'];
      $data['password'] = md5($_POST['password']);
      $data['roleId'] = $_POST['roleId'];
      $data['email'] = $_POST['email'];
      $data['contactNumber'] = $_POST['contactNumber'];

      //TODO error checking

      $this->model->updateUser($data);
      header("location: " . URL . "user");
    }

    function deleteUser($id) {
      $this->model->deleteUser($id);
      header("location: " . URL . "user");
    }
}
?>
