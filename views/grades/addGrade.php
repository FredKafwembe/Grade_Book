<?php
print_r($this->grade);
  ?>
 <h3>Click submit to enroll student in <?php print_r($this->grade['grade_name']) ?></h3>

<form method="post" action="<?php echo URL; ?>grades/create">
    
    <br/>
    
        <label>Add Grade</label><input type="text" name="grade_name"/>
    <label>&nbsp;</label><input type='submit'/>
</form>