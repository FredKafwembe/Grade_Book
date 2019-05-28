<h1>Grades</h1>
<form method="post" action="<?php echo URL; ?>grades/create">
    
    <br/>
    
        <label>Add Grade</label><input type="text" name="grade_name"/>
    <label>&nbsp;</label><input type='submit'/>
</form>

<table>
  <tr>Grade</tr>
<?php

  foreach($this->gradeList as $key => $value) {
      echo "<tr>";
      
      echo "<td>" . $value['grade_name'] . "</td>";
      echo "<td> <a href='" . URL . "grades/edit/" . $value['grade_id'] . "'>Edit</a>
            <a href='" . URL . "grades/deleteUser/" . $value['grade_id'] . "'>Delete</a> </td>";
      echo "</tr>";

  }
?>
</table>

<!--<a href="#">GRADE 1</a>
<a href="#">GRADE 1</a>
<a href="#">GRADE 1</a>
<a href="#">GRADE 1</a>
<a href="#">GRADE 1</a>
<a href="#">GRADE 1</a>
<a href="#">GRADE 1</a>-->
<data></data>
