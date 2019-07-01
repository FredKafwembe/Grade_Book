<h1>Users</h1>

<table class="table">
  <tr>
    <th>User ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Contact Number</th>
    <th>Email</th>
    <th>Role</th>
    <th></th>
  </tr>
  <?php
  Session::init();
  foreach($this->userList as $key => $value) {
      echo "<tr>";
      echo "<td>" . $value['user_id'] . "</td>";
      echo "<td>" . $value['first_name'] . "</td>";
      echo "<td>" . $value['last_name'] . "</td>";
      echo "<td> +26" . $value['contact_number'] . "</td>";
      echo "<td>" . $value['email'] . "</td>";
      echo "<td>" . $value['role_name'] . "</td>";
      echo "<td>";
      
      $permissions = Session::get("permissions");

      if(isset($permissions["Edit_Users"])) {
        echo "<a href='" . URL . "user/edit/" . $value['user_id'] . "'>Edit</a> ";
      }

      if(isset($permissions["Delete_Users"])) {
        echo "<a href='" . URL . "user/deleteUser/" . $value['user_id'] . "'>Delete</a>";
      }

      echo "</td>";
      echo "</tr>";
  }
  ?>
</table>

<?php if(isset($permissions["Create_Users"])) { ?>
  <div class="text-center">
    <form method="post" class="form" action="<?php echo URL; ?>user/add">
      <button type="submit" class="btn btn-primary">Add User</button>
    </form>
  </div>
<?php } ?>