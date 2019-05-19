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
        <a href="<?php echo URL; ?>dashboard">Dashboard</a>

        <?php //if(Session::get("role") == "owner") { ?>
          <a href="<?php echo URL; ?>user">Users</a>
        <?php //}?>
        <a href="<?php echo URL; ?>grades">Grades</a>
        <a href="<?php echo URL; ?>subjects">Subjects</a>
        <a href="<?php echo URL; ?>results">Results</a>
        <a href="<?php echo URL; ?>roles">Roles</a>
        <a href="<?php echo URL; ?>permissions">Permissions</a>

        <a href="<?php echo URL; ?>dashboard/logout">Logout</a>
      <?php } else { ?>
        <a href="<?php echo URL; ?>login">Login</a>
      <?php }?>
    </div>

    <div id="content">
