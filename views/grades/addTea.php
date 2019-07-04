<h3>ADD</h3>

<div class="card">
<form method="post" class="form" action="<?php echo URL; ?>grades/filterTea">
  <label><h6>Select Role</h6></label>
  <select name="roleId" class="form-control">
    <?php foreach($this->roleList as $role) {
      printf("<option value='%s'>%s</option>", $role["role_id"], str_replace("_", " ", $role["name"]));
    } ?>
  </select>
    
  <input type="hidden" id="custId" name="grade_id" value="<?php echo $this->grade_id ?>">
  <div class="text-center">
    <button type="submit" class="btn btn-primary">Filter</button>
  </div>
</form>
<?php // echo $this->grade_id;  ?>

<table class="table">
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Contact Number</th>
    <th>Email</th>
    
    <th></th>
  </tr>
  <?php

  $grade_id = $this->grade_id;
  //echo $grade_id;
  foreach($this->userList as $key => $value) {
      echo "<tr>";
      echo "<td>" . $value['first_name'] . "</td>";
      echo "<td>" . $value['last_name'] . "</td>";
      echo "<td>" . $value['contact_number'] . "</td>";
      echo "<td>" . $value['email'] . "</td>";
      
      echo "<td><form method='post' class='form' action=' <?php echo URL; ?> grades/appoint'>
          <input type='hidden' id='custId' name='grade_id' value=' echo $this->grade_id '>
          <input type='hidden' id='custId' name='user_id' value=" . $value['user_id'] . ">
          <div class='col text-center'>
           <button type='submit' class='btn btn-primary'>APPOINT</button> 
        
      </div>
    </form> ";

      echo "</tr>";

  }
?>
</table>
</div>

