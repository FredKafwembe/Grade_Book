<?php
//include_once './models/UserModel.php';
//include_once './models/TeacherModel.php';
//include_once './models/SubjectModel.php';

//$model = new SubjectModel();
//$row = $model->insertSubject("kldafsdfafd");
//print_r($row);

require "./libs/Bootstrap.php";
require "./libs/Controller.php";
require "./libs/Model.php";
require "./libs/View.php";
require "./libs/Database.php";
require "./libs/Session.php";

require "./config/paths.php";
require "./config/database.php";
require "./config/UserPermissions.php";
require "./config/TestTypes.php";
require "./config/PassGrades.php";

require "./public/php/fpdf.php";

//require "./models/RolePermissionsModel.php";
//require "./models/PermissionsModel.php";

$app = new Bootstrap();


?>
