<?php




   class GradesModel extends Model {
    function __construct() {
        parent::__construct();
    }


    /*
    (
            "SELECT grades.grade_id, grades.grade_name, users.first_name, users.last_name, count(pupils.grade_id_fk) FROM grades INNER JOIN pupils ON pupils.grade_id_fk = grades.grade_id INNER JOIN grades_taught ON grades_taught.grade_id_fk = grades.grade_id INNER JOIN users on users.user_id = grades_taught.user_id_fk");
    ;
      return $statment->fetch();
      SELECT grade_id,   grade_name FROM grades

    }*/
     function readSpec($data){
     $statment = $this->db->prepare(
            "SELECT  users.first_name,users.user_id, users.last_name, users.email , users.role_id_fk, users.contact_number FROM  users WHERE role_id_fk = :roleid "); 
       $statment->execute(array(":roleid"=> $data));

        $userData = $statment->fetchAll();
        
        //die;
        return $userData;
  }
    function readAllStuds(){
       $statment = $this->db->prepare(
            "SELECT  users.first_name,users.user_id, users.last_name, users.email , users.role_id_fk, users.contact_number FROM  users "); 
       $statment->execute();

        $userData = $statment->fetchAll();
        
        //die;
        return $userData;
    }
    function readAllTea(){
       $statment = $this->db->prepare(
            "SELECT pupils.user_id_fk, pupils.grade_id_fk, users.first_name,users.user_id, users.last_name, users.email , users.role_id_fk, users.contact_number FROM pupils INNER JOIN users ON pupils.user_id_fk = users.user_id"); 
       $statment->execute();

        $userData = $statment->fetchAll();
        
        //die;
        return $userData;
    }
    function enterGrd($data){
         $statment = $this->db->prepare("INSERT INTO pupils (user_id_fk , grade_id_fk) VALUES (:user_id, :grade_id");
         $statment->execute(array(":user_id" => $data['user_id'], ":grade_id" => $data['grade_id']));
         return $statment;

    }
     function appoint($data){
         $statment = $this->db->prepare("INSERT INTO grades_taught (user_id_fk , grade_id_fk) VALUES (:user_id, :grade_id");
         $statment->execute(array(":user_id" => $data["user_id"], ":grade_id" => $data["grade_id"]));
         return $statment;

    }

    function deleTea($id){

      $statment = $this->db->prepare("DELETE FROM grades_taught WHERE user_id_fk = :grade_id");
      $statment->execute(array(":grade_id" => $id));
    


    }

    function readAllGrades() {
        $statment = $this->db->prepare(
            "SELECT     grade_id,grade_name FROM grades ORDER BY grade_name ");

        $statment->execute();

        $userData = $statment->fetchAll();
       
        //die;
        return $userData;
    }
     function readTeacher($id) {
        $statment = $this->db->prepare(
            "SELECT users.user_id, users.role_id_fk, users.first_name, users.last_name , grades_taught.user_id_fk, grades_taught.grade_id_fk FROM grades_taught INNER JOIN users ON grades_taught.user_id_fk = users.user_id WHERE grades_taught.grade_id_fk = :grade_id ");

        $statment->execute(array(":grade_id"=> $id));

        $userData = $statment->fetchAll();
        
        //die;
        return $userData;
    }


    function readAllPupils($grade_id_fk){

        $statment = $this->db->prepare("SELECT users.user_id, users.first_name ,users.last_name  FROM users INNER JOIN pupils ON users.user_id =  pupils.user_id_fk WHERE grade_id_fk = :grade_id_fk");
        $statment->execute(array(":grade_id_fk"=>$grade_id_fk));
        $data = $statment->fetchAll();
        return $data;
    }
      function readAllRoles() {
    $statment = $this->db->prepare("SELECT role_id, name FROM roles");
    $statment->execute();
    return $statment->fetchAll();
  }

  /*function enterGrade($id,$data){
    $statement = $this->db->prepare("SELECT user_id FROM users WHERE password = :password, first_name = :first_name AND last_name = :last_name AND contact_number = :contact_number AND email = :email  ");
    $statement->execute(array)
    $statment = $this->db->prepare("INSERT INTO pupils (user_id_fk,grade_id_fk) VALUES (:user_id_fk, :grade_id_fk)");
    $statment->execute(array(""))

  }*/


  function createStud($data) {
        $statment = $this->db->prepare("INSERT INTO users(role_id_fk, first_name, last_name,
            password, email, contact_number) VALUES (:roleId, :firstName, :lastName,
            :password, :email, :contactNumber)");
        $statment->execute(array(":roleId" => $data["roleId"],
            ":firstName" => $data["firstName"], ":lastName" => $data["lastName"],
            ":password" => $data["password"], ":email" => $data["email"],
            ":contactNumber" => $data["contactNumber"]));
    }

    function readGrade2($grade_id) {

        $statment = $this->db->prepare(
            "SELECT grade_id,   grade_name FROM grades WHERE grade_id =  :grade_id");
        $statment->execute(array(":grade_id"=>$grade_id
        ));
        $userData = $statment->fetch();
       
       return $userData;
    }
    function proClass($id){
        $statment = $this->db->prepare(" UPDATE pupils SET grade_id_fk = grade_id_fk + 1 WHERE grade_id_fk = :grade_id_fk ");
        $statment->execute(array(":grade_id_fk" => $id));
        $userData = $statment->fetchAll();
        return $userData;
    }


    function promote($id){
        $statment = $this->db->prepare(" UPDATE pupils SET grade_id_fk = grade_id_fk + 1 WHERE user_id_fk = :user_id_fk ");
        $statment->execute(array(":user_id_fk" => $id));
        $userData = $statment->fetchAll();
        return $userData;
    }
     function demote($id){
        $statment = $this->db->prepare(" UPDATE pupils SET grade_id_fk = grade_id_fk - 1 WHERE user_id_fk = :user_id_fk ");
        $statment->execute(array(":user_id_fk" => $id));
        $userData = $statment->fetchAll();
        return $userData;
    }

    
     function readGrade($grade_id) {

        $statment = $this->db->prepare(
            "SELECT grade_id,   grade_name FROM grades WHERE grade_id =  :grade_id");
        $statment->execute(array(":grade_id"=>$grade_id
        ));
        $userData = $statment->fetchAll();
        
        return $userData;
    }

    /*
    
    $statment = $this->db->prepare("INSERT INTO grades (grade_name) VALUES (:grade_name
            )");
    */


    function create($data) {
        
        
        $statment = $this->db->prepare("INSERT INTO grades (grade_name) VALUES (:grade_name
            )");
        $tat = $this->db->prepare("INSERT INTO users ");
        $statment->execute(array(
            ":grade_name" => $data["grade_name"]));
           
    }



    function updateGrade($data) {
        $statment = $this->db->prepare("UPDATE grades SET   grade_name = :grade_name WHERE  grade_id = :grade_id");
        $statment->execute(array(":grade_name" => $data["grade_name"], ":grade_id" => $data["grade_id"]));



    }

     function deleteUser($id) {
      $statment = $this->db->prepare("DELETE FROM grades WHERE grade_id = :grade_id");
      $statment->execute(array(":grade_id" => $id));
    }

    function deleteModel($id) {
      $statment = $this->db->prepare("DELETE FROM grades WHERE grade_id = :grade_id");
      $statment->execute(array(":grade_id" => $id));
    }
}

?>