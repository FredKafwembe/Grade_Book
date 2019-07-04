<div class="text-center">
    <h1>Add Role</h1>
</div>

<div class="row">

    <div class="col-sm-2">
    </div>

    <div class="col-sm-8 card">
        <form class="form needs-validation" method="post" action="<?php echo URL; ?>roles/create" novalidate>
            <div class="form-group">
                <label for="roleName">Role Name</label>
                <input class="form-control" type="text" name="roleName" id="roleName" placeholder="Enter role name" required/>
                <div class="valid-feedback">
                    Role name OK.
                </div>
                <div class="invalid-feedback">
                    Please specify a role name.
                </div>
            </div>
            <table class="table table-borderless">
                <tr>
                <?php
                    foreach($this->permissionList as $key => $permission) {
                        if($key%4 == 0) {
                            echo "<td>";
                        }

                        $name = str_replace("_", " ", $permission["name"]);
                        printf("<input type='checkbox' name='%s' value='%d'>%s </br>",
                            $permission["name"], $permission["permission_id"], $name);

                        if($key%4 == 3) {
                            echo "<td>";
                        }
                    }
                ?>
                </tr>
            </table>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Add Role</button>
            </div>
        </form>
    </div>

    <div class="col-sm-2">
    </div>
</div>
