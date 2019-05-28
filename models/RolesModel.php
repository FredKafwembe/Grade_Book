<?php
require_once "RolePermissionsModel.php";
require_once "PermissionsModel.php";
require_once "UserModel.php";

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

  function readRole($roleId) {
    $statment = $this->db->prepare("SELECT name FROM roles WHERE role_id = :id");
    $statment->execute(array(":id" => $roleId));
    return $statment->fetch();
  }

  function readAllRoles() {
    $statment = $this->db->prepare("SELECT role_id, name FROM roles");
    $statment->execute();
    return $statment->fetchAll();
  }

  function readRoleWithPermissions($roleId) {
    $roleWithPermissions = array();
    $role = $this->readRole($roleId);
    $rolePermissionsModel = new RolePermissionsModel();
    $permissionsModel = new PermissionsModel();

    $rolePermissionIds = $rolePermissionsModel->readAllPermissionIdsWithRole($roleId);
    //print_r($rolePermissionIds);
    $rolePermissions = array();
    foreach ($rolePermissionIds as $permissionId) {
      //print_r($permissionId["permission_id_fk"]);
      $permission = $permissionsModel->readPermission($permissionId["permission_id_fk"]);
      //print_r($permission);
      $rolePermissions[$permissionId["permission_id_fk"]] = $permission["name"];
    }
    $roleWithPermissions[$roleId] = array("roleName" => $role["name"],
      "rolePermissions" => $rolePermissions);

    return $roleWithPermissions;
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

  function updateRole($data) {
    $statment = $this->db->prepare("UPDATE roles SET name=:name WHERE role_id=:roleId");
    $statment->execute(array(":roleId" => $data["roleId"], ":name" => $data["roleName"]));
    //$roleId = $this->db->lastInsertId();

    $rolePermissionsModel = new RolePermissionsModel();
    $rolePermissionsModel->deleteAllRolePermissions($data["roleId"]);
    foreach($data["rolePermissions"] as $value) {
      $rolePermissionsModel->create(array("roleId" => $data["roleId"], "permissionId" => $value));
    }
  }

  function delete($roleId) {
    $success = false;

    $roleData = $this->readRole($roleId);

    $userModel = new UserModel();
    $users = $userModel->readAllUsersWithRoleId($roleId);

    if(count($users) == 0) {
      $success = true;
    }

    if($success) {      
      $rolePermissionsModel = new RolePermissionsModel();
      $rolePermissionsModel->deleteAllRolePermissions($roleId);

      $statment = $this->db->prepare("DELETE FROM roles WHERE role_id = :roleId");
      $statment->execute(array(":roleId" => $roleId));
    }
    $data = array("success" => $success ? 1 : 0, "role" => $roleData["name"]);

    return $data;
  }
}
?>
