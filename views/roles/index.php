<div class="text-center">
  <h1>Roles</h1>
</div>

<table class="table">
  <tr> <th>Role</th> <th>Permissions</th> </tr>

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
    </tr>
  <?php } ?>
</table>

<div class="text-center">
  <form method="post" class="form" action="<?php echo URL; ?>roles/add">
    <button type="submit" class="btn btn-primary">Add Role</button>
  </form>
</div>
