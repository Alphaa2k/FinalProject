<?php

  include('Library DB/db_connect.php');
  session_start();

  if(isset($_SESSION['id'])){
    $account = $_SESSION['id']['MemberID'];
    echo $account;
  }

  if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM academicdb WHERE ID = '$id'";

    $query = mysqli_query($conn, $sql);

    $acadb = mysqli_fetch_assoc($query);

    mysqli_free_result($query);

  }

 ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Details</title>
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
        <li><a href="#help">Help</a></li>
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
    <li><a href="#help">Help</a></li>
    <li><a href="login.php" id="account">My Account</a></li>
   </ul>


    <h1>Details on Academic Database</h1>

      <?php if($acadb): ?>

        <div>
          <img src="<?php echo " DB Images/" . htmlspecialchars($book['Image']);?>" alt="Book Image" width="100" height="150">
        </div>
        <h4><?php echo htmlspecialchars($acadb['Name']); ?></h4>
        <p><?php echo htmlspecialchars($acadb['Description']); ?></p>

        <a href="<?php echo htmlspecialchars($acadb['Link']); ?>"><button type="button" name="reserve">Go to Database</button></a>


      <?php else: ?>
        <p>Hello World</p>

      <?php endif; ?>


  </body>
</html>