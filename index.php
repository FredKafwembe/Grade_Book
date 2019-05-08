<?php
include_once './models/UserModel.php';
include_once './models/TeacherModel.php';

$model = new TeacherModel();
$row = $model->deleteTeacher(2);
//print_r($row);
?>