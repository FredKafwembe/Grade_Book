<div class="text-center">
  <h1>Permissions</h1>
</div>

<div class="row">
  <div class="col-sm-2">
  </div>

  <div class="col-sm-8">
    <table class="table table-striped">
      <?php
      foreach($this->permissionList as $key => $value) {
        printf("<tr> <td>%d</td> <td>%s</td> </tr>", $key + 1, str_replace("_", " ", $value['name']));
      }
      ?>
    <table>
  </div>

  <div class="col-sm-2">
  </div>
</div>
