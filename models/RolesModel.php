<?php
require_once "RolePermissionsModel.php";
require_once "PermissionsModel.php";

class RolesModel extends Model {
  function __construct() {
    parent::__construct();
  }

  function create($data) {
    $statment = $this->db->prepare("INSERT INTO roles (name) VALUES (:name)");
    $statment->execute(array(":name" => $data["roleName"]));
    $roleId = $this->db->lastInsertId();

    $rolePermissionsModel = new RolePermissionsModel();
    foreach($data["rolePermissions"] as $value) {
      $rolePermissionsModel->create(array("roleId" => $roleId, "permissionId" => $value));
    }
  }

  function readRole($id) {
    $statment = $this->db->prepare("SELECT name FROM roles WHERE role_id = :id");
    $statment->execute(array(":id" => $id));
    return $statment->fetch();
  }

  function readAllRoles() {
    $statment = $this->db->prepare("SELECT role_id, name FROM roles");
    $statment->execute();
    return $statment->fetchAll();
  }

  /**
   * Returns an associative array in the form
   * $roleId => array("roleName" => $roleName, "rolePermissions" => array($rolePermissions))
  */
  function readAllRolesWithPermissions() {
    $rolesWithPermissions = array();
    $roles = $this->readAllRoles();
    $rolePermissionsModel = new RolePermissionsModel();
    $permissionsModel = new PermissionsModel();
    foreach ($roles as $role) {
      $rolePermissionIds = $rolePermissionsModel->readAllPermissionIdsWithRole($role["role_id"]);
      //print_r($rolePermissionIds);
      $rolePermissions = array();
      foreach ($rolePermissionIds as $permissionId) {
        //print_r($permissionId["permission_id_fk"]);
        $permission = $permissionsModel->readPermission($permissionId["permission_id_fk"]);
        //print_r($permission);
        $rolePermissions[] = $permission["name"];
      }
      $rolesWithPermissions[$role["role_id"]] = array("roleName" => $role["name"],
        "rolePermissions" => $rolePermissions);
    }
    return $rolesWithPermissions;
  }

  function readAllPermissions() {
    $permissionsModel = new PermissionsModel();
    return $permissionsModel->readAllPermissions();
  }
}
?>
