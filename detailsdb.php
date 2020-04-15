<?php

  include('Library DB/db_connect.php');
  session_start();

  if(isset($_SESSION['id'])){
    $account = $_SESSION['id']['MemberID'];
  }

  if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = mysqli_prepare($conn, "SELECT Name, Link, Description FROM academicdb WHERE ID = ?");

    mysqli_stmt_bind_param($sql, "s", $id);

    // Execute the statement.
    mysqli_stmt_execute($sql);

    mysqli_stmt_bind_result($sql, $name, $link, $desc);

    // Get the variables from the query.
    $acadb = mysqli_stmt_fetch($sql);
  }



 ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Academic Database Details</title>
  <!--Import Google Icon Font-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/index.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

  <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
      var elems = document.querySelectorAll('.sidenav');
      var instances = M.Sidenav.init(elems, {});
    });
  </script>

  <nav>
    <div class="nav-wrapper purple darken-4">
      <!-- <a href="#!" class="brand-logo center">Logo</a> -->
      <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
      <ul class="left hide-on-med-and-down">
        <li><a href="index.php">Home</a></li>
        <li><a href="accessibility.php">Accessibility</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li><a href="#LibraryWeb">Library Website</a></li>
        <li><a href="#contact">Contact Us</a></li>
        <li><a href="help.php">Help</a></li>
      </ul>
      <ul class="right hide-on-med-and-down">
        <li><a href="login.php" id="account">My Account</a></li>
      </ul>
    </div>
  </nav>

  <ul class="sidenav" id="mobile-demo">
    <li><a href="index.php">Home</a></li>
    <li><a href="accessibility.php">Accessibility</a></li>
    <li><a href="feedback.php">Feedback</a></li>
    <li><a href="#LibraryWeb">Library Website</a></li>
    <li><a href="#contact">Contact Us</a></li>
    <li><a href="help.php">Help</a></li>
    <li><a href="login.php" id="account">My Account</a></li>
  </ul>
  <a class="waves-effect waves-light btn purple darken-4" href="javascript:history.back()"><i class="material-icons left">arrow_back</i>Back to Results</a>

  <div class="container">

    <?php if($acadb): ?>

    <h4>
      <?php echo $name; ?>
    </h4>

    <div class="center-align">
      <label>Description:</label>
      <p class="center-align">
        <?php echo $desc ?>
      </p>
    </div>

    <div class="row center-align">
      <a href="<?php echo " http://" . $link ?>"><button type="button" class="waves-effect waves-light btn purple darken-4">Go to Database</button></a>
    </div>

  </div>


  <?php else: ?>
  <h3 class="center-align">404: Book Not Found</h3>

  <?php endif; ?>


</body>

</html>
