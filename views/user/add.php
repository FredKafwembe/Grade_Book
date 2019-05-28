<div class="row">
  
  <div class="col-sm-2">
  </div>
  
  <div class="col-sm-8">
    <form method="post" class="form" action="<?php echo URL; ?>user/create">

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName"/>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="lastName"/>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label>Password</label>
            <input type="text" class="form-control" name="password"/>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label>Role</label>
            <select name="roleId" class="form-control">
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
            <label>Email</label>
            <input type="text" class="form-control" name="email"/>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label>Contact Number</label>
            <input type="text" class="form-control" name="contactNumber"/>
          </div>
        </div>
      </div>

      <div class="col text-center">      
        <button type="submit" class="btn btn-primary">Add User</button>
        <!--<input type="submit" class="btn btn-default" />-->
      </div>
    </form>
  </div>
  <div class="col-sm-2"></div>
</div>
