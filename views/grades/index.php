<div class="text-center">
  <h1>Grades</h1>
</div>

<div class="card">
<table>
  <tr>

  <th>GRADE</th>
 
  
  <tr/>

<?php

  foreach($this->gradeList as $key => $value) {
      echo "<tr>";
      
      echo "<td>" . $value['grade_name'] . "</td>";
     
      echo "<td> <a href='" . URL . "grades/edit/" . $value['grade_id'] . "'>View</a>
            <a href='" . URL . "grades/deleteUser/" . $value['grade_id'] . "'>Delete</a> </td>";
      echo "</tr>";

  }
?>
</table>
</div>
<br>

<div class="text-center">
  <form method="post" class="form" action="<?php echo URL; ?>grades/add">
    <button type="submit" class="btn btn-primary">Add Grade</button>
  </form>
</div>






