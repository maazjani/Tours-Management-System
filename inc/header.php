<?php 
  $filepath = realpath(dirname(__FILE__));
  include_once $filepath.'/../lib/Session.php'; 
  Session::init();
  //echo $filepath;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Tours Management System</title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/style.css" />
  </head>

  <?php
    if(isset($_GET['action']) && $_GET['action']=='logout'){
      Session::destroy();
    }
  ?>

  <body>
    <div class="container-fluid">
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container">
        <a class="navbar-brand" href="#">Tours Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse id="navbarsExampleDefault">
          <ul class="navbar-nav" style="margin-left: auto !important">
            <?php 
              $is_login = Session::get('login'); 
              if($is_login == true){
            ?>
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="tour_types.php">Tour types</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="tour_packages.php">Tour Packages</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="!#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php $name = Session::get('UNAME'); if(isset($name)){echo $name;}?></a>
              <div class="dropdown-menu" aria-labelledby="dropdown01">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="?action=logout">Logout</a>
              </div>
            </li>
            <?php }else{?>
                <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
              </li>
            <?php } ?>
          </ul>
        </div>
        </div>
      </nav>
    </div>

