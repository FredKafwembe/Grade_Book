<?php
class SubjectsModel extends Model {
    function __construct() {
      parent::__construct();
    }

    function insertSubject($name) {
        $stm = $this->db->prepare("INSERT INTO subject (name) VALUES (:name)") ;
        $stm->execute(array( ':name' => $name));
        echo "New record created successfully";
    }
    function readAllGrades() {
        $statment = $this->db->prepare(
            "SELECT grades.grade_id, grades.grade_name, users.first_name, users.last_name, count(pupils.grade_id_fk) FROM grades INNER JOIN pupils ON pupils.grade_id_fk = grades.grade_id INNER JOIN grades_taught ON grades_taught.grade_id_fk = grades.grade_id INNER JOIN users on users.user_id = grades_taught.user_id_fk");

        $statment->execute();

        $userData = $statment->fetchAll();
        
        //die;
        return $userData;
    }
    function updateSubName($data){
         $statment = $this->db->prepare("UPDATE subjects SET   name = :name WHERE  subject_id = :subject_id");
        $statment->execute(array(":name" => $data["name"], ":subject_id" => $data["subject_id"]));


    }
   

    //well use this function for the subject and grade page
    function readSubjects(){
        $statment = $this->db->prepare("SELECT subject_id ,name ,required FROM subjects ORDER BY name ");
        $statment->execute();
        $subData = $statment->fetchAll();
        return $subData;
        
        
        
    }


    function readAllSubjects($grade_id){
        $statment = $this->db->prepare("SELECT * FROM subjects  WHERE grade_id = $grade_id");
        $statment->execute(array(":grade_id" => $grade_id));
        $subData = $statment->fetchAll();
        return $subData;
         
        
    }
    function readSpec($data){
     $statment = $this->db->prepare(
            "SELECT  users.first_name,users.user_id, users.last_name, users.email , users.role_id_fk, users.contact_number FROM  users WHERE role_id_fk = :roleid "); 
       $statment->execute(array(":roleid"=> $data));

        $userData = $statment->fetchAll();
        
        //die;
        return $userData;
  }
  function appoint($data){
         $statment = $this->db->prepare("INSERT INTO subjects_taught (subject_id_fk , users_id_fk) VALUES (:subject_id_fk, :users_id_fk");
         $statment->execute(array(":subject_id_fk" => $data["subject_id"], ":users_id_fk" => $data["user_id"]));
         return $statment;

    }
   
    function readAllStuds(){
       $statment = $this->db->prepare(
            "SELECT  users.first_name,users.user_id, users.last_name, users.email , users.role_id_fk, users.contact_number FROM  users "); 
       $statment->execute();

        $userData = $statment->fetchAll();
        
        //die;
        return $userData;
    }
      function readAllRoles() {
    $statment = $this->db->prepare("SELECT role_id, name FROM roles");
    $statment->execute();
    return $statment->fetchAll();
  }
    

    function readStudSubjects($user_id_fk){
        $statment = $this->db->prepare("SELECT users.first_name, users.last_name, pupils.user_id_fk, pupils.grade_id_fk , subjects.name, subjects.subject_id, subjects.required FROM subjects INNER JOIN pupils ON pupils.grade_id_fk = subjects.grade_id INNER JOIN users ON users.user_id = pupils.user_id_fk WHERE user_id_fk = $user_id_fk ");
        $statment->execute(array(":user_id_fk" => $user_id_fk));
        $subData = $statment->fetchAll();
         
    }

     function readSpecSubjects($subject_id){
        $statment = $this->db->prepare("SELECT subject_id,  name, grade_id,required FROM subjects WHERE subject_id = :subject_id");
        $statment->execute(array(":subject_id" => $subject_id));
        $subData = $statment->fetchAll();
        
         return $subData;
    }
    function readEditSubject($subject_id){
        $statment = $this->db->prepare("SELECT subject_id, name FROM subjects WHERE subject_id = :subject_id");
        $statment->execute(array(":subject_id" => $subject_id));
        $subData = $statment->fetch();
         

         return $subData;

    }

    function updateMark($data){


        $statment = $this->db->prepare("UPDATE marks SET test_time = :test_time , percentage = :percentage WHERE user_id_fk = :user_id_fk AND subject_id_fk = :subject_id_fk");
        $statment->execute(array(":test_time" => $data["test_time"], ":percentage" => $data["percentage"], ":user_id_fk" => $data["user_id_fk"], ":subject_id_fk" => ["subject_id_fk"]));
        
        
        
        
    }


    function mark($data){

        $statment = $this->db->prepare("INSERT INTO marks (subject_id_fk, test_time,    percentage) VALUES (:subject_id_fk, :test_time, :percentage ) WHERE user_id_fk = :user_id_fk ");
        $statment->execute(array(":subject_id_fk" => $data["subject_id_fk"], ":test_time" => $data["test_time"], ":percentage" => $data["percentage"]));
    }




    function readResults($user_id_fk){

        $statment = $this->db->prepare("SELECT marks.user_id_fk , marks.subject_id_fk ,subjects.subject_id, subjects.name, subjects.grade_id ,marks.percentage ,marks.test_time ,marks.score FROM marks INNER JOIN subjects ON marks.subject_id_fk = subjects.subject_id WHERE user_id_fk = :user_id_fk ");
        $statment->execute(array(":user_id_fk" => $user_id_fk));
        $data = $statment->fetchAll();
        
        return $data;
        
    }
    function total($user_id_fk){

        $statment = $this->db->prepare("SELECT SUM(marks.percentage) FROM marks INNER JOIN subjects ON marks.subject_id_fk = subjects.subject_id WHERE user_id_fk = :user_id_fk ");
        $statment->execute(array(":user_id_fk" => $user_id_fk));
        $data = $statment->fetchAll();
        
        return $data;
        
    }
    function position($user_id_fk){
         $statment = $this->db->prepare("SELECT SUM(marks.percentage) FROM marks INNER JOIN subjects ON marks.subject_id_fk = subjects.subject_id WHERE user_id_fk = :user_id_fk ");
        $statment->execute(array(":user_id_fk" => $user_id_fk));
        $data = $statment->fetch();
     echo ($data);
        die;

        $statement = $this->db->prepare("UPDATE position set (sum) = (:sum) where user_id_fk = :user_id_fk");
        $statement->execute(array(":user_id_fk" => $user_id_fk,
            ":sum" => $data["SUM(marks.percentage)"]
        ));
        $dat = $statement->fetchAll();
        
        return $dat;
        
        
    }
    function enter($user_id_fk){


    }
    /*function readAllSubjects()
    {
        $statment = $this->db->prepare("SELECT * FROM subjects ");
       $data = $statment->execute();
       return $data;

    }*/

   function addGrade($data) {
        $score;
        if ($data["percentage"] <= "100" && $data["percentage"] >= "90") {
            $score = "A+";

           
        }else{
            $score = "B+";
            }        
        $statment = $this->db->prepare("INSERT INTO marks( user_id_fk, subject_id_fk, test_time,
            percentage, score) VALUES (:user_id_fk, :subject_id_fk, :test_time,
            :percentage ,:score)");
        $statment->execute(array(":user_id_fk" => $data["user_id_fk"],
            ":subject_id_fk" => $data["subject_id_fk"], ":test_time" => $data["test_time"],
            ":percentage" => $data["percentage"],
            ":score" => $score
     ));        
    }

    function readSpecTestime($subject_id_fk)
    {
        $statment = $this->db->prepare(" SELECT * FROM marks WHERE  subject_id_fk = :subject_id_fk");
        $statment->execute(array(":subject_id_fk" => $subject_id_fk));
        $subData = $statment->fetchAll();
         
         
    }

    function readAllTestime()
    {
        $statment = $this->db->prepare(" SELECT * FROM marks");
        $data = $statment->execute();
       return $data;
    }

    function updateSubject($subjectId, $name) {
        $sql = "UPDATE subject SET name = '$name' WHERE subject_id = $subjectId" ;
        $rowsUpdated = $this->db->exec($sql);
        if(isset($rowsUpdated)) {
            echo "Successfully updated";
        }
    }
    function readGrades(){
        $statment = $this->db->prepare(" SELECT * FROM grades ORDER BY grade_name");
        $statment->execute();
        $subData = $statment->fetchAll();
         
         return $subData;

    }

    function selectSubject($subjectId) {
        $sql = "SELECT * FROM subject WHERE subject_id = $subjectId" ;
        return $this->db->query($sql);
    }

    function deleteSubject($id) {
        $sql =$this->db->prepare("DELETE FROM subjects WHERE subject_id = :subject_id" );
        $sql->execute(array(":subject_id" => $id));
        
        }
        

    function create($data) {
       
        $statment = $this->db->prepare("INSERT INTO subjects (name) VALUES (:name)");
              
        $statment->execute(array(
            ":name" => $data["name"]));
        return $statment;
           
    }
    
}
?>
