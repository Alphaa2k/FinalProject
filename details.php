<?php

  $notice = array('success' => '', 'failure' => '');

  include('Library DB/db_connect.php');
  session_start();

  if(isset($_SESSION['id'])){
    $account = $_SESSION['id']['MemberID'];
  }


  if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    $sql = mysqli_prepare($conn, "SELECT b.image, b.title, a.fName, a.lName, b.ISBN, b.Format, b.Description FROM Book b join Author a on b.`AUID`= a.`AUID` where b.`BookID` = ?");

    mysqli_stmt_bind_param($sql, "i", $id);

    // Execute the statement.
    mysqli_stmt_execute($sql);

    mysqli_stmt_bind_result($sql, $image, $title, $first, $last, $isbn, $format, $desc);

    // Get the variables from the query.
    $book = mysqli_stmt_fetch($sql);
  }

  if(isset($_POST['reserve'])){
    if(isset($_GET['id']) && !empty($account)){
      $bookid = $_GET['id'];
      $sql = "INSERT INTO Reservation (MemberID, BookID, ResExpire) SELECT * FROM (SELECT $account, $bookid , CURRENT_DATE() + 10) as tmp WHERE NOT EXISTS(SELECT BookID from Reservation where BookID = $bookid)";
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
  <title>Book Details</title>
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
<a class="waves-effect waves-light btn purple darken-4" href="javascript:history.back()"><i class="material-icons left">arrow_back</i>Back</a>

<div class="container">

  <body>
    <h6 class="center-align green-text">
      <?php echo $notice['success'] ?>
    </h6>
    <h6 class="center-align red-text">
      <?php echo $notice['failure'] ?>
    </h6>


    <?php if($book): ?>
    <form action="<?php echo $_SERVER['PHP_SELF'] . "?id=" . htmlspecialchars($_GET['id']);?>" method="POST">
      <div class="row">

        <div class="col s3 s3 l4">
          <img src="<?php echo " DB Images/" .$image;?>" alt="Book Image" class="responsive-img" width="270">
        </div>

        <h4 class="left-align">
          <?php echo $title;?>
        </h4>

        <div class="left-align">
          <p><i><?php echo "By " . $first . " " . $last; ?></i></p>

          <label>ISBN:</label>
          <p><?php echo $isbn; ?></p>

          <label>Format:</label>
          <p><?php echo $format?></p>

          <label>Description:</label>
          <p class="valign-wrapper"><?php echo $desc ?></p>
        </div>

        <div class="left-align">
          <label>Location:</label>
          <p>Located in University Library</p>
        </div>

        <button class="waves-effect waves-light btn purple darken-4" type="submit" name="reserve">Reserve</button>
      </form>
  </div>
</div>

<?php else: ?>
<h3 class="center-align">404: Book Not Found</h3>

<?php endif; ?>


</body>

</html>
