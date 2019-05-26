<?php
class RolePermissionsModel extends Model {
  function __construct() {
    parent::__construct();
  }

  function create($data) {
    $statment = $this->db->prepare(
      "INSERT INTO role_permissions (role_id_fk, permission_id_fk) 
      VALUES (:roleId, :permissionId)");
    $statment->execute(array(":roleId" => $data["roleId"], 
      ":permissionId" => $data["permissionId"]));
  }

  function readAllPermissionIdsWithRole($id) {
    $statment = $this->db->prepare("SELECT permission_id_fk FROM 
      role_permissions WHERE role_id_fk = :id");
    $statment->execute(array(":id" => $id));
    return $statment->fetchAll();
  }

  function deleteRolePermission($roleId, $permissionId) {
    $statment = $this->db->prepare("DELETE FROM role_permissions WHERE
      role_id_fk = :roleId AND 
      permission_id_fk = :permissionId");
    $statment->execute(array(":roleId" => $roleId,
      ":permissionId" => $permissionId));
  }

  function deleteAllRolePermissions($roleId) {
    $statment = $this->db->prepare("DELETE FROM role_permissions WHERE
      role_id_fk = :roleId");
    $statment->execute(array(":roleId" => $roleId));
  }
}
?>
