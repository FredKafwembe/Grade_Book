<h1>Permissions</h1>

<table class="table-striped">
  <?php
  foreach($this->permissionList as $key => $value) {
    printf("<tr> <td>%d</td> <td>%s</td> </tr>", $key + 1, str_replace("_", " ", $value['name']));
  }
  ?>
<table>
