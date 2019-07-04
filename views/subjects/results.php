<h1>STUDENT RESULTS</h1>

<table>
  <tr>

  <th>Subjects</th>
 <th>Test Time</th>
 <th>Grade</th>
 <th>Score</th>
 
  <tr/>

<?php
//print_r($this->resultList);
  foreach($this->resultList as $key => $value)
   {
      echo "<tr>";
      
      echo "<td>" . $value['name'] . "</td>";
      
      echo "<td>" . $value['test_time'] . "</td>";
      echo "<td>" . $value['percentage'] . "</td>";
       echo "<td>" . $value['score'] . "</td>";
      
      

    
      echo "<td> <a href='" . URL . "subjects/resultEdit/" . $value['subject_id'] . "'>Edit</a>
      <a href='" . URL . "subjects/deleteMark/" . $value['subject_id'] . "'>Delete</a>
             </td>";
      echo "</tr>";

   
      

  }

  echo "<td> <a href='" . URL . "subjects/markAdd/" . $value['user_id_fk'] ."'>ADD NEW RESULT</a>";
?>
</tr>
</table>
<?php 

  foreach ($this->total as $key => $value) {
    echo " Total =" . $value['SUM(marks.percentage)'];
    # code...
  }


 ?>



<!---<div class="text-center">
  <form method="post" class="form" action="<?php echo URL; ?>subjects/markAdd/<?php echo $this->marks['user_id_fk']; ?>">
    <button type="submit" class="btn btn-primary">Add New Result</button>
  </form>--->
</div>
