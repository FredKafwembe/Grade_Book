<?php
include_once './models/UserModel.php';

$userModel = new UserModel();
//$userModel->insertUser("lkjdla", 1, "dsafoi");
$userRow = $userModel->deleteUser(1);
//print_r($userRow);
?>