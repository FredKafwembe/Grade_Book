<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?php echo URL; ?>public/css/bootstrap.min.css">
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-3.4.1.js"></script>
    <!--<link rel="stylesheet" href="<?php //echo URL; ?>public/css/default.css" />-->
    <?php if(isset($this->js)) {
      foreach ($this->js as $js) {
        echo "<script type='text/javascript' src='" . URL . "views/" . $js . "'></script>";
      }
    }?>

    <title>Grade Book</title>
  </head>

  <body>
    <?php Session::init(); ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" id="header">
      <?php if(!Session::get("loggedIn")) { ?>
        <a class="navbar-brand" href="<?php echo URL; ?>index">Home</a>
      <?php } else { ?>
        <a class="navbar-brand" href="<?php echo URL; ?>dashboard">Dashboard</a>
      <?php } ?>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <?php if(!Session::get("loggedIn")) { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URL; ?>help">Help <span class="sr-only">(current)</span></a>
            </li>
          <?php }?>

          <?php if(Session::get("loggedIn")) { ?>
            <?php $permissions = Session::get("permissions"); ?>
            <?php if(isset($permissions["View_Users"])) { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URL; ?>user">Users</a>
              </li>
            <?php } ?>

            <?php if(isset($permissions["View_Grades"])) { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URL; ?>grades">Grades</a>
              </li>
            <?php } ?>

            <?php if(isset($permissions["View_Subjects"])) { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URL; ?>subjects">Subjects</a>
              </li>
            <?php } ?>

            <?php if(isset($permissions["View_Results"])) { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URL; ?>results">Results</a>
              </li>
            <?php } ?>

            <?php if(isset($permissions["View_Roles"])) { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URL; ?>roles">Roles</a>
              </li>
            <?php } ?>

            <?php if(isset($permissions["View_Permissions"])) { ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URL; ?>permissions">Permissions</a>
              </li>
            <?php } ?>

            <a class="nav-link" href="<?php echo URL; ?>dashboard/logout">Logout</a>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URL; ?>login">Login</a>
            </li>
          <?php }?>
        </ul>
      </div>
    </nav>

    <div id="content">
