<h1>User: Edit</h1>

<form method="post" action="<?php echo URL; ?>user/updateUser/<?php echo $this->user['user_id']; ?>">
    <label>First Name</label><input type="text" name="firstName" value="<?php echo $this->user['first_name']; ?>"/><br/>
    <label>Last Name</label><input type="text" name="lastName" value="<?php echo $this->user['last_name']; ?>"/><br/>
    <label>Password</label><input type="text" name="password"/><br/>
    <label>Email</label><input type="text" name="email" value="<?php echo $this->user['email']; ?>"/><br/>
    <label>Contact Number</label><input type="text" name="contactNumber" value="<?php echo $this->user['contact_number']; ?>"/><br/>
    <label>Role</label>
      <select name="roleId">
        <?php foreach($this->roleList as $role) {
          if($this->user["role_id_fk"] == $role["role_id"]) {
            printf("<option value='%s' selected>%s</option>", $role["role_id"], $role["name"]);
          } else {
            printf("<option value='%s'>%s</option>", $role["role_id"], $role["name"]);
          }
        }?>
      </select><br/>
    <label>&nbsp;</label><input type='submit'/>
</form>
