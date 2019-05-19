<?php
class PermissionsModel extends Model {
  function __construct() {
    parent::__construct();
  }

  function readAllPermissions() {
    $statment = $this->db->prepare("SELECT permission_id, name FROM permissions");
    $statment->execute();
    return $statment->fetchAll();
  }

  function readPermission($id) {
    $statment = $this->db->prepare("SELECT name FROM permissions WHERE permission_id = :id");
    $statment->execute(array(":id" => $id));
    return $statment->fetch();
  }
}
?>
