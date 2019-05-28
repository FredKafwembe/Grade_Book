<div class="text-center">
    <h1>Edit: Role</h1>
</div>

<div class="row">

    <div class="col-sm-2">
    </div>

    <div class="col-sm-8">
        <form class="form" method="post" action="<?php echo URL; ?>roles/updateRole/<?php echo $this->roleId; ?>">
            <div class="form-group">
                <label for="roleName">Role Name</label>
                <input class="form-control" type="text" name="roleName" 
                    value="<?php echo str_replace("_", " ", $this->rolePermissions[$this->roleId]["roleName"]); ?>" 
                    id="roleName" placeholder="Enter role name"/>
            </div>
            <table class="table table-borderless">
                <tr>
                <?php
                    foreach($this->permissionList as $key => $permission) {
                        if($key%4 == 0) {
                            echo "<td>";
                        }

                        $permissionId = $permission["permission_id"];
                        $rolePermissionList = $this->rolePermissions[$this->roleId]["rolePermissions"];
                        $selected = false;
                        foreach($rolePermissionList as $rolePermissionId => $rolePermission) {
                            if($rolePermissionId == $permissionId) {
                                $selected = true;
                                break;
                            }
                        }

                        $name = str_replace("_", " ", $permission["name"]);
                        printf("<input type='checkbox' name='%s' value='%d' %s>%s </br>",
                            $permission["name"], $permissionId, $selected ? 'checked' : '', $name);

                        if($key%4 == 3) {
                            echo "<td>";
                        }
                    }
                ?>
                </tr>
            </table>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>

    <div class="col-sm-2">
    </div>
</div>
