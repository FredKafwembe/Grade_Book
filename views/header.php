<html>
  <head>
    <title>Grade Book</title>
    <link rel="stylesheet" href="<?php echo URL; ?>public/css/default.css" />
    <script type="text/javascript" src="<?php echo URL; ?>public/js/jquery-3.4.1.js"></script>
    <?php if(isset($this->js)) {
      foreach ($this->js as $js) {
        echo "<script type='text/javascript' src='" . URL . "views/" . $js . "'></script>";
      }
    }?>
  </head>

  <body>
    <?php Session::init(); ?>
    <div id="header">
      <br/>
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
