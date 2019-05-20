<h1>User</h1>

<form method="post" action="<?php echo URL; ?>user/create">
    <label>First Name</label><input type="text" name="firstName"/><br/>
    <label>Last Name</label><input type="text" name="lastName"/><br/>
    <label>Password</label><input type="text" name="password"/><br/>
    <label>Role</label>
      <select name="roleId">
        <?php foreach($this->roleList as $role) {
          printf("<option value='%s'>%s</option>", $role["role_id"], str_replace("_", " ", $role["name"]));
        } ?>
      </select><br/>
    <label>Email</label><input type="text" name="email"/><br/>
    <label>Contact Number</label><input type="text" name="contactNumber"/><br/>
    <label>&nbsp;</label><input type='submit'/>
</form>

<hr/>

<table>
  <tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Contact Number</th>
    <th>Email</th>
    <th>Role</th>
    <th></th>
  </tr>
  <?php
  foreach($this->userList as $key => $value) {
      echo "<tr>";
      echo "<td>" . $value['first_name'] . "</td>";
      echo "<td>" . $value['last_name'] . "</td>";
      echo "<td>" . $value['contact_number'] . "</td>";
      echo "<td>" . $value['email'] . "</td>";
      echo "<td>" . $value['role_name'] . "</td>";
      echo "<td> <a href='" . URL . "user/edit/" . $value['user_id'] . "'>Edit</a>
            <a href='" . URL . "user/delete/" . $value['user_id'] . "'>Delete</a> </td>";
      echo "</tr>";
  }
?>
</table>
