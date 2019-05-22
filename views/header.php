<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
    <?php if(isset($this->js)) {
      foreach ($this->js as $js) {
        echo "<script type='text/javascript' src='" . URL . "views/" . $js . "'></script>";
      }
    }?>

    <title>Grade Book</title>
  </head>

  <body>
    <?php Session::init(); ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <?php if(!Session::get("loggedIn")) { ?>
        <a class="navbar-brand" href="<?php echo URL; ?>index">Home</a>
      <?php }?>
      <!--<a class="navbar-brand" href="#">Navbar</a>-->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <?php if(!Session::get("loggedIn")) { ?>
            <li class="nav-item active">
              <a class="nav-link" href="<?php echo URL; ?>help">Help <span class="sr-only">(current)</span></a>
            </li>
          <?php }?>


          <?php if(Session::get("loggedIn")) { ?>
            <?php $permissions = Session::get("permissions"); ?>
            <a href="<?php echo URL; ?>dashboard">Dashboard</a>

            <?php if(isset($permissions["View_Users"])) { ?>
              <a href="<?php echo URL; ?>user">Users</a>
            <?php } ?>

            <?php if(isset($permissions["View_Grades"])) { ?>
              <a href="<?php echo URL; ?>grades">Grades</a>
            <?php } ?>

            <?php if(isset($permissions["View_Subjects"])) { ?>
              <a href="<?php echo URL; ?>subjects">Subjects</a>
            <?php } ?>

            <?php if(isset($permissions["View_Results"])) { ?>
              <a href="<?php echo URL; ?>results">Results</a>
            <?php } ?>

            <?php if(isset($permissions["View_Roles"])) { ?>
              <a href="<?php echo URL; ?>roles">Roles</a>
            <?php } ?>

            <?php if(isset($permissions["View_Permissions"])) { ?>
              <a href="<?php echo URL; ?>permissions">Permissions</a>
            <?php } ?>

            <a href="<?php echo URL; ?>dashboard/logout">Logout</a>
          <?php } else { ?>
            <a href="<?php echo URL; ?>login">Login</a>
          <?php }?>

          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>

          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>

    <div id="header">
      <?php if(!Session::get("loggedIn")) { ?>
        <a href="<?php echo URL; ?>index">Home</a>
        <a href="<?php echo URL; ?>help">Help</a>
      <?php }?>
      <?php if(Session::get("loggedIn")) { ?>
        <?php $permissions = Session::get("permissions"); ?>
        <a href="<?php echo URL; ?>dashboard">Dashboard</a>

        <?php if(isset($permissions["View_Users"])) { ?>
          <a href="<?php echo URL; ?>user">Users</a>
        <?php } ?>

        <?php if(isset($permissions["View_Grades"])) { ?>
          <a href="<?php echo URL; ?>grades">Grades</a>
        <?php } ?>

        <?php if(isset($permissions["View_Subjects"])) { ?>
          <a href="<?php echo URL; ?>subjects">Subjects</a>
        <?php } ?>

        <?php if(isset($permissions["View_Results"])) { ?>
          <a href="<?php echo URL; ?>results">Results</a>
        <?php } ?>

        <?php if(isset($permissions["View_Roles"])) { ?>
          <a href="<?php echo URL; ?>roles">Roles</a>
        <?php } ?>

        <?php if(isset($permissions["View_Permissions"])) { ?>
          <a href="<?php echo URL; ?>permissions">Permissions</a>
        <?php } ?>

        <a href="<?php echo URL; ?>dashboard/logout">Logout</a>
      <?php } else { ?>
        <a href="<?php echo URL; ?>login">Login</a>
      <?php }?>
    </div>

    <div id="content">
