<div class="text-center">
  <h1>Add: User</h1>
</div>

<div class="row">
  
  <div class="col-sm-2">
  </div>
  
  <div class="col-sm-8">
    <form method="post" class="form" action="<?php echo URL; ?>user/create" novalidate>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" class="form-control" id="firstName" name="firstName" required/>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="lastName">Last Name</label>
            <input type="text" class="form-control" id="lastName" name="lastName" required/>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="password">Password</label>
            <input type="text" class="form-control" id="password" name="password" required/>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="role">Role</label>
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
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required/>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="contactNumber">Contact Number</label>
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">+26</span>
              </div>
              <input type="number" class="form-control" id="contactNumber" name="contactNumber" required/>
            </div>
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
