<h1>Permissions</h1>

<table>
<?php
foreach($this->permissionList as $key => $value) {
  printf("<tr> <td>%d</td> <td>%s</td> </tr>", $key + 1, $value['name']);
}
?>
<table>
