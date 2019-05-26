<h1>Roles</h1>

<hr/>

<form method="post" action="<?php echo URL; ?>roles/create">
  <table class="table">
    <tr>
      <th>Role Name</th> <th>Permissions</th> <th></th>
    </tr>
    <tr>
      <td>
        <input type="text" name="roleName"/><br/>
      </td>
      <td>
        <table class="table-striped">
          <tr>
            <?php
              foreach($this->permissionList as $key => $permission) {
                if($key%4 == 0) {
                  echo "<td>";
                }
                $name = str_replace("_", " ", $permission["name"]);
                printf("<input type='checkbox' name='%s' value='%d'>%s<br/>",
                  $permission["name"], $permission["permission_id"], $name);
                if($key%4 == 3) {
                  echo "</td>";
                }
              }
            ?>
          </tr>
        </table>
      </td>
      <td>
        <label>&nbsp;</label><input type='submit' value="Create Role"/>
      </td>
    </tr>
  </table>
</form>

<hr/>

<table class="table">
  <tr> <th>Role</th> <th>Permissions</th> </tr>
  <?php
  foreach ($this->roleList as $key => $value) {
    print("<tr>");
      printf("<td>%s</td>", str_replace("_", " ", $value["roleName"]));
      print("<td>");
        print("<table class='table-striped'>");
          print("<tr>");
          foreach($value["rolePermissions"] as $count => $permission) {
            if($count%4 == 0) {
              echo "<td>";
            }
            printf("%s <br/>", str_replace("_", " ", $permission));
            if($count%4 == 3) {
              echo "</td>";
            }
          }
          print("</tr>");
        print("</table>");
      print("</td>");
    print("<tr>");
  }?>  
</table>
