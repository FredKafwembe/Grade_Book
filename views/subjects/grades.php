<h1>Subjects</h1>

<table>
  <tr>

  <th>Subjects</th>
  <th>Action</th>
  
  <tr/>

<?php
  foreach($this->sub as $key => $value)
   {
     // echo "<tr>";
      
      echo "<td>" . $value['name'] . "</td>";

      
      
      

     
      echo "<td> <a href='" . URL . "subjects/editSubName/" . $value['subject_id'] . "'>Edit</a>
            <a href='" . URL . "subjects/deleteSubject/" . $value['subject_id'] . "'>Delete</a> </td>";
      echo "</tr>";

  }
   
?>

</table>
<?php 
echo  $this->grade_id;

/*
 foreach($this->sub as $key => $value){

    echo " <a href='" . URL . "subjects/editSubName/" . $value['grade_id'] . "'>Edit</a>";}*/

    ?>
<div class="text-center">
  <form method="post" class="form" action="<?php echo URL; ?>subjects/add/<?php echo $this->grade_id; ?>">
    <button type="submit" class="btn btn-primary">Add Subject</button>
  </form>
</div>



Subjects offered to pupils appear here.
