<?php

  $notice = array('success' => '', 'failure' => '');

  include('Library DB/db_connect.php');
  session_start();

  if(isset($_SESSION['id'])){
    $account = $_SESSION['id']['MemberID'];
  }


  if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = "SELECT * FROM `book` join `author` on `book`.`AUID`= `author`.`AUID` where `book`.`BookID` = $id";

    $query = mysqli_query($conn, $sql);

    $book = mysqli_fetch_assoc($query);

    mysqli_free_result($query);

  }

  if(isset($_POST['reserve'])){
    if(isset($_GET['id']) && !empty($account)){
      $bookid = $_GET['id'];
      $sql = "INSERT INTO reservation (MemberID, BookID, ResExpire) SELECT * FROM (SELECT $account, $bookid , CURRENT_DATE() + 10) as tmp WHERE NOT EXISTS(SELECT BookID from reservation where BookID = $bookid)";
      if(mysqli_query($conn, $sql)){
        if(mysqli_affected_rows($conn) == 0){
          $notice['failure'] = "This book has already been reserved.";
          }else{
            $notice['success'] = "Book reserved successfully.";
          }
        }else{
          echo "Error: " . mysqli_error($conn);
        }
      }else{
        $_SESSION['referer'] = $_SERVER['HTTP_REFERER'];
        header('Location: auth.php');
        exit;
      }
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
  <li><a href="help.php">Help</a></li>
  <li><a href="login.php" id="account">My Account</a></li>
</ul>

<body>
  <h6 class="center-align green-text">
    <?php echo $notice['success'] ?>
  </h6>
  <h6 class="center-align red-text">
    <?php echo $notice['failure'] ?>
  </h6>

  <h1>Details on Book</h1>

  <?php if($book): ?>
  <form class="" action="<?php echo $_SERVER['PHP_SELF'] . " ?id=" . $_GET['id'];?>" method="POST">
    <div>
      <img src="<?php echo " DB Images/" . htmlspecialchars($book['Image']);?>" alt="Book Image" width="100" height="150">
    </div>
    <h4>
      <?php echo htmlspecialchars($book['Title']); ?>
    </h4>
    <p>
      <?php echo htmlspecialchars($book['Format']); ?>
    </p>
    <p>Author:
      <?php echo htmlspecialchars($book['fName']) . htmlspecialchars($book['lName']) ?>
    </p>
    <p>
      <?php echo htmlspecialchars($book['Description']) ?>
    </p>
    <button type="submit" name="reserve">Reserve</button>
  </form>

  <?php else: ?>
  <p>Hello World</p>

  <?php endif; ?>


</body>

</html>
