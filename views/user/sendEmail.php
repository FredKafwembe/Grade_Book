<div class="text-center">
  <h1>Send Email</h1>
</div>

<?php if(isset($_GET["success"])) {
    if($_GET["success"]) { ?>
        <div class="alert alert-primary" role="alert">
            Emails sent!
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            Failed to send emails!
        </div>
    <?php }
} ?>

<div class="row">

  <div class="col-sm-3">
  </div>
  
  <div class="col-sm-6">
    <form method="post" class="form needs-validation" action="<?php echo URL; ?>user/broadcastEmail" novalidate>

      <div class="row">
        <div class="col-sm-8">
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" required/>
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group">
            <label for="role">Role Receiving Email</label>
            <select name="roleId" class="form-control" id="role" required>
              <?php foreach($this->roleList as $role) {
                printf("<option value='%s'>%s</option>", $role["role_id"], str_replace("_", " ", $role["name"]));
              } ?>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="body">Message</label>
            <textarea class="form-control" id="body" rows="8" name="body" required></textarea>
          </div>
        </div>
      </div>

      <div class="col text-center">      
        <button type="submit" class="btn btn-primary">Send Email</button>
      </div>
    </form>
  </div>
  <div class="col-sm-3"></div>
</div>

