<h1>Grade Page</h1>
<?php


 ?>
<!---<form method="post" action="<?php echo URL; ?>grades/updateGrade/<?php echo $this->grade['grade_id']; ?>">
    <label>Grade Name</label><input type="text" name="grade_name" value="<?php echo $this->grade['grade_name']; ?>"/><br/>
    
    <label>Gr</label>
      <select name="roleId">
        <?php //foreach($this->roleList as $role) {
         // if($this->user["role_id_fk"] == $role["role_id"]) {
        //    printf("<option value='%s' selected>%s</option>", $role["role_id"], $role["name"]);
       //   } else {
       //     printf("<option value='%s'>%s</option>", $role["role_id"], $role["name"]);
        //  }
       // }?>
      </select><br/>
    <label>&nbsp;</label><input type='submit'/>
</form>--->


<table>
  <tr>

  <th>First Name</th>
  <th>Last Name</th>
  
  <tr/>
<?php

  foreach($this->pupilList as $key => $value)
   {
      echo "<tr>";
      
      echo "<td>" . $value['first_name'] . "</td>";
      echo "<td>" . $value['last_name'] . "</td>";
     
      

     
      /*echo "<td><a href='" . URL . "grades/demote/" . $value['user_id'] . "'>Demote</a>
      <a href='" . URL . "grades/promote/" . $value['user_id'] . "'>Promote</a>
            <a href='" . URL . "subjects/deletePupil/" . $value['user_id'] ."'>Delete</a> </td>";
      echo "</tr>";*/

  }
 
?>
</tr>
</table>
<br>
<?php 
echo "GRADE TEACHER = " ;
  foreach ($this->teacher as $key => $value) {
  
  echo $value['first_name'] . " " . $value['last_name'];
 echo    "  <a href='" . URL . "grades/deleTea/" . $value['user_id'] . "'>Remove</a> </td>";
      echo "</tr>";
  }
  echo"<br>";
  foreach ($this->grade as $key => $value) {
   echo "<h6><td> <a href='" . URL . "grades/addTea/" . $value['grade_id'] . "'>ADD TEACHER</a></h6>";
    }  


 ?>
 
<?php 

  foreach ($this->grade as $key => $value) {
  echo "<td><h6> <a href='" . URL . "grades/addStud/" . $value['grade_id'] . "'>ADD NEW STUDENT</a></h6>";
  }


 ?>


 <?php 

 /* foreach ($this->grade as $key => $value) {
  echo "<td> <a href='" . URL . "grades/proClass/" . $value['grade_id'] . "'>PROMOTE CLASS</a>";
  }

*/
 ?>
 <br>