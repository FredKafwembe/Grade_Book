<h1>Roles</h1>

<hr/>

<form method="post" action="<?php echo URL; ?>roles/create">
  <table>
    <tr>
      <th>Role Name</th> <th>Permissions</th> <th></th>
    </tr>
    <tr>
      <td>
        <input type="text" name="roleName"/><br/>
      </td>
      <td>
        <?php
          foreach($this->permissionList as $permission) {
            $name = str_replace("_", " ", $permission["name"]);
            printf("<input type='checkbox' name='%s' value='%d'>%s<br/>",
              $permission["name"], $permission["permission_id"], $name);
          }
        ?>
      </td>
      <td>
        <label>&nbsp;</label><input type='submit' value="Create Role"/>
      </td>
    </tr>
  </table>
</form>

<hr/>

<table>
  <tr> <th>Role</th> <th>Permissions</th> </tr>
  <?php
  foreach ($this->roleList as $key => $value) {
    print("<tr>");
    printf("<td>%s</td>", $key);
    print("<td>");
    foreach($value as $permission) {
      printf("%s <br/>", $permission);
    }
    print("</td>");
    print("<tr>");
  }?>  
</table>
