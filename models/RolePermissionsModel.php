<?php
class RolePermissionsModel extends Model {
  function __construct() {
    parent::__construct();
  }

  function readAllPermissionIdsWithRole($id) {
    $statment = $this->db->prepare("SELECT permission_id_fk FROM role_permissions WHERE role_id_fk = :id");
    $statment->execute(array(":id" => $id));
    return $statment->fetchAll();
  }
}
?>
