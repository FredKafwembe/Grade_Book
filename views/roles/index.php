<div class="text-center">
  <h1>Roles</h1>
</div>

<?php if(isset($_GET["success"])) {
  if($_GET["success"] == 1) { ?>
    <div class="alert alert-success" role="alert">
      Successfully removed role <?php echo $_GET["role"]; ?>.
    </div>
  <?php } else { ?>
    <div class="alert alert-danger" role="alert">
      Failed to remove role <?php echo $_GET["role"]; ?>. Make sure no user is using the role before removing it.
    </div>
  <?php }
} ?>

<table class="table">
  <tr> <th>Role</th> <th>Permissions</th> <th></th></tr>

  <?php foreach ($this->roleList as $key => $value) { ?>
    <tr>
      <td>
        <?php echo str_replace("_", " ", $value["roleName"]); ?>
      </td>

      <td>
        <table class='table-sm table-borderless'>
          <?php foreach($value["rolePermissions"] as $count => $permission) {
            if($count%6 == 0) {
              echo "<tr>";
            } ?>

            <td>
              <?php echo str_replace("_", " ", $permission); ?>
            </td>

            <?php if($count%6 == 5) {
              echo "</tr>";
            }
          } ?>
        </table>
      </td>

      <td>
        <?php
          Session::init();
          $permissions = Session::get("permissions");
          if(isset($permissions["Edit_Roles"])) {
            echo "<a href=" . URL . "roles/edit/$key>Edit</a> ";
          }

          if(isset($permissions["Delete_Roles"])) {
            echo "<a href=" . URL . "roles/delete/$key>Delete</a>";
          }
        ?>

      </td>
    </tr>
  <?php } ?>
</table>

<?php if(isset($permissions["Create_Roles"])) { ?>
  <div class="text-center">
    <form method="post" class="form" action="<?php echo URL; ?>roles/add">
      <button type="submit" class="btn btn-primary">Add Role</button>
    </form>
  </div>
<?php } ?>