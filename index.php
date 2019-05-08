<?php
include_once './models/UserModel.php';

$userModel = new UserModel();
$userRow = $userModel->deleteUser(1);
?>