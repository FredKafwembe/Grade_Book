<h1>Users</h1>

<table class="table">
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
            <a href='" . URL . "user/deleteUser/" . $value['user_id'] . "'>Delete</a> </td>";
      echo "</tr>";
  }
?>
</table>

<div class="text-center">
  <form method="post" class="form" action="<?php echo URL; ?>user/add">
    <button type="submit" class="btn btn-primary">Add User</button>
  </form>
</div>