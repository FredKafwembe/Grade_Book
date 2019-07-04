<h3> Subject</h3>

<form method="post" action="<?php echo URL; ?>subjects/updateSubName/<?php echo $this->subject['subject_id']; ?>">
    <label>Edit Subject Name</label><input type="text" name="name" value="<?php echo $this->subject['name']; ?>"/><br/>
    
   
    <label>&nbsp;</label><input type='submit'/>
</form>
<br>
<?php 

  
  echo "<td><h4> <a href='" . URL . "subjects/assTeac/" . $this->subject['subject_id'] . "'>ADD SUBJECT TEACHER</a></h4>";
  ?><br>